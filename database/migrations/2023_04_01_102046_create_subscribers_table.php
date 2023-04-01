<?php

use Domain\Shared\Models\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('subscribers', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(User::class)->constrained()->cascadeOnDelete();
            $table->string('email');
            $table->string('first_name');
            $table->string('last_name')->nullable();
            $table->foreignId('form_id')->nullable()->constrained()->nullOnDelete();
            $table->dateTime('subscribed_at')->useCurrent();
            $table->timestamps();

            $table->unique(['user_id', 'email']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('subscribers');
    }
};
