<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('files', function (Blueprint $table) {
            // Renomeia o campo
            $table->renameColumn('file_content', 'file_path');
            
            // Altera o tipo de dado do campo
            $table->text('file_path')->change();
        });
    }

    /**
     * Reverte as alterações feitas pela migration.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('files', function (Blueprint $table) {
            // Reverte o nome do campo
            $table->renameColumn('file_path', 'file_content');
            
            // Reverte o tipo de dado para string
            $table->binary('file_content')->change();
        });
    }
};
