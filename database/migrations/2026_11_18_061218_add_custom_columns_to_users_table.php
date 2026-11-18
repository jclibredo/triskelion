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
        Schema::table('users', function (Blueprint $table) {
            $table->unsignedBigInteger('memberid')->nullable()->after('email');
            $table->bigInteger('mobilenumber')->nullable()->after('memberid');
            $table->string('accountType', 20)->nullable()->after('mobilenumber');
            $table->integer('typeid')->nullable()->after('accountType');
            $table->boolean('status')->default(true)->after('typeid');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['memberid', 'mobilenumber', 'accountType', 'typeid', 'status']);
        });
    }
};
