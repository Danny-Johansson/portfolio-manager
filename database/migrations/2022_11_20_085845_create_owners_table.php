<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        Schema::create('owners', function (Blueprint $table) {
            $table->id();
            $table->string('image')->nullable();

            $table->string('first_name')->nullable();
            $table->string('initials')->nullable();
            $table->string('last_name')->nullable();

            $table->timestamp('birthday')->nullable();

            $table->string('email')->nullable();
            $table->string('phone')->nullable();

            $table->string('country')->nullable();
            $table->string('zip')->nullable();
            $table->string('city')->nullable();
            $table->string('street_name')->nullable();
            $table->string('street_number')->nullable();

            $table->boolean('license')->default(0);

            $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('updated_at')->default(DB::raw('CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP'));
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        Schema::dropIfExists('owners');
    }
};
