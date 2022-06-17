<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateTableAgenda extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('agendas', function (Blueprint $table) {
            $table->string('dari')->nullable()->after('nama');
            $table->string('status')->default('disetujui')->after('dari');
            $table->string('keterangan')->nullable()->after('status');
            $table->timestamp('sampai')->nullable()->after('waktu');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('agendas', function (Blueprint $table) {
            $table->dropColumn('dari');
            $table->dropColumn('status');
            $table->dropColumn('keterangan');
            $table->dropColumn('sampai');
        });
    }
}
