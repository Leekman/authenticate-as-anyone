<?php

namespace Leekman\AuthenticateAsAnyone;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;

class AuthenticateAsAnyoneController extends Controller
{
    private $models;

    public function __construct()
    {
        $this->models = config('auth-as-anyone.models');
    }

    /**
     * @return Application|Factory|View
     * @author Valentin Estreguil <valentin.estreguil@akawam.com>
     */
    public function index()
    {
        $data = collect();

        foreach ($this->models as $modelName => $modelData) {
            $pathModel = $this->getModelNamespace($modelData).'\\'.$modelName;
            $instance = new $pathModel;
            $modelCollection = $instance->paginate(10);

            $attributes = $this->getAttributes($modelData);

            foreach ($modelCollection as $modelCollectionValue) {
                $this->addAuthenticateAttributes($modelCollectionValue, $attributes);
            }

            $data->push((object) [
                'models' => $modelCollection,
                'modelName' => $modelName,
                'prettyName' => $modelData['pretty-name'],
            ]);
        }

        return view('authenticate-as-anyone::index', compact('data'));
    }

    /**
     * @param $model
     * @param $userId
     * @return RedirectResponse
     * @author Valentin Estreguil <estreguil.valentin@gmail.com>
     */
    public function auth($model, $userId): RedirectResponse
    {
        $models = $this->models;
        if (!array_key_exists($model, $models)) {
            return redirect()->back()->withError('Model doesnt exists');
        }

        $modelData = $models[$model];
        $pathModel = $this->getModelNamespace($modelData).'\\'.$model;

        $user = (new $pathModel)->find($userId);
        if (empty($user)) {
            return redirect()->back()->withError('Could not find user');
        }

        $this->handleSessions($user, $modelData);
        Auth::guard($modelData['guard'])->login($user);


        return redirect()->route('dashboard');
    }

    public function logBack(){

    }

    /**
     * @param  array  $modelData
     * @return string
     * @author Valentin Estreguil <estreguil.valentin@gmail.com>
     */
    private function getModelNamespace(array $modelData): string
    {
        return $modelData['namespace'] ?? 'App\Models';
    }

    private function handleSessions($user, $modelData): void
    {
        [$currentUser, $currentGuard, $currentModelData] = $this->getCurrentUser();
        if (empty($currentUser)) {
            abort(404);
        }

        $attributes = $this->getAttributes($currentModelData);
        $this->addAuthenticateAttributes($currentUser, $attributes);

        $attributes = $this->getAttributes($modelData);
        $this->addAuthenticateAttributes($user, $attributes);

        session()->put('aaa.origin-user', $currentUser);
        session()->put('aaa.origin-guard', $currentGuard);
        session()->put('aaa.user', $user);
        session()->put('aaa.user-guard', $modelData['guard']);
    }

    /**
     * @return array|null
     * @author Valentin Estreguil <valentin.estreguil@akawam.com>
     */
    private function getCurrentUser(): ?array
    {
        $guardsData = [];
        foreach ($this->models as $model) {
            $guardsData[$model['guard']] = $model;
        }

        foreach ($guardsData as $guard => $modelData) {
            if (Auth::guard($guard)->check()) {
                return [Auth::guard($guard)->user(), $guard, $modelData];
            }
        }
        return null;
    }

    /**
     * @param $modelData
     * @return array
     * @author Valentin Estreguil <valentin.estreguil@akawam.com>
     */
    private function getAttributes($modelData): array
    {
        return [
            'id' => $modelData['columns']['id'] ?? 'id',
            'name' => $modelData['columns']['name'] ?? 'name',
            'firstname' => $modelData['columns']['firstname'] ?? 'firstname',
            'login' => $modelData['columns']['login'] ?? 'email',
        ];
    }

    /**
     * @param $model
     * @param $attributes
     * @author Valentin Estreguil <valentin.estreguil@akawam.com>
     */
    private function addAuthenticateAttributes($model, $attributes): void
    {
        [$id, $name, $firstName, $login] =
            [
                $attributes['id'],
                $attributes['name'],
                $attributes['firstname'],
                $attributes['login'],
            ];

        $model->aaaId = $model->$id;
        $model->aaaName = $model->$name;
        $model->aaaFirstName = $model->$firstName;
        $model->aaaLogin = $model->$login;
    }
}
