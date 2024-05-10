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
        // création table pivot pour gérer la relation many to many entre notes et tags
        Schema::create('note_tag', function (Blueprint $table) {
            $table->id();
            // suppression en cascade, si on supprime une note, les commentaires attachés le seont aussi
            $table->foreignId('note_id')->constrained()->cascadeOnDelete();
            $table->foreignId('tag_id')->constrained()->cascadeOnDelete();
            // timestamps = created_at et updated_at
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('note_tag');
    }
};
