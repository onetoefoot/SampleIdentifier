<?php

Route::group(['prefix' => 'api', 'middleware' => ['auth:api', 'tenancy.enforce']], function(){
    Route::apiResource('sampleidentifier', 'Onetoefoot\\Sampleidentifier\\Controllers\\Api\\SiRecordController',[
        'as' => 'api'
    ]);
});