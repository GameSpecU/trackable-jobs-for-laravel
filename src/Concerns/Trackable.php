<?php

namespace Junges\TrackableJobs\Concerns;

use Illuminate\Database\Eloquent\Model;
use Junges\TrackableJobs\Jobs\Middleware\TrackedJobMiddleware;
use Junges\TrackableJobs\Models\TrackedJob;
use Throwable;

trait Trackable
{
    /**
     * @var Model|null
     */
    public $model;

    /**
     * @var TrackedJob|Model
     */
    public $trackedJob;

    public function __construct($model)
    {
        $this->model = $model;

        $this->trackedJob = TrackedJob::create([
            'trackable_id' => $this->model->id ?? $this->model->uuid,
            'trackable_type' => get_class($this->model),
            'name' => class_basename(static::class),
        ]);
    }

    public function middleware(): array
    {
        return [new TrackedJobMiddleware()];
    }

    public function failed(Throwable $exception): void
    {
        $message = $exception->getMessage();

        $this->trackedJob->markAsFailed($message);
    }
}
