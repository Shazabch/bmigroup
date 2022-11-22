<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddDocsColumnsAtPayments extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('payments', function (Blueprint $table) {
            $table->string('invoice_doc')->nullable(); 
            $table->string('do_doc')->nullable(); 
            $table->string('dn_doc')->nullable(); 
            $table->string('cn_doc')->nullable(); 
            $table->string('reference_id')->nullable(); 
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('payments', function (Blueprint $table) {
            $table->dropColumn(['invoice_doc','do_doc','dn_doc','cn_doc','reference_id']);
        });
    }
}
