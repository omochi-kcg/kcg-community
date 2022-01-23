<?php

use App\Models\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangeUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->integer('grade')->nullable()->change();
            $table->string('department')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {

            //Since we are setting data to not allow NULL anymore, we need to make sure there are no NULL values.
            User::whereNull('grade')->orWhereNull('department')->update([
                'grade' => 0,
                'department' => '',
            ]);

            $table->integer('grade')->nullable(false)->change();
            $table->string('department')->nullable(false)->change();
        });
    }
}
