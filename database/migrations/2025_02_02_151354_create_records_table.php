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
        Schema::create('records', function (Blueprint $table) {
            $table->id(); // Creates an auto-incrementing 'id' column
            $table->string('title'); // 'title' column (string type)
            $table->text('content'); // 'content' column (text type)
            $table->timestamps(); // 'created_at' and 'updated_at' columns
            $table->softDeletes(); // 'deleted_at' column for soft deletes
            
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('records');
    }
};
