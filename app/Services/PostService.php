<?php


namespace App\Services;


use App\Repository\ServiceInterface;
use Illuminate\Http\Request;
use Closure;
use Illuminate\Support\Facades\DB;

class PostService implements ServiceInterface
{
    public function doIndex($model, ?Closure $method = null)
    {
        try {
            DB::beginTransaction();
            $result = is_null($method)
                ? $model::all()
                : $method($model);

            DB::commit();

            return $result;
        } catch (\Exception $e) {
            DB::rollBack();

            return $e->getMessage();
        }
    }

    public function doCreate(Request $request, $model, ?Closure $method = null)
    {
        try {
            DB::beginTransaction();
            $result = is_null($method)
                ? $model->query()->create($request->toArray())
                : $method($model);

            DB::commit();

            return $result;
        } catch (\Exception $e) {
            DB::rollBack();

            return $e->getMessage();
        }
    }

    public function doUpdate(Request $request, $id, $model, ?Closure $method = null, $userId = null)
    {
        try {
            DB::beginTransaction();

            if ($id) {
                $model = is_null($userId)
                    ? $model->find($id)
                    : $model->whereId($id)
                        ->whereUserId($userId)->first();
            }

            $result = is_null($method)
                ? $model->update($request->only('title', 'description', 'public'))
                : $method($model);

            DB::commit();

            return $result;
        } catch (\Exception $e) {
            DB::rollBack();

            return $e->getMessage();
        }
    }

    public function doDelete(int $id, $model, $userId = null, ?Closure $method = null)
    {
        try {
            DB::beginTransaction();

            $model = $id
                ? $model->find($id)
                : $model->whereId($id)
                    ->whereUserId($userId)->first();

            $result = is_null($method)
                ? $model->delete()
                : $method($model);

            DB::commit();

            return $result;
        } catch (\Exception $e) {
            DB::rollBack();

            return $e->getMessage();
        }
    }

    public function doGetById(int $id, $model, $userId = null)
    {
        $post = is_null($userId)
            ? $model->find($id)
            : $model->query()
                ->whereId($id)
                ->whereUserId($userId)
                ->first();

        return $post;
    }

    public function getPostsWithoutAuth($model)
    {
        return $model->wherePublic(1)->get();
    }
}
