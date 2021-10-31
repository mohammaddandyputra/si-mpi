<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGangguansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('gangguans', function (Blueprint $table) {
            $table->id();
            $table->string('kode_komponen');
            $table->dateTime('tanggal_gangguan');
            $table->timestamps();
            $table->text('desc');
            $table->unsignedBigInteger('id_perbaikan')->nullable();

            $table->foreign('kode_komponen')->references('kode_komponen')->on('komponens');
            $table->foreign('id_perbaikan')->references('id')->on('perbaikans');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // Schema::table('gangguans', function(Blueprint $table){
        //     $table->dropForeign('gangguans_kode_komponen_foreign');
        // });

        Schema::dropIfExists('gangguans');
    }
}
