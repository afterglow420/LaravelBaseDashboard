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
        if(!Schema::hasTable('excel_uploaded_rows')) {
            Schema::create('excel_uploaded_rows', function (Blueprint $table) {
                $table->id();
                $table->string('row_data');
                $table->unsignedBigInteger('excel_uploaded_headers_id');
                $table->unsignedBigInteger('excel_upload_id');
                $table->foreign('excel_uploaded_headers_id')->references('id')->on('excel_uploaded_headers');
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
        Schema::dropIfExists('excel_uploaded_rows');
    }
};
