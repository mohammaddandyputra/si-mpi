<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PerbaikanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('perbaikans')->insert([
            [
                'id' => 1,
                'tanggal_perbaikan' => date('2020-06-10 11:56:36'),
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
                'tindakan' => 'Penggantian : 1 set Blade (Fan, bearing, poros) motor fan',
            ],
            [
                'id' => 2,
                'tanggal_perbaikan' => date('2021-02-11 11:56:36'),
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
                'tindakan' => 'Dilakukan perbaikan pada katup KWA01 AA050, Telah diuji CF003 (KBE02) = 0,45 m2/h, CP001 (KWA01) = 3 bar',
            ]
        ]);
    }
}
