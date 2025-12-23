<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Motor;

class MotorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $motors = [
            [
                'nopolisi' => 'B1234ABC',
                'idpelanggan' => 'PLG001',
                'nomesin' => 'JFM1E1234567',
                'tipe' => 'Honda Beat',
                'tahun' => '2022',
                'norangka' => 'MH1JFM112NK123456'
            ],
            [
                'nopolisi' => 'B5678DEF',
                'idpelanggan' => 'PLG001',
                'nomesin' => 'KYT2E7654321',
                'tipe' => 'Honda Vario 125',
                'tahun' => '2021',
                'norangka' => 'MH1KYT210MK654321'
            ],
            [
                'nopolisi' => 'D9876GHI',
                'idpelanggan' => 'PLG002',
                'nomesin' => 'JFZ1E9876543',
                'tipe' => 'Honda Scoopy',
                'tahun' => '2023',
                'norangka' => 'MH1JFZ113PK987654'
            ],
            [
                'nopolisi' => 'L4321JKL',
                'idpelanggan' => 'PLG003',
                'nomesin' => 'KC01E1357924',
                'tipe' => 'Honda PCX 160',
                'tahun' => '2023',
                'norangka' => 'MH1KC011NPK135792'
            ],
            [
                'nopolisi' => 'N8765MNO',
                'idpelanggan' => 'PLG004',
                'nomesin' => 'JFM2E2468013',
                'tipe' => 'Honda Beat Street',
                'tahun' => '2022',
                'norangka' => 'MH1JFM212NK246801'
            ],
            [
                'nopolisi' => 'H1357PQR',
                'idpelanggan' => 'PLG005',
                'nomesin' => 'KVB1E3692581',
                'tipe' => 'Honda Vario 160',
                'tahun' => '2024',
                'norangka' => 'MH1KVB110PK369258'
            ],
        ];

        foreach ($motors as $motor) {
            Motor::create($motor);
        }
    }
}
