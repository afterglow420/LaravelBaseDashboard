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
        if (!Schema::hasTable('excel_upload_models')) {
            Schema::create('excel_upload_models', function (Blueprint $table) {
                $table->id();
                $table->string('excel_file_name');
                $table->string('excel_file_path');
            });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('excel_upload_models');
    }
};
