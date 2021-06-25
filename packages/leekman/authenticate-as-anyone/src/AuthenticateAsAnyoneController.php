<?php

namespace Leekman\AuthenticateAsAnyone;

use App\Http\Controllers\Controller;

class AuthenticateAsAnyoneController extends Controller
{
    public function index()
    {
        $data = collect();

        foreach (config('auth-as-anyone.models') as $modelName => $modelData) {
            $pathModel = $modelData['namespace'].'\\'.$modelName;
            $instance = new $pathModel;
            $modelCollection = $instance->paginate(10);

            $nameAttribute = $modelData['columns']['name'];
            $firstNameAttribute = $modelData['columns']['firstname'];
            $loginAttribute = $modelData['columns']['login'];

            foreach ($modelCollection as $modelCollectionValue) {
                $modelCollectionValue->aaaName = $modelCollectionValue->$nameAttribute;
                $modelCollectionValue->aaaFirstName = $modelCollectionValue->$firstNameAttribute;
                $modelCollectionValue->aaaLogin = $modelCollectionValue->$loginAttribute;
            }

            $data->push((object) [
                'models' => $modelCollection,
                'prettyName' => $modelData['pretty-name'],
            ]);
        }

        return view('authenticate-as-anyone::index', compact('data'));
    }
}
