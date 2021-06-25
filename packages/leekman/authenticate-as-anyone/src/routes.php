<?php

Route::namespace('Leekman\AuthenticateAsAnyone')
    ->prefix(config('AuthAsAnyone.route-prefix'))
    ->middleware(array_merge(['web'], config('AuthAsAnyone.middlewares')))
    ->group(function ()
    {
        Route::get('/', 'AuthenticateAsAnyoneController@index');
    });
