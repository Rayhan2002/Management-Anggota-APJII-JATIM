<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('anggota', function (Blueprint $table) {
                $table->id();
                $table->bigInteger('noreg')->unique();
                $table->string('nama_per');
                $table->string('nama_brand');
                $table->string('jenis_izin');
                $table->enum('pusat',['lokal','cabang']);
                $table->string('media');
                $table->string('jenis_wireless')->nullable();
                $table->string('coverage');
                $table->text('alamat');
                $table->char('province_id');
                $table->foreign('province_id')
                    ->references('id')
                    ->on('provinces')
                    ->onUpdate('cascade')->onDelete('cascade');
                $table->char('regency_id');
                $table->foreign('regency_id')
                    ->references('id')
                    ->on('regencies')
                    ->onUpdate('cascade')->onDelete('cascade');
                $table->char('district_id');
                $table->foreign('district_id')
                    ->references('id')
                    ->on('districts')
                    ->onUpdate('cascade')->onDelete('cascade');
                $table->char('village_id');
                $table->foreign('village_id')
                    ->references('id')
                    ->on('villages')
                    ->onUpdate('cascade')->onDelete('cascade');
                $table->integer('rt');
                $table->integer('rw');
                $table->integer('kode_pos');
                $table->string('pic');
                $table->bigInteger('wa');
                $table->string('email');
                $table->string('pic2')->nullable();
                $table->bigInteger('wa2')->nullable();
                $table->string('email2')->nullable();
                $table->string('image')->nullable();
                $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('anggota');
    }
};
