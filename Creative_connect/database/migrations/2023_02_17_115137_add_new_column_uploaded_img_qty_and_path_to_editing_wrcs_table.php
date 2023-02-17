<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddNewColumnUploadedImgQtyAndPathToEditingWrcsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('editing_wrcs', function (Blueprint $table) {
            $table->integer('uploaded_img_qty')->default(0)->length(10)->unsigned()->after('invoice_number');
            $table->string('file_path')->nullable()->after('uploaded_img_qty');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('editing_wrcs', function (Blueprint $table) {
            $table->dropColumn('uploaded_img_qty');
            $table->dropColumn('file_path');
        });
    }
}
