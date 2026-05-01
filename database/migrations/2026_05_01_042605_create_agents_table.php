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
        Schema::create('agents', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(User::class)->constrained()->cascadeOnDelete();
            $table->string('first_name');
            $table->string('last_name');
            $table->string('other_name')->nullable();
            $table->string('matricula')->unique();
            $table->unsignedTinyInteger('sex');
            $table->date('birth_date')->nullable();
            $table->string('phone_number')->nullable();
            $table->string('address')->nullable();
            $table->boolean('is_active')->default(false);
            $table->timestamps();

            $table->index(['first_name', 'last_name', 'other_name']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('agents');
    }
};
