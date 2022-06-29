<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
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
        Schema::create('repair_services', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('parent_id')->nullable();
            $table->foreign('parent_id')->references('id')->on('repair_services')->onDelete('set null');
            $table->string('name');
            $table->text('description');
            $table->timestamps();
        });

        Schema::create('repair_service_repairman',function (Blueprint $table){
            $table->unsignedBigInteger('repair_service_id');
            $table->foreign('repair_service_id')->references('id')->on('repair_services')->onDelete('cascade');
            $table->unsignedBigInteger('repairman_id');
            $table->foreign('repairman_id')->references('id')->on('repairmen')->onDelete('cascade');
            $table->primary(['repair_service_id','repairman_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('repair_service_repairman');
        Schema::dropIfExists('repair_services');
    }
};
