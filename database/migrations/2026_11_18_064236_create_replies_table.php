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
        Schema::create('replies', function (Blueprint $table) {
            $table->id('repid');
            $table->unsignedBigInteger('messageeeid'); // Target message/comment ID being replied to
            $table->string('messagetype', 20)->nullable(); // e.g., 'chat', 'comment'
            $table->text('message');
            $table->boolean('readstatus')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('replies');
    }
};
