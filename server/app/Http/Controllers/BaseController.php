<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Laravel\Lumen\Routing\Controller as LumenBaseController;
use Throwable;

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
     * @throws Exception
     * @throws Throwable
     */
    public function create(Request $request): array
    {
        $instance = static::getModelInstance();
        $instance->fill($request->get('attributes'));
        $instance->saveOrFail();

        return $instance->toArray();
    }

    /**
     * @param Request $request
     * @param string|int $id Entity identification.
     *
     * @return array
     * @throws Exception
     * @throws Throwable
     */
    public static function update(Request $request, string|int $id): array
    {
        $instance = static::getModelInstance();
        $instance = $instance->newQuery()->findOrFail($id);
        $instance->fill($request->get('attributes'));
        $instance->saveOrFail();

        return $instance->toArray();
    }
}
