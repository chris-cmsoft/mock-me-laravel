<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use App\Models\UserApi;

class CreateUserApiAccessesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_api_accesses', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_api_id')->unsigned();
            $table->foreign('user_api_id')->references('id')->on('user_apis');
            $table->boolean('can_create_routes')->default(0);
            $table->boolean('can_update_routes')->default(0);
            $table->boolean('can_delete_routes')->default(0);
            $table->boolean('can_invite_members')->default(0);
            $table->timestamps();
        });

        foreach(UserApi::all() as $user_api) {
            $user_api->access()->create([
                'can_view_routes' => 1,
                'can_create_routes' => 1,
                'can_update_routes' => 1,
                'can_delete_routes' => 1,
                'can_invite_members' => 1,
            ]);
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user_api_accesses');
    }
}
