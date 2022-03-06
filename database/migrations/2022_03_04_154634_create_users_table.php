<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Domain\Contracts\UserContract;

class CreateUsersTable extends Migration
{
    /**
    * Run the migrations.
    *
    * @return  void
    */
    public function up()
    {
        Schema::create(UserContract::TABLE, function (Blueprint $table) {
            $table->id();
        $table
            ->string(UserContract::NAME);
        $table
            ->string(UserContract::SURNAME)
            ->nullable();
        $table
            ->string(UserContract::EMAIL)
                            ->unique();
        $table
            ->string(UserContract::EMAIL_VERIFIED_AT)
                    ->nullable();
        $table
            ->string(UserContract::PHONE)
                            ->unique()
                            ->nullable();
        $table
            ->string(UserContract::PASSWORD)
                    ->nullable();
        $table
            ->string(UserContract::REMEMBER_TOKEN)
                    ->nullable();
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
        Schema::dropIfExists(UserContract::TABLE);
    }
}
