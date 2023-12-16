<?php


use HammamZarefa\RapidRanker\Controllers\LevelController;

//Route::middleware('admin')->group(function () {
    Route::apiResource('levels', LevelController::class);
    Route::get('level-history', 'LevelController@getUserLevelsHistory')->name('user.level.history');
//});