<?php

Route::group(['middleware' => ['web', 'auth']], function(){
    Route::group(['middleware' => 'tenancy.enforce'], function () {
            Route::resource('sampleidentifier', 'Onetoefoot\\Sampleidentifier\\Controllers\\RecordController');
    });
});
