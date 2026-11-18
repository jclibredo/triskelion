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
        Schema::create('comments', function (Blueprint $table) {
            $table->id('commentid');
            $table->text('message');
            $table->unsignedBigInteger('contentid'); // Can link to postid or other content
            $table->unsignedBigInteger('author')->nullable();
            $table->string('contenttype')->nullable(); // e.g., 'post', 'event'
            $table->boolean('readstatus')->default(false);
            $table->boolean('status')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('comments');
    }
};
