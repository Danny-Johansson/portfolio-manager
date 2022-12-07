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
        Schema::create('jobsearches', function (Blueprint $table) {
            $table->id();

            $table->string('company');
            $table->string('title');
            $table->string('address')->nullable();
            $table->string('article')->nullable();
            $table->string('website')->nullable();
            $table->string('email')->nullable();
            $table->string('phone')->nullable();
            $table->string('person')->nullable();
            $table->timestamp('apply_date')->nullable();

            $table->foreignId('jobsearch_type_id')
                ->constrained()
                ->onDelete('cascade');

            $table->foreignId('jobsearch_status_id')
                ->constrained()
                ->onDelete('cascade');

            $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('updated_at')->default(DB::raw('CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP'));
            $table->timestamp('deleted_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        Schema::dropIfExists('jobsearches');
    }
};
