<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHelplinesLogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('helplines_logs', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('reference_id')->nullable();            // insident_id
            $table->foreign('reference_id')->references('id')->on('helplines')->onDelete('cascade');
            $table->string('change'); // UPDATE, DELETE, CREATE etc
            $table->integer('changed_by')->unsigned()->nullable();
            $table->foreign('changed_by')->references('id')->on('users'); // who made the change?
            $table->boolean('is_it_hotline');
            $table->boolean('forwarded');
            $table->string('submission_type');
            // user profile
            $table->text('name')->nullable();
            $table->text('surname')->nullable();
            $table->text('email')->nullable();
            $table->text('phone')->nullable();
            $table->string('age')->nullable();
            $table->string('gender')->nullable();
            $table->string('report_role')->nullable();
            // report description
            $table->string('resource_type');
            $table->text('resource_url')->nullable();
            $table->string('content_type');
            $table->text('comments')->nullable();
            // operator actions
            $table->integer('user_opened')->unsigned()->nullable();          // user_opened_id
            $table->foreign('user_opened')->references('id')->on('users');   // user_id
            $table->unsignedInteger('user_assigned')->nullable();            // user_assigned_id
            $table->foreign('user_assigned')->references('id')->on('users'); // user_id
            
            $table->string('priority')->default('normal');
            $table->string('reference_by')->nullable();
            $table->string('reference_to')->nullable();
            $table->longtext('actions')->nullable();
            $table->string('status')->default('New');
            // misc
            $table->text('specialty')->nullable();
            //manager comments
            $table->text('manager_comments')->nullable();
            //field to connect insident with another
            $table->unsignedInteger('insident_reference_id')->nullable();            // link with another insident_id
            //the call time
            $table->dateTime('call_time')->default(DB::raw('CURRENT_TIMESTAMP'));

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
        Schema::dropIfExists('helplines_logs');
    }
}
