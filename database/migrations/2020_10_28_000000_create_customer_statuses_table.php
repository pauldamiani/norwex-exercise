<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCustomerStatusesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customer_statuses', function (Blueprint $table) {
            $table->id('customerstatusid');
            $table->string('code');
            $table->string('name');
            $table->timestamps();
        });

        DB::table('customer_statuses')->insert(
            array(
                'code' => 'AC',
                'name' => 'Active',
            )
        );

        DB::table('customer_statuses')->insert(
            array(
                'code' => 'RC',
                'name' => 'Removed',
            )
        );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('customer_statuses');
    }
}