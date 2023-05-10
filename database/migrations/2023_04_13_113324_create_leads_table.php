<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLeadsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('leads', function (Blueprint $table) {
            $table->id()->unsigned();
            $table->string('name',50)->nullable();
            $table->enum('status',['conveted','inprocess', 'onhold','pending'])->default('pending');
            $table->string('email',150)->nullable();
            $table->string('phone_no',50);
            $table->foreignId('user_id')->constrained('users');
            $table->foreignId('campaign_id')->constrained('campaigns');
            $table->timestamps();
            $table->softDeletes();

            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('leads');
    }
}
