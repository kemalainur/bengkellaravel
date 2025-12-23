<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Item;

class ItemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $items = [
            // Parts
            [
                'iditem' => 'PRT001',
                'namaitem' => 'Oli Mesin AHM SPX2 0.8L',
                'harga' => 65000,
                'jenis' => 'part',
                'qty' => 100
            ],
            [
                'iditem' => 'PRT002',
                'namaitem' => 'Filter Udara Beat',
                'harga' => 45000,
                'jenis' => 'part',
                'qty' => 50
            ],
            [
                'iditem' => 'PRT003',
                'namaitem' => 'Busi NGK CPR9EA-9',
                'harga' => 35000,
                'jenis' => 'part',
                'qty' => 75
            ],
            [
                'iditem' => 'PRT004',
                'namaitem' => 'Kampas Rem Depan',
                'harga' => 55000,
                'jenis' => 'part',
                'qty' => 40
            ],
            [
                'iditem' => 'PRT005',
                'namaitem' => 'V-Belt Vario 125',
                'harga' => 185000,
                'jenis' => 'part',
                'qty' => 25
            ],
            [
                'iditem' => 'PRT006',
                'namaitem' => 'Roller Set CVT',
                'harga' => 95000,
                'jenis' => 'part',
                'qty' => 30
            ],
            // Jasa
            [
                'iditem' => 'JSA001',
                'namaitem' => 'Ganti Oli',
                'harga' => 25000,
                'jenis' => 'jasa',
                'qty' => 999
            ],
            [
                'iditem' => 'JSA002',
                'namaitem' => 'Tune Up Ringan',
                'harga' => 75000,
                'jenis' => 'jasa',
                'qty' => 999
            ],
            [
                'iditem' => 'JSA003',
                'namaitem' => 'Service CVT',
                'harga' => 150000,
                'jenis' => 'jasa',
                'qty' => 999
            ],
            [
                'iditem' => 'JSA004',
                'namaitem' => 'Ganti Kampas Rem',
                'harga' => 35000,
                'jenis' => 'jasa',
                'qty' => 999
            ],
            [
                'iditem' => 'JSA005',
                'namaitem' => 'Service Besar',
                'harga' => 250000,
                'jenis' => 'jasa',
                'qty' => 999
            ],
        ];

        foreach ($items as $item) {
            Item::create($item);
        }
    }
}
