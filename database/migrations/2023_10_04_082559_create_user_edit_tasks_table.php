<?php

use App\Models\User;
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
        Schema::create('user_edit_tasks', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(User::class);
            $table->string('name')->nullable();
            $table->string('email')->nullable();
            $table->string('city')->nullable();
            $table->boolean('status')->default(false);
            $table->string('citizenship')->nullable();
            $table->integer('confirmation_code');
            $table->integer('sending_service');
            $table->string('password');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_edit_tasks');
    }
};
