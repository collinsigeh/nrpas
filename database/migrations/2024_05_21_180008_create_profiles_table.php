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
        Schema::create('profiles', function (Blueprint $table) {
            $table->id();
            $table->string('suffix', 65)->nullable();
            $table->string('firstname', 65);
            $table->string('lastname', 65);
            $table->string('middlename', 65)->nullable();
            $table->string('phone', 20);
            $table->string('country', 65);
            $table->string('street_address', 160);
            $table->string('apt_no', 20)->nullable(); // Apartment number
            $table->string('city', 65);
            $table->string('state', 65);
            $table->string('postcode', 10)->nullable();
            $table->string('org_name', 100)->nullable();
            $table->string('rcc_no', 20)->nullable();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('profiles');
    }
};
