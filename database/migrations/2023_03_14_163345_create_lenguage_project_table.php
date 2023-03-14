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
        Schema::create('lenguage_project', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('lenguage_id');
            $table->unsignedBigInteger('project_id');

            $table->foreign('lenguage_id')->references('id')->on('lenguages');
            $table->foreign('project_id')->references('id')->on('projects');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('lenguage_project');
    }
};
