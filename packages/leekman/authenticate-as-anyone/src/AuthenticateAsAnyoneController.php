<?php

namespace Leekman\AuthenticateAsAnyone;

use App\Http\Controllers\Controller;

class AuthenticateAsAnyoneController extends Controller
{
    public function index()
    {
        $models = [];
        foreach (config('auth.guards') as $key => $guard)
        {
            if (!in_array($key, config('AuthenticateAsAnyoneConfig.excepts')))
            {
                $models[] = config('auth.providers')[$guard['provider']]['model'];
            }
        }

        $data = collect();
        foreach ($models as $model)
        {
            $instance = new $model;
            $data->push((object) [
                'models' => $instance->all(),
                'name' => $model,
            ]);
        }

        return view('authenticate-as-anyone::index', compact('data'));
    }
}
