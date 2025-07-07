<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return ['Running backend Laravel' => app()->version()];
});

require __DIR__.'/auth.php';
