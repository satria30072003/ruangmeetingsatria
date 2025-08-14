<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
public function up(): void
{
Schema::create('reservasi', function (Blueprint $table) {
    $table->id();
    $table->unsignedBigInteger('room_id');
    $table->string('email')->nullable();
    $table->string('nama_pemesan');
    $table->string('no_whatsapp', 20);
    $table->date('tanggal');
    $table->time('waktu_mulai');
    $table->time('waktu_selesai');
    $table->enum('status', ['menunggu', 'disetujui', 'ditolak'])->default('menunggu');
    $table->timestamps();

    $table->foreign('room_id')->references('id')->on('rooms')->onDelete('cascade');
});


}

public function down(): void
{
Schema::dropIfExists('reservasi');
}
};