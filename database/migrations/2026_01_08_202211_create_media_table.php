<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('media', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('file_name');
            $table->string('original_name');
            $table->string('mime_type');
            $table->string('path');
            $table->unsignedBigInteger('size');
            $table->json('metadata')->nullable();
            $table->text('alt_text')->nullable();
            $table->text('description')->nullable();
            $table->foreignId('media_category_id')->nullable()->constrained()->onDelete('set null');
            $table->foreignId('uploaded_by')->constrained('users')->onDelete('cascade');
            $table->timestamp('used_at')->nullable();
            $table->timestamps();

            $table->index(['media_category_id', 'created_at']);
            $table->index('mime_type');
            $table->index('used_at');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('media');
    }
};