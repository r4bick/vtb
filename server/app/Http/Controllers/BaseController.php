<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Laravel\Lumen\Routing\Controller as LumenBaseController;

class BaseController extends LumenBaseController
{

    protected static string $model = '';

    /**
     * @return Model
     * @throws Exception
     */
    protected static function getModelInstance(): Model
    {
        if (static::$model !== '') {
            return new static::$model();
        }

        throw new Exception('Model was not be set');
    }

    /**
     * @param Request $request
     * @param string|int $id
     *
     * @return array
     * @throws Exception
     */
    public function show(Request $request, string|int $id): array
    {
        $instance = static::getModelInstance();

        return $instance->newQuery()
            ->with($request->get('withs', []))
            ->findOrFail($id)
            ->toArray();
    }

    /**
     * @param Request $request
     *
     * @return array
     * @throws Exception
     */
    public function showAll(Request $request): array
    {
        $instance = static::getModelInstance();

        return $instance->newQuery()
            ->with($request->get('withs', []))
            ->get()
            ->toArray();
    }

    /**
     * @param Request $request
     *
     * @return array
     */
    public function create(Request $request): array
    {
        return [];
    }
}
