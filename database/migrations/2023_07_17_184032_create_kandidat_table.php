<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKandidatTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('kandidat', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->string('partai');
            $table->string('foto');
            $table->string('status');
            $table->timestamps();
        });

        // Tambahkan kode untuk menambahkan data awal ke dalam tabel 'kandidat' jika diperlukan
        $this->seedData();
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::dropIfExists('kandidat');
    }

    /**
     * Seed data ke dalam tabel 'kandidat'.
     */
    private function seedData()
    {
        $data = [
            [
                'nama' => 'Kandidat 1',
                'partai' => 'Partai A',
                'foto' => 'foto1.jpg',
                'status' => 'belum ditentukan',
            ],
            [
                'nama' => 'Kandidat 2',
                'partai' => 'Partai B',
                'foto' => 'foto2.jpg',
                'status' => 'kalah',
            ],
            [
                'nama' => 'Kandidat 3',
                'partai' => 'Partai C',
                'foto' => 'foto3.jpg',
                'status' => 'menang',
            ],
        ];

        DB::table('kandidat')->insert($data);
    }
}
