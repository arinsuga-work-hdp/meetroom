<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRoomOrderTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        /**
         * related master tables
         * ======================
         * 1. Room table
         * 2. Order Status table
         * 3. Dept table
         *  
         */
        Schema::create('room_order', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->string('name')->nullable();
            $table->string('phone_ext')->nullable();
            $table->string('email')->nullable();

            //Room ID 1=Postmo; 2=Founder; 3=Interior; 4=Bulat
            $table->integer('room_id')->nullable();
            //Room Ordered for Departement
            $table->bigInteger('dept_id')->nullable();
            //Order Status 1=Open; 2=Approve; 3=reject; 4=cancel
            $table->integer('orderstatus_id')->default(1);
            $table->integer('orderby_id')->nullable();
            $table->integer('orderfor_id')->nullable();
            
            //Number of participants
            $table->integer('participants')->nullable();
            $table->boolean('snack')->default(false);

            $table->text('subject')->nullable();
            $table->text('description')->nullable();
            $table->text('resolution')->nullable();
            $table->string('image')->nullable();

            $table->dateTime('meetingdt')->nullable();
            $table->dateTime('startdt')->nullable();
            $table->dateTime('enddt')->nullable();

            $table->timestamps();
            $table->string('created_by')->nullable();
            $table->string('updated_by')->nullable();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('room_order');
    }
}
