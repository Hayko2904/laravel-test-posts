<?php


namespace App\Repository;


use Illuminate\Http\Request;
use Closure;

interface ServiceInterface
{
    public function doIndex($model, ?Closure $method = null);

    public function doCreate(Request $request, $model, ?Closure $method = null);

    public function doUpdate(Request $request, $id, $model, ?Closure $method = null, $userId = null);

    public function doDelete(int $id, $model, $userId = null, ?Closure $method = null);
}
