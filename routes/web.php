<?php

use Illuminate\Support\Facades\Route;

Route::get('/',[\App\Http\Controllers\HomeController::class,'index']);

Route::resource('qizlar',\App\Http\Controllers\QizController::class);
