<?php


// Add web middleware for use Laravel feature
Route::group(['middleware' => 'web'], function () {

    //add admin prefix and middleware for admin area to user module
    Route::group(['prefix' => 'admin', 'middleware' => 'IsAdmin'], function () {
        Route::resource('/menu', 'Tir\Menu\Controllers\AdminMenuController');
        Route::resource('/menuItem', 'Tir\Menu\Controllers\AdminMenuItemController');
    });

});