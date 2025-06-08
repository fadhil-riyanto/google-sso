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
        Schema::create('guest_user', function (Blueprint $table) {
            $table->id();
            $table->string("name")->unique();
            $table->text("picture")->unique();
            $table->text("email")->unique();
            $table->text("password")->unique(); // this is dummy, not actually used in
                                                // oauth, just for authenticatable class to be work
            $table->text("token")->unique();
            $table->smallInteger("g_auth_expires_in");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('guest_user');
    }
};
