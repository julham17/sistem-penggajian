<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Karyawan;

class KaryawanSeeder extends Seeder
{
    public function run(): void
    {
        $data = [
            [
                'username' => 'indah',
                'email' => 'indah.susanti@example.com',
                'password' => 'password',
                'role' => 'karyawan',
                'nama_lengkap' => 'Indah Susanti',
                'nip' => '1987001',
                'jabatan' => 'Staff HR',
                'divisi' => 'HRD',
                'nomor_telepon' => '085444037154',
                'alamat' => 'Jl. Peta No. 30, Bojongloa Kaler, Bandung',
                'tanggal_masuk' => '2021-06-01'
            ],
            [
                'username' => 'farhan',
                'email' => 'farhan.kurniawan@example.com',
                'password' => 'password',
                'role' => 'karyawan',
                'nama_lengkap' => 'Farhan Kurniawan',
                'nip' => '1987002',
                'jabatan' => 'Admin Gudang',
                'divisi' => 'Logistik',
                'nomor_telepon' => '083988133320',
                'alamat' => 'Jl. Pasteur No. 5, Sukajadi, Bandung',
                'tanggal_masuk' => '2022-01-12'
            ],
            [
                'username' => 'eka',
                'email' => 'eka.sari@example.com',
                'password' => 'password',
                'role' => 'karyawan',
                'nama_lengkap' => 'Eka Sari',
                'nip' => '1987003',
                'jabatan' => 'Staff Keuangan',
                'divisi' => 'Keuangan',
                'nomor_telepon' => '085033604715',
                'alamat' => 'Jl. Pasteur No. 5, Sukajadi, Bandung',
                'tanggal_masuk' => '2023-02-18'
            ],
            [
                'username' => 'rizki',
                'email' => 'rizki.maulana@example.com',
                'password' => 'password',
                'role' => 'karyawan',
                'nama_lengkap' => 'Rizki Maulana',
                'nip' => '1987004',
                'jabatan' => 'Operator Produksi',
                'divisi' => 'Produksi',
                'nomor_telepon' => '085792304785',
                'alamat' => 'Jl. Cibaduyut No.10, Bandung',
                'tanggal_masuk' => '2020-03-14'
            ],
            [
                'username' => 'dian',
                'email' => 'dian.safitri@example.com',
                'password' => 'password',
                'role' => 'karyawan',
                'nama_lengkap' => 'Dian Safitri',
                'nip' => '1987005',
                'jabatan' => 'Staff Marketing',
                'divisi' => 'Pemasaran',
                'nomor_telepon' => '085733917231',
                'alamat' => 'Jl. Braga No.27, Bandung',
                'tanggal_masuk' => '2019-07-22'
            ],
            [
                'username' => 'bagas',
                'email' => 'bagas.tri@example.com',
                'password' => 'password',
                'role' => 'karyawan',
                'nama_lengkap' => 'Bagas Tri Nugroho',
                'nip' => '1987006',
                'jabatan' => 'Teknisi',
                'divisi' => 'IT Support',
                'nomor_telepon' => '087823445113',
                'alamat' => 'Jl. Sukajadi No.123, Bandung',
                'tanggal_masuk' => '2021-10-05'
            ],
            [
                'username' => 'sari',
                'email' => 'sari.wulandari@example.com',
                'password' => 'password',
                'role' => 'karyawan',
                'nama_lengkap' => 'Sari Wulandari',
                'nip' => '1987007',
                'jabatan' => 'Customer Service',
                'divisi' => 'Layanan Pelanggan',
                'nomor_telepon' => '081234567891',
                'alamat' => 'Jl. Setiabudi No.45, Bandung',
                'tanggal_masuk' => '2022-01-10'
            ],
            [
                'username' => 'agus',
                'email' => 'agus.hidayat@example.com',
                'password' => 'password',
                'role' => 'karyawan',
                'nama_lengkap' => 'Agus Hidayat',
                'nip' => '1987008',
                'jabatan' => 'Staff Logistik',
                'divisi' => 'Logistik',
                'nomor_telepon' => '085655984341',
                'alamat' => 'Jl. Kopo No.67, Bandung',
                'tanggal_masuk' => '2018-09-18'
            ],
            [
                'username' => 'intan',
                'email' => 'intan.amalia@example.com',
                'password' => 'password',
                'role' => 'karyawan',
                'nama_lengkap' => 'Intan Amalia',
                'nip' => '1987009',
                'jabatan' => 'Staff Administrasi',
                'divisi' => 'Administrasi',
                'nomor_telepon' => '087734985621',
                'alamat' => 'Jl. Buah Batu No.88, Bandung',
                'tanggal_masuk' => '2020-08-21'
            ],
            [
                'username' => 'yoga',
                'email' => 'yoga.permana@example.com',
                'password' => 'password',
                'role' => 'karyawan',
                'nama_lengkap' => 'Yoga Permana',
                'nip' => '1987010',
                'jabatan' => 'Driver',
                'divisi' => 'Operasional',
                'nomor_telepon' => '085299773421',
                'alamat' => 'Jl. Riau No.39, Bandung',
                'tanggal_masuk' => '2017-05-11'
            ],
            [
                'username' => 'nina',
                'email' => 'nina.kartika@example.com',
                'password' => 'password',
                'role' => 'karyawan',
                'nama_lengkap' => 'Nina Kartika',
                'nip' => '1987011',
                'jabatan' => 'Staff Produksi',
                'divisi' => 'Produksi',
                'nomor_telepon' => '083873456012',
                'alamat' => 'Jl. Sukarno Hatta No.25, Bandung',
                'tanggal_masuk' => '2021-03-09'
            ],
            [
                'username' => 'rehan',
                'email' => 'rehan.fauzan@example.com',
                'password' => 'password',
                'role' => 'karyawan',
                'nama_lengkap' => 'Rehan Fauzan',
                'nip' => '1987012',
                'jabatan' => 'Keamanan',
                'divisi' => 'Security',
                'nomor_telepon' => '082345678901',
                'alamat' => 'Jl. Ciumbuleuit No.12, Bandung',
                'tanggal_masuk' => '2019-12-01'
            ],
            [
                'username' => 'fitri',
                'email' => 'fitri.rahmawati@example.com',
                'password' => 'password',
                'role' => 'karyawan',
                'nama_lengkap' => 'Fitri Rahmawati',
                'nip' => '1987013',
                'jabatan' => 'Analis Keuangan',
                'divisi' => 'Keuangan',
                'nomor_telepon' => '081224785421',
                'alamat' => 'Jl. Antapani No.30, Bandung',
                'tanggal_masuk' => '2020-06-25'
            ],
            [
                'username' => 'indra',
                'email' => 'indra.putra@example.com',
                'password' => 'password',
                'role' => 'karyawan',
                'nama_lengkap' => 'Indra Putra',
                'nip' => '1987014',
                'jabatan' => 'HR Staff',
                'divisi' => 'SDM',
                'nomor_telepon' => '082234875623',
                'alamat' => 'Jl. Cimindi No.19, Bandung',
                'tanggal_masuk' => '2018-10-01'
            ],
            [
                'username' => 'mega',
                'email' => 'mega.rizky@example.com',
                'password' => 'password',
                'role' => 'karyawan',
                'nama_lengkap' => 'Mega Rizky',
                'nip' => '1987015',
                'jabatan' => 'Content Creator',
                'divisi' => 'Pemasaran',
                'nomor_telepon' => '083123498732',
                'alamat' => 'Jl. Sukamulya No.54, Bandung',
                'tanggal_masuk' => '2022-04-17'
            ],
            [
                'username' => 'andi',
                'email' => 'andi.sutrisna@example.com',
                'password' => 'password',
                'role' => 'karyawan',
                'nama_lengkap' => 'Andi Sutrisna',
                'nip' => '1987016',
                'jabatan' => 'Staff Pengadaan',
                'divisi' => 'Logistik',
                'nomor_telepon' => '085723498123',
                'alamat' => 'Jl. Batununggal No.7, Bandung',
                'tanggal_masuk' => '2021-07-08'
            ],
            [
                'username' => 'tika',
                'email' => 'tika.marlina@example.com',
                'password' => 'password',
                'role' => 'karyawan',
                'nama_lengkap' => 'Tika Marlina',
                'nip' => '1987017',
                'jabatan' => 'Desainer Grafis',
                'divisi' => 'Kreatif',
                'nomor_telepon' => '081233498122',
                'alamat' => 'Jl. Cisaranten No.78, Bandung',
                'tanggal_masuk' => '2019-11-13'
            ],
            [
                'username' => 'budi',
                'email' => 'budi.santoso@example.com',
                'password' => 'password',
                'role' => 'karyawan',
                'nama_lengkap' => 'Budi Santoso',
                'nip' => '1987018',
                'jabatan' => 'Staff Warehouse',
                'divisi' => 'Gudang',
                'nomor_telepon' => '082122348764',
                'alamat' => 'Jl. Rancasari No.44, Bandung',
                'tanggal_masuk' => '2020-12-30'
            ],
            [
                'username' => 'lina',
                'email' => 'lina.agustina@example.com',
                'password' => 'password',
                'role' => 'karyawan',
                'nama_lengkap' => 'Lina Agustina',
                'nip' => '1987019',
                'jabatan' => 'Staff Cleaning',
                'divisi' => 'Kebersihan',
                'nomor_telepon' => '085622341234',
                'alamat' => 'Jl. Cijerah No.11, Bandung',
                'tanggal_masuk' => '2017-03-06'
            ],
            [
                'username' => 'farhan',
                'email' => 'farhan.maulana@example.com',
                'password' => 'password',
                'role' => 'karyawan',
                'nama_lengkap' => 'Farhan Maulana',
                'nip' => '1987020',
                'jabatan' => 'Staff IT',
                'divisi' => 'IT Support',
                'nomor_telepon' => '082144567897',
                'alamat' => 'Jl. Holis No.65, Bandung',
                'tanggal_masuk' => '2022-09-14'
            ],
        ];

        foreach ($data as $item) {
            $user = User::create([
                'username' => $item['username'],
                'email' => $item['email'],
                'password' => Hash::make($item['password']),
                'role' => $item['role']
            ]);

            Karyawan::create([
                'user_id' => $user->id,
                'nama_lengkap' => $item['nama_lengkap'],
                'nip' => $item['nip'],
                'jabatan' => $item['jabatan'],
                'divisi' => $item['divisi'],
                'nomor_telepon' => $item['nomor_telepon'],
                'alamat' => $item['alamat'],
                'tanggal_masuk' => $item['tanggal_masuk']
            ]);
        }
    }
}
