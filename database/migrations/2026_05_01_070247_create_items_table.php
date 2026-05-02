<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('drop_id')->nullable()->constrained()->nullOnDelete();
            $table->string('title');
            $table->string('slug')->unique();
            $table->text('description')->nullable();
            $table->enum('category', ['tops', 'bottoms', 'outerwear', 'accessories', 'shoes', 'bags']);
            $table->string('size')->nullable();
            $table->enum('condition', ['mint', 'excellent', 'good', 'fair'])->default('good');
            $table->decimal('price', 10, 2);
            $table->enum('status', ['available', 'reserved', 'sold'])->default('available');
            $table->string('instagram_url')->nullable();
            $table->string('cover_image')->nullable();
            $table->json('measurements')->nullable();
            $table->timestamps();

            $table->index(['status', 'category']);
            $table->index('drop_id');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('items');
    }
};
