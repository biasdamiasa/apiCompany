<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWorksOnsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('works_ons', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('id_emp')->nullable();
            $table->unsignedBigInteger('id_proj')->nullable();
            $table->timestamps();

            $table->foreign('id_emp')->references('id')->on('employees')
                  ->onUpdate('cascade')
                  ->onDelete('set null');
            $table->foreign('id_proj')->references('id')->on('projects')
                  ->onUpdate('cascade')
                  ->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('works_ons');
    }
}
