<?php

Route::namespace('Leekman\AuthenticateAsAnyone')
    ->prefix(config('AuthenticateAsAnyoneConfig.route-prefix'))
    ->middleware(array_merge(['web'], config('AuthAsAnyone.middlewares')))
    ->group(function ()
    {
        Route::get('/', 'AuthenticateAsAnyoneController@index');
    });
