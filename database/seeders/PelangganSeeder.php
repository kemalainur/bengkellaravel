<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Pelanggan;

class PelangganSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $pelanggans = [
            [
                'idpelanggan' => 'PLG001',
                'nama' => 'Budi Santoso',
                'alamat' => 'Jl. Merdeka No. 123, Jakarta Selatan'
            ],
            [
                'idpelanggan' => 'PLG002',
                'nama' => 'Siti Rahayu',
                'alamat' => 'Jl. Sudirman No. 45, Jakarta Pusat'
            ],
            [
                'idpelanggan' => 'PLG003',
                'nama' => 'Ahmad Wijaya',
                'alamat' => 'Jl. Gatot Subroto No. 67, Bandung'
            ],
            [
                'idpelanggan' => 'PLG004',
                'nama' => 'Dewi Lestari',
                'alamat' => 'Jl. Diponegoro No. 89, Surabaya'
            ],
            [
                'idpelanggan' => 'PLG005',
                'nama' => 'Eko Prasetyo',
                'alamat' => 'Jl. Ahmad Yani No. 101, Semarang'
            ],
        ];

        foreach ($pelanggans as $pelanggan) {
            Pelanggan::create($pelanggan);
        }
    }
}
