<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class KomponenSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('komponens')->insert([
            [
                'kode_komponen' => 'JE-01 AP002',
                'nama_komponen' => 'JE-01 AP002',
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s"),
            ],
            [
                'kode_komponen' => 'JKT01 CX811',
                'nama_komponen' => 'JKT01 CX811',
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s"),
            ],
            [
                'kode_komponen' => 'JKT03 CX811',
                'nama_komponen' => 'JKT03 CX811',
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s"),
            ],
            [
                'kode_komponen' => 'KWA01 AA050',
                'nama_komponen' => 'KWA01 AA050',
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s"),
            ]
        ]);
    }
}
