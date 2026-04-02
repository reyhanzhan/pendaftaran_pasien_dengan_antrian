<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Antrian (Queue) Configuration
    |--------------------------------------------------------------------------
    |
    | Configuration for the patient queue system
    |
    */

    // Maximum patients per time slot
    'max_per_slot' => env('ANTRIAN_MAX_PER_SLOT', 5),

    // Time slot duration in minutes
    'slot_duration' => env('ANTRIAN_SLOT_DURATION', 60),

    // Default queue start time
    'default_start_time' => env('ANTRIAN_START_TIME', '08:00'),

    // Default queue end time
    'default_end_time' => env('ANTRIAN_END_TIME', '17:00'),

    // Enable online consultation
    'enable_online_consultation' => env('ANTRIAN_ONLINE_ENABLED', true),
];
