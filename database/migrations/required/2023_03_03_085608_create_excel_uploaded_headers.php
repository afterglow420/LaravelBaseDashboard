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
        if(!Schema::hasTable('excel_uploaded_headers')) {
            Schema::create('excel_uploaded_headers', function (Blueprint $table) {
                $table->id();
                $table->string('column_headers');
                $table->unsignedBigInteger('excel_upload_id');
                $table->foreign('excel_upload_id')->references('id')->on('excel_upload_models');
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
        Schema::dropIfExists('excel_uploaded_headers');
    }
};
