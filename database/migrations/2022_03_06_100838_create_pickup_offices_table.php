<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Domain\Contracts\PickupOfficeContract;

class CreatePickupOfficesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(PickupOfficeContract::TABLE, function (Blueprint $table) {
            $table->id();
            $table->string(PickupOfficeContract::OFFICE);
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
        Schema::dropIfExists(PickupOfficeContract::TABLE);
    }
}
