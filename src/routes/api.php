<?php

Route::group(['middleware' => ['auth:api', 'tenancy.enforce']], function(){
    Route::apiResource('/api/sampleidentifier', 'Onetoefoot\\Sampleidentifier\\Controllers\\Api\\SiRecordController');
});