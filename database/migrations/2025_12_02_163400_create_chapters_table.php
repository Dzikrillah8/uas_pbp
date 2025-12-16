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
        Schema::create('chapters', function (Blueprint $table) {
            $table->id();
            $table->foreignId('story_id')->constrained()->onDelete('cascade'); 
            $table->string('chap_title');
            $table->string('slug')->unique();
            $table->unique(['story_id', 'slug']);
            $table->text('content');
            $table->integer('urutan');
            $table->unique(['story_id', 'urutan']);
            $table->enum('visibility', ['public', 'draft'])->default('public');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('chapters');
    }
};
