<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class LaravelTrackableCreateTrackedJobsTable extends Migration
{
    /**
     * @var string
     */
    private $table_name = '';
    /**
     * @var bool
     */
    private $usingUuid = false;

    public function __construct()
    {
        $this->table_name = config('trackable-jobs.tables.tracked_jobs', 'tracked_jobs');
        $this->usingUuid = config('trackable-jobs.using_uuid', false);
    }

    public function up()
    {
        Schema::create($this->table_name, function (Blueprint $table) {
            $this->usingUuid
                ? $table->uuid('uuid')->primary()
                : $table->id();
            $table->string('trackable_id')->index();
            $table->string('trackable_type')->index();
            $table->string('name');
            $table->string('status')->default('queued');
            $table->longText('output')->nullable();
            $table->timestamp('started_at')->nullable();
            $table->timestamp('finished_at')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists($this->table_name);
    }
}
