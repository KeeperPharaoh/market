<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Domain\Contracts\CartContract;

class CreateCartsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(CartContract::TABLE, function (Blueprint $table) {
            $table->id();
            $table->integer(CartContract::PRODUCT_ID);
            $table->integer(CartContract::QUANTITY);
            $table->integer(CartContract::ORDER_ID);
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
        Schema::dropIfExists(CartContract::TABLE);
    }
}
