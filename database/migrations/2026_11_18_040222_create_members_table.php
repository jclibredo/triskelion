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
       Schema::create('members', function (Blueprint $table) {
            $table->id('memberid');
            $table->string('firstname', 50);
            $table->string('lastname', 50);
            $table->string('middlename', 50)->nullable();
            $table->string('sex', 1);
            $table->date('birthdate');
            $table->string('tcode', 20)->nullable();
            $table->date('tbirth')->nullable();
            $table->integer('t6')->index()->nullable();
            $table->string('talexis', 50)->nullable();
            $table->string('tbatchname', 60)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('members');
    }
};
