<?php

Route::namespace('Leekman\AuthenticateAsAnyone')
    ->prefix(config('auth-as-anyone.route-prefix'))
    ->middleware(array_merge(['web'], config('auth-as-anyone.middlewares')))
    ->group(function ()
    {
        Route::get('/', 'AuthenticateAsAnyoneController@index');
    });
