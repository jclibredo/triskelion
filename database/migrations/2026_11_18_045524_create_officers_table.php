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
        Schema::create('officers', function (Blueprint $table) {
            $table->id('officerid');
            $table->unsignedBigInteger('rankid')->index();
            $table->unsignedBigInteger('memberid')->index();
            $table->unsignedBigInteger('chapid')->index()->nullable();
            $table->unsignedBigInteger('areaid')->index()->nullable();
            $table->unsignedBigInteger('councilid')->index()->nullable();
            $table->boolean('status')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('officers');
    }
};
