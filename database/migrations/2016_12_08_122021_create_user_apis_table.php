<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use App\Models\Api;
use App\Models\UserApi;

class CreateUserApisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_apis', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users');
            $table->integer('api_id')->unsigned();
            $table->foreign('api_id')->references('id')->on('apis');
            $table->string('api_key', 40)->unique();
            $table->timestamp('invite_sent_at');
            $table->boolean('accepted_invite')->default(0);
            $table->timestamps();
        });

        UserApi::unguard();

        foreach(Api::all() as $api) {
            UserApi::create([
                'user_id' => $api->user_id,
                'api_id' => $api->id,
                'api_key' => $api->key,
                'invite_sent_at' => \Carbon\Carbon::now(),
                'accepted_invite' => true,
            ]);
        }

        UserApi::reguard();

        Schema::table('apis', function(Blueprint $table) {
            $table->dropForeign('apis_user_id_foreign');
            $table->dropColumn('user_id');
            $table->dropColumn('key');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user_apis');
    }
}
