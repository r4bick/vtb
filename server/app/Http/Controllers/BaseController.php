<?php

namespace App\Http\Controllers;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Laravel\Lumen\Routing\Controller as LumenBaseController;

class BaseController extends LumenBaseController
{

    protected static string $model = '';

    protected static function getModelInstance(): Model
    {
        if (static::$model) {
            return new static::$model();
        }

        return new static::$model();
    }

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
     */
    public function create(Request $request): array
    {
        return [];
    }
}
