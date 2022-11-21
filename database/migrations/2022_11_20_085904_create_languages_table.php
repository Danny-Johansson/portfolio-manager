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
    public function up()
    {
        Schema::create('languages', function (Blueprint $table) {
            $table->id();

            $table->string('name');
            $table->unsignedBigInteger('speak');
            $table->unsignedBigInteger('read');
            $table->unsignedBigInteger('write');
            $table->unsignedBigInteger('understand');


            $table->foreign('speak')
                ->references('id')
                ->on('language_levels')
                ->onDelete('cascade')
            ;

            $table->foreign('read')
                ->references('id')
                ->on('language_levels')
                ->onDelete('cascade')
            ;

            $table->foreign('write')
                ->references('id')
                ->on('language_levels')
                ->onDelete('cascade')
            ;

            $table->foreign('understand')
                ->references('id')
                ->on('language_levels')
                ->onDelete('cascade')
            ;

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
    public function down()
    {
        Schema::dropIfExists('languages');
    }
};
