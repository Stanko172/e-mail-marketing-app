<?php

use Domain\Mail\Enums\Sequence\SequenceStatus;
use Domain\Shared\Models\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSequencesTable extends Migration
{
    public function up(): void
    {
        Schema::create('sequences', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(User::class)->constrained()->cascadeOnDelete();
            $table->string('title');
            $table->string('status')->default(SequenceStatus::Draft->value);
            $table->timestamps();

            $table->unique(['user_id', 'title']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sequences');
    }
}
