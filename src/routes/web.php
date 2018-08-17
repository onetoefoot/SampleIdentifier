<?php

Route::group(['middleware' => ['web', 'auth', 'tenancy.enforce']], function(){
    Route::resource('sampleidentifier', 'Onetoefoot\\Sampleidentifier\\Controllers\\SiRecordController');
});
