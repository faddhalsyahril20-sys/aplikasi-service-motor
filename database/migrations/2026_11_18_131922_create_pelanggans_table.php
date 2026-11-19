
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (!Schema::hasTable('pelanggans')) {
            Schema::create('pelanggans', function (Blueprint $table) {
                $table->id();
                $table->string('nama_lengkap');
                $table->string('no_hp', 20);
                $table->text('alamat_pelanggan');
                $table->string('pekerjaan');
                $table->timestamps();
            });

            return;
        }

        if (!Schema::hasColumn('pelanggans', 'nama_lengkap')) {
            Schema::table('pelanggans', function (Blueprint $table) {
                $table->string('nama_lengkap');
            });
        }

        if (!Schema::hasColumn('pelanggans', 'no_hp')) {
            Schema::table('pelanggans', function (Blueprint $table) {
                $table->string('no_hp', 20);
            });
        }

        if (!Schema::hasColumn('pelanggans', 'alamat_pelanggan')) {
            Schema::table('pelanggans', function (Blueprint $table) {
                $table->text('alamat_pelanggan');
            });
        }

        if (!Schema::hasColumn('pelanggans', 'pekerjaan')) {
            Schema::table('pelanggans', function (Blueprint $table) {
                $table->string('pekerjaan');
            });
        }
    }

    public function down(): void
    {
        // Tidak menghapus tabel atau data pelanggan saat rollback.
    }
};
