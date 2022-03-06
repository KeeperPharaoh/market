<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Domain\Contracts\OrderContract;

class CreateOrdersTable extends Migration
{
    /**
    * Run the migrations.
    *
    * @return  void
    */
    public function up()
    {
        Schema::create(OrderContract::TABLE, function (Blueprint $table) {
            $table->id();
        $table
            ->unsignedBigInteger(OrderContract::USER_ID)
                    ->nullable()
                        ;
        $table
            ->string(OrderContract::NAME)
            ->nullable()
                        ;
        $table
            ->string(OrderContract::SURNAME)
            ->nullable()
                        ;
        $table
            ->string(OrderContract::EMAIL)
                            ->nullable()
                ;
        $table
            ->string(OrderContract::PHONE)
                            ->nullable()
                ;
        $table
            ->text(OrderContract::COMMENT)
                    ->nullable()
                        ;
        $table
            ->string(OrderContract::STREET)
                    ->nullable()
                        ;
        $table
            ->string(OrderContract::HOME)
                            ->nullable()
                ;
        $table
            ->string(OrderContract::APARTMENT)
                    ->nullable()
                        ;
        $table
            ->string(OrderContract::ENTRANCE)
                    ->nullable()
                        ;
        $table
            ->string(OrderContract::FLOOR)
                    ->nullable()
                        ;
        $table
            ->unsignedBigInteger(OrderContract::OFFICE)
                    ->nullable()
                        ;
        $table
            ->enum(OrderContract::STATUS, [CREATED, IN_PROCESSING, DELIVERY_IN_PROGRESS, DELIVERED])
                    ->default(CREATED)
                        ;
        $table
            ->string(OrderContract::PAYMENT_ID)
                    ->nullable()
                        ;
        $table
            ->string(OrderContract::PAYMENT_STATUS)
                    ->nullable()
                        ;
        $table
            ->integer(OrderContract::SUM)
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
        Schema::dropIfExists(OrderContract::TABLE);
    }
}
