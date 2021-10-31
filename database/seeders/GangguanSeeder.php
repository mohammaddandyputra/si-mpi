<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class GangguanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    // JKT01 CX811
    //  JKT03 CX811
    //  KWA01 AA050
    public function run()
    {
        DB::table('gangguans')->insert([
            [
                'kode_komponen' => 'JE-01 AP002',
                'tanggal_gangguan' => '2020-12-09 11:56:36',
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s"),
                'desc' => 'Katup selenoid rusak AA017/018',
                'id_perbaikan' => null,
            ],
            [
                'kode_komponen' => 'JE-01 AP002',
                'tanggal_gangguan' => '2021-03-09 11:56:36',
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s"),
                'desc' => 'Terdapat rembesan oli pada pompa JE-01 AP002',
                'id_perbaikan' => null,
            ],
            [
                'kode_komponen' => 'JE-01 AP002',
                'tanggal_gangguan' => '2021-06-09 11:56:36',
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s"),
                'desc' => 'Motor dan v-belt QKJ01 tidak berfungsi normal',
                'id_perbaikan' => 1,
            ],
            [
                'kode_komponen' => 'KWA01 AA050',
                'tanggal_gangguan' => '2020-02-09 11:56:36',
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s"),
                'desc' => 'Katup KWA01 AA050 mampet',
                'id_perbaikan' => null,
            ],
            [
                'kode_komponen' => 'KWA01 AA050',
                'tanggal_gangguan' => '2021-02-09 11:56:36',
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s"),
                'desc' => 'SCA02 oli kotor',
                'id_perbaikan' => 2,
            ]
        ]);
    }
}
