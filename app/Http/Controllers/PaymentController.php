<?php

namespace App\Http\Controllers;

use App\Models\Application;
use App\Models\Notification;
use App\Models\Payment;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PaymentController extends Controller
{
    public function index()
    {
        return view('auth.payment');
    }

    public function store(Request $request)
    {
        // FIX #17: payment_type and bank_name were previously read raw via
        // $request->payment_type / $request->bank_name with zero validation
        // — any string (or no string at all) would be written straight into
        // a payment record. The frontend only ever offers two methods
        // ('online_transfer' or 'card', see payment.blade.php's method-card
        // data-value attributes), and only requires a bank when FPX/bank
        // transfer is selected, so server-side validation now mirrors that
        // exactly instead of trusting the client.
        $request->validate([
            'app_no'       => 'required|string|exists:application,app_no',
            'payment_type' => ['required', 'string', 'in:online_transfer,card'],
            'bank_name'    => ['required_if:payment_type,online_transfer', 'nullable', 'string', 'max:100'],
        ], [
            'payment_type.required' => 'Sila pilih kaedah pembayaran.',
            'payment_type.in'       => 'Kaedah pembayaran tidak sah.',
            'bank_name.required_if' => 'Sila pilih bank anda.',
        ]);

        // ── Load the application & verify ownership (fix #4) ─────────────────
        $application = Application::where('app_no', $request->app_no)
            ->where('user_id', Auth::id())
            ->firstOrFail();

        // Guard: only approved applications can proceed to payment
        if (! $application->isApproved()) {
            return back()->withErrors([
                'app_no' => 'Permohonan ini belum diluluskan dan tidak boleh dibayar.',
            ]);
        }

        // Guard: prevent paying an already-completed application
        if ($application->app_status === 'completed') {
            return back()->withErrors([
                'app_no' => 'Pembayaran untuk permohonan ini telah pun diselesaikan.',
            ]);
        }

        // ── Derive the correct amount from the application record (fix #4) ───
        $totalAmt = (float) $application->total_amount;

        if ($totalAmt <= 0) {
            return back()->withErrors([
                'app_no' => 'Jumlah bayaran tidak sah. Sila hubungi pegawai.',
            ]);
        }

        // ── Upsert payment record ────────────────────────────────────────────
        $payment = Payment::updateOrCreate(
            ['app_no' => $request->app_no],
            [
                'user_id'        => Auth::id(),
                'invoice_no'     => Payment::where('app_no', $request->app_no)->value('invoice_no')
                                    ?? 'INV-' . strtoupper(uniqid()),
                'payment_type'   => $request->payment_type,
                'bank_name'      => $request->bank_name,   // ← store selected bank
                'total_amt'      => $totalAmt,
                'payment_status' => 'paid',
            ]
        );

        // ── Update application status ────────────────────────────────────────
        $application->update(['app_status' => 'completed']);

        // ── Send notification ────────────────────────────────────────────────
        Notification::send(
            Auth::id(),
            $application->app_id,
            'payment_received',
            "payment_received:{$payment->invoice_no}:RM " . number_format($totalAmt, 2)
        );

        return redirect()->route('payment.index')
            ->with('success', 'Pembayaran Berjaya!');
    }

    public function receipt($id)
    {
        // ── FIX #7: Eager-load the related application and user so the receipt
        //    blade has access to real data (location, parking count, owner name,
        //    payment date) instead of hardcoded placeholder values.
        $payment = Payment::with('user')
            ->where('app_no', $id)
            ->where('user_id', Auth::id())
            ->where('payment_status', 'paid')
            ->firstOrFail();

        // Load the application separately — it's linked by app_no, not a
        // foreign key on the payment model, so we query it directly.
        $application = Application::where('app_no', $payment->app_no)->first();

        $pdf = Pdf::loadView('auth.pdf.receipt', [
            'payment'     => $payment,
            'application' => $application,
            'user'        => Auth::user(),
        ]);

        return $pdf->download('Resit-' . $payment->invoice_no . '.pdf');
    }
}