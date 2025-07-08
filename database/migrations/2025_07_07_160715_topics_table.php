<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('topic_tables', function (Blueprint $table) {
            $table->id();
            $table->char('subject', 255);
            $table->date('date');
            $table->char('category', 255);
            $table->char('topic_by', 255);
        });

        Schema::create('category_tables', function (Blueprint $table) {
            $table->id();
            $table->char('icon', 255)->nullable();
            $table->char('name', 255);
            $table->char('desc', 255)->nullable();
        });

        Schema::create('post_tables', function (Blueprint $table) {
            $table->id();
            $table->text('reply_content');
            $table->char('reply_date', 255);
            $table->char('reply_topic', 255);
            $table->char('reply_by', 255);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
