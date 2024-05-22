<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('rpas', function (Blueprint $table) {
            $table->id();
            $table->string('manufacturer', 65);
            $table->string('serial_no', 65);
            $table->string('model_no', 65);
            $table->string('cert_no', 65);
            $table->string('nickname', 65);
            $table->foreignId('rpastype_id')->constrained()->cascadeOnDelete();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->boolean('safety_agreement')->default(false);
            $table->timestamp('registered_at')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rpas');
    }
};
