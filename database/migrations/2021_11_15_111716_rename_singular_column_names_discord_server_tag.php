<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RenameSingularColumnNamesDiscordServerTag extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('discord_server_tag', function (Blueprint $table) {
            $table->renameColumn('discord_servers_id', 'discord_server_id');
            $table->renameColumn('tags_id', 'tag_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('discord_server_tag', function (Blueprint $table) {
            $table->renameColumn('discord_server_id', 'discord_servers_id');
            $table->renameColumn('tag_id', 'tags_id');
        });
    }
}
