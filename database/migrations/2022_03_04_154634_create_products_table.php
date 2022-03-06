<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Domain\Contracts\ProductContract;

class CreateProductsTable extends Migration
{
    /**
    * Run the migrations.
    *
    * @return  void
    */
    public function up()
    {
        Schema::create(ProductContract::TABLE, function (Blueprint $table) {
            $table->id();
        $table
            ->unsignedBigInteger(ProductContract::CATEGORY_ID)
                    ->nullable()
                        ;
        $table
            ->string(ProductContract::TITLE)
                        ;
        $table
            ->text(ProductContract::DESCRIPTION)
                        ;
        $table
            ->integer(ProductContract::PRICE)
                        ;
        $table
            ->integer(ProductContract::OLD_PRICE)
                        ;
        $table
            ->boolean(ProductContract::IS_HIT)
                        ;
        $table
            ->boolean(ProductContract::IS_LATEST)
                        ;
                            $table->softDeletes();
                    $table->timestamps();
        });
    }

    /**
    * Reverse the migrations.
    *
    * @return  void
    */
    public function down()
    {
        Schema::dropIfExists(ProductContract::TABLE);
    }
}
