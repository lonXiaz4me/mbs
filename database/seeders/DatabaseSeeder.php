<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Carbon;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // ────────────────────────────────────────────────────────────────────
        // USERS
        // ────────────────────────────────────────────────────────────────────
        DB::table('users')->insert([
            [
                'full_name'     => 'MUHAMMAD ZAINOL IZUDIN BIN',
                'ic_no'         => '020723-10-1365',
                'email'         => 'zenfrost23@gmail.com',
                'phone_no'      => '0182894347',
                'password'      => Hash::make('@Password123'),
                'reset_token'   => null,
                'reset_expires' => null,
                'otp'           => null,
                'otp_expires'   => null,
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now(),
            ],
        ]);

        $userId = DB::table('users')->where('email', 'zenfrost23@gmail.com')->value('user_id');

        // ────────────────────────────────────────────────────────────────────
        // APPLICATIONS — pending, approved, completed, not_approved (failed)
        // ────────────────────────────────────────────────────────────────────
        DB::table('application')->insert([
            [
                'app_no'              => 'MBS-20260701-0001',
                'user_id'             => $userId,
                'company_name'        => 'Zainol Trading Co',
                'company_email'       => 'zenfrost23@gmail.com',
                'company_phone'       => '0182894347',
                'ssm_no'              => '202301004444',
                'ssm_img'             => '',
                'category'            => 'Kategori B',
                'type_of_business'    => 'Premis perniagaan hardware',
                'location'            => 'Nilai – Hadapan / Lorong / Belakang',
                'location_img'        => '',
                'location_coords'     => '2.8123,101.9777',
                'total_parking'       => 3,
                'ic_img'              => '',
                'licence_img'         => '',
                'app_status'          => 'not_approved',
                'app_status_msg'      => 'Permohonan anda tidak berjaya. Sila semak sebab penolakan dan hantar semula.',
                'not_approved_reason' => 'Dokumen SSM tidak jelas dan susah dibaca. Sila muat naik semula salinan yang lebih jelas.',
                'painted_lot_img'     => null,
                'set_date_painted'    => null,
                'end_date_painted'    => null,
                'total_amount'        => 240.00,
                'created_at'          => Carbon::create(2026, 7, 1),
                'updated_at'          => Carbon::create(2026, 7, 3),
            ],
            [
                'app_no'              => 'MBS-20260615-0002',
                'user_id'             => $userId,
                'company_name'        => 'Zainol Hardware Trading',
                'company_email'       => 'zenfrost23@gmail.com',
                'company_phone'       => '0182894347',
                'ssm_no'              => '202301003333',
                'ssm_img'             => '',
                'category'            => 'Kategori B',
                'type_of_business'    => 'Premis perniagaan hardware',
                'location'            => 'Seremban – Kawasan belum warta',
                'location_img'        => '',
                'location_coords'     => '2.7260,101.9450',
                'total_parking'       => 8,
                'ic_img'              => '',
                'licence_img'         => '',
                'app_status'          => 'completed',
                'app_status_msg'      => 'Permohonan anda telah diluluskan dan pembayaran telah diterima.',
                'not_approved_reason' => null,
                'painted_lot_img'     => '',
                'set_date_painted'    => '2026-06-20',
                'end_date_painted'    => '2027-06-19',
                'total_amount'        => 720.00,
                'created_at'          => Carbon::create(2026, 6, 15),
                'updated_at'          => Carbon::create(2026, 6, 18),
            ],
            [
                'app_no'              => 'MBS-20260615-0003',
                'user_id'             => $userId,
                'company_name'        => 'Zainol Auto Parts',
                'company_email'       => 'zenfrost23@gmail.com',
                'company_phone'       => '0182894347',
                'ssm_no'              => '202301002222',
                'ssm_img'             => '',
                'category'            => 'Kategori A',
                'type_of_business'    => 'Premis perniagaan menjual tayar / menjual bateri / bengkel kenderaan',
                'location'            => 'Seremban',
                'location_img'        => '',
                'location_coords'     => '2.7350,101.9501',
                'total_parking'       => 4,
                'ic_img'              => '',
                'licence_img'         => '',
                'app_status'          => 'approved',
                'app_status_msg'      => 'Tahniah! Permohonan anda telah diluluskan. Sila buat pembayaran untuk mengaktifkan permit.',
                'not_approved_reason' => null,
                'painted_lot_img'     => null,
                'set_date_painted'    => null,
                'end_date_painted'    => null,
                'total_amount'        => 260.00,
                'created_at'          => Carbon::create(2026, 6, 15),
                'updated_at'          => Carbon::create(2026, 6, 20),
            ],
            [
                'app_no'              => 'MBS-20260615-0004',
                'user_id'             => $userId,
                'company_name'        => 'Zainol Enterprise',
                'company_email'       => 'zenfrost23@gmail.com',
                'company_phone'       => '0182894347',
                'ssm_no'              => '202301001111',
                'ssm_img'             => '',
                'category'            => 'Kategori B',
                'type_of_business'    => 'Bank / kedai pajak gadai / syarikat kewangan',
                'location'            => 'Seremban – Hadapan (Kategori B)',
                'location_img'        => '',
                'location_coords'     => '2.7297,101.9422',
                'total_parking'       => 2,
                'ic_img'              => '',
                'licence_img'         => '',
                'app_status'          => 'pending',
                'app_status_msg'      => 'Permohonan telah diterima dan sedang menunggu semakan pegawai.',
                'not_approved_reason' => null,
                'painted_lot_img'     => null,
                'set_date_painted'    => null,
                'end_date_painted'    => null,
                'total_amount'        => 360.00,
                'created_at'          => Carbon::now(),
                'updated_at'          => Carbon::now(),
            ],
        ]);

        // Resolve app_ids for notification FK
        $appIds = DB::table('application')->pluck('app_id', 'app_no');

        // ────────────────────────────────────────────────────────────────────
        // PAYMENT
        // ────────────────────────────────────────────────────────────────────
        DB::table('payment')->insert([
            [
                'user_id'        => $userId,
                'app_no'         => 'MBS-20260615-0002',
                'invoice_no'     => 'INV-2026-00001',
                'payment_type'   => 'FPX / Bank',
                'total_amt'      => 720.00,
                'payment_status' => 'paid',
                'created_at'     => Carbon::create(2026, 6, 18),
            ],
            [
                'user_id'        => $userId,
                'app_no'         => 'MBS-20260701-0001',
                'invoice_no'     => 'INV-2026-00002',
                'payment_type'   => 'Kad Kredit / Debit',
                'total_amt'      => 240.00,
                'payment_status' => 'failed',
                'created_at'     => Carbon::create(2026, 7, 2),
            ],
        ]);

        // ────────────────────────────────────────────────────────────────────
        // NOTIFICATIONS
        // ────────────────────────────────────────────────────────────────────
        DB::table('notification')->insert([

            // ── Failed/rejected application ──────────────────────────────
            [
                'user_id'      => $userId,
                'app_id'       => $appIds['MBS-20260701-0001'],
                'noti_type'    => 'app_submitted',
                'noti_message' => 'Permohonan MBS-20260701-0001 (Zainol Trading Co) telah berjaya dihantar.',
                'is_read'      => true,
                'created_at'   => Carbon::create(2026, 7, 1),
            ],
            [
                'user_id'      => $userId,
                'app_id'       => $appIds['MBS-20260701-0001'],
                'noti_type'    => 'not_approved',
                'noti_message' => 'Permohonan MBS-20260701-0001 (Zainol Trading Co) tidak diluluskan. Sebab: Dokumen SSM tidak jelas. Sila muat naik semula dan hantar permohonan baru.',
                'is_read'      => false,
                'created_at'   => Carbon::create(2026, 7, 3),
            ],

            // ── Completed application ────────────────────────────────────
            [
                'user_id'      => $userId,
                'app_id'       => $appIds['MBS-20260615-0002'],
                'noti_type'    => 'app_submitted',
                'noti_message' => 'Permohonan MBS-20260615-0002 (Zainol Hardware Trading) telah berjaya dihantar.',
                'is_read'      => true,
                'created_at'   => Carbon::create(2026, 6, 15),
            ],
            [
                'user_id'      => $userId,
                'app_id'       => $appIds['MBS-20260615-0002'],
                'noti_type'    => 'app_approved',
                'noti_message' => 'Tahniah! Permohonan MBS-20260615-0002 (Zainol Hardware Trading) telah diluluskan. Sila buat pembayaran RM720.00.',
                'is_read'      => true,
                'created_at'   => Carbon::create(2026, 6, 16),
            ],
            [
                'user_id'      => $userId,
                'app_id'       => $appIds['MBS-20260615-0002'],
                'noti_type'    => 'payment_received',
                'noti_message' => 'Pembayaran INV-2026-00001 berjumlah RM720.00 telah berjaya diterima. Permit petak anda kini aktif.',
                'is_read'      => true,
                'created_at'   => Carbon::create(2026, 6, 18),
            ],

            // ── Approved application ─────────────────────────────────────
            [
                'user_id'      => $userId,
                'app_id'       => $appIds['MBS-20260615-0003'],
                'noti_type'    => 'app_submitted',
                'noti_message' => 'Permohonan MBS-20260615-0003 (Zainol Auto Parts) telah berjaya dihantar.',
                'is_read'      => true,
                'created_at'   => Carbon::create(2026, 6, 15),
            ],
            [
                'user_id'      => $userId,
                'app_id'       => $appIds['MBS-20260615-0003'],
                'noti_type'    => 'app_approved',
                'noti_message' => 'Tahniah! Permohonan MBS-20260615-0003 (Zainol Auto Parts) telah diluluskan. Sila buat pembayaran RM260.00 untuk mengaktifkan permit.',
                'is_read'      => false,
                'created_at'   => Carbon::create(2026, 6, 20),
            ],

            // ── Pending application ──────────────────────────────────────
            [
                'user_id'      => $userId,
                'app_id'       => $appIds['MBS-20260615-0004'],
                'noti_type'    => 'app_submitted',
                'noti_message' => 'Permohonan MBS-20260615-0004 (Zainol Enterprise) telah berjaya dihantar dan sedang menunggu semakan.',
                'is_read'      => false,
                'created_at'   => Carbon::now(),
            ],
        ]);
    }
}