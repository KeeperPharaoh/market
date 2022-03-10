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
                ->nullable();
            $table
                ->string(ProductContract::TITLE);
            $table
                ->json(ProductContract::IMAGES)
                ->default(json_encode(['products/no-photo.jpg', 'products/no-photo.jpg']));
            $table
                ->text(ProductContract::DESCRIPTION)
                ->nullable();
            $table
                ->integer(ProductContract::PRICE);
            $table
                ->integer(ProductContract::OLD_PRICE)
                ->nullable();
            $table
                ->boolean(ProductContract::IS_HIT)
                ->default(false);
            $table
                ->boolean(ProductContract::IS_LATEST)
                ->default(false);
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
