<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('quotes', function (Blueprint $table) {
            $table->id();
            $table->string('reference')->unique();
            $table->string('name');
            $table->string('email')->nullable(); // phone leads may not have one
            $table->string('phone');
            $table->string('service')->default('home-removals');
            $table->string('from_postcode');
            $table->string('to_postcode');
            $table->string('property_size');
            $table->date('move_date')->nullable();
            $table->boolean('flexible_date')->default(false);
            $table->json('extras')->nullable();
            $table->text('notes')->nullable();
            $table->string('status')->default('new')->index();
            $table->decimal('estimate', 10, 2)->nullable();
            $table->string('source')->default('website');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('quotes');
    }
};
