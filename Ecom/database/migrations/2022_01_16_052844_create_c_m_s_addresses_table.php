<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCMSAddressesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('c_m_s_addresses', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('address1');
            $table->text('address2')->nullable();
            $table->string('state');
            $table->string('country');
            $table->bigInteger('mobile');
            $table->bigInteger('fax');
            $table->string('email');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('c_m_s_addresses');
    }
}
