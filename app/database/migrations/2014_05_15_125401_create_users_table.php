<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::table("users", function($table) {
            $table->create();
            $table->increments("id");
            $table->varchar("name", 255);
            $table->varchar("email");
            $table->varchar("password", 60);
            $table->varchar("permission");
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
        Schema::drop("users");
    }

}
