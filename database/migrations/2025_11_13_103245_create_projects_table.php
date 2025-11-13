<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('projects', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->foreignId('client_id')->nullable()->constrained()->nullOnDelete();
            $table->text('description')->nullable();
            $table->string('cover_photo')->nullable();
            $table->enum('status', ['planned', 'active',
                'on_hold', 'completed', 'cancelled'])->default('planned');
            $table->timestamps();
            $table->softDeletes();
            $table->unique(['client_id', 'name']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('projects');
    }
};
