<?php


use HammamZarefa\RapidRanker\Controllers\LevelController;

Route::apiResource('levels', LevelController::class);
Route::get('level-history','LevelController@getUserLevelsHistory')->name('user.level.history');