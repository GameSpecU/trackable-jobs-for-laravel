<?php

return [
    /*
     | The table where the tracked jobs will be stored.
     | By default, it's called 'tracked_jobs'.
     */
    'tables' => [
        'tracked_jobs' => 'tracked_jobs',
    ],


    /*
     | This config determine how old your (in days) models should be before they get pruned.
     | If null, it will not delete any models.
     */
    'prunable_after' => null
];
