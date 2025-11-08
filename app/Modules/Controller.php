<?php

namespace App\Modules;

use App\Http\Controllers\Controller as BaseController;
use App\Modules\Services\CrudService;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;

abstract class Controller extends BaseController
{
    protected CrudService $service;
    protected array $with = [];
    protected ?string $orderBy = null;
    protected ?string $resourceName = null;
    protected ?string $resourceClass = null;


    public function __construct()
    {
        $controller = class_basename(static::class);
        $modelName = Str::replaceLast('Controller', '', $controller);

        $nameSpaceParts = explode('\\', static::class);
        $moduleKey = array_search('Modules', $nameSpaceParts);
        $moduleName = $moduleKey !== false && isset($nameSpaceParts[$moduleKey + 1]) ? $nameSpaceParts[$moduleKey + 1] : null;

        $modelClass = $moduleName ? "App\\Modules\\{$moduleName}\\Models\\{$modelName}" : "App\\Models\\{$modelName}";

        if (!class_exists($modelClass)) {
            throw new \Exception("Model {$modelClass} not found");
        }

        $possibleResource = $moduleName ? "App\\Modules\\{$moduleName}\\Resources\\{$modelName}Resource" : "App\\Http\\Resources\\{$modelName}Resource";

        $this->resourceClass = class_exists($possibleResource) ? $possibleResource : null;

        $model = new $modelClass();
        $rules = property_exists($modelClass, 'rules') ? $modelClass::$rules : [];

        $this->service = new CrudService($model, $rules);
        // $this->relationService = new RelationService($model);
        $this->resourceName = $this->resourceClass ?? Str::camel($modelName);
    }

    protected function transform($data)
    {
        if ($this->resourceClass) {
            $resource = $this->resourceClass;
            return $data instanceof Collection ? $resource::collection($data) : new $resource($data);
        }
        return $data;
    }

    /* -------------------------------------------------------------------------
    |  CRUD
    |------------------------------------------------------------------------*/
    public function index()
    {
        $items = $this->service->all($this->with, $this->orderBy);
        return sendApiResponse([$this->resourceName => $this->transform($items)], ucfirst($this->resourceName) . ' fetched successfully.');
    }

    public function show($id)
    {
        $item = $this->service->find($id, $this->with);
        if (!$item) {
            return sendApiError('Not found', 404);
        }

        return sendApiResponse([$this->resourceName => $this->transform($item)], ucfirst($this->resourceName) . ' retrieved successfully.');
    }

    public function store(Request $request)
    {
        try {
            $item = $this->service->create($request->all());
            return sendApiResponse([$this->resourceName => $this->transform($item)], ucfirst($this->resourceName) . ' created successfully.', 201);
        } catch (ValidationException $e) {
            return sendApiError('Validation failed', 422, $e->errors());
        } catch (QueryException $e) {
            return sendApiError('Failed to create record', 500, $e->getMessage());
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $item = $this->service->update($id, $request->all());
            if (!$item) {
                return sendApiError('Not found', 404);
            }
            return sendApiResponse([$this->resourceName => $this->transform($item)], ucfirst($this->resourceName) . ' updated successfully.');
        } catch (ValidationException $e) {
            return sendApiError('Validation failed', 422, $e->errors());
        } catch (QueryException $e) {
            return sendApiError('Failed to update record', 500, $e->getMessage());
        }
    }

    public function destroy($id)
    {
        try {
            $model = $this->service->find($id);
            if (!$model) {
                return sendApiError('Not found', 404);
            }

            $model->delete();

            return sendApiResponse(ucfirst($this->resourceName) . ' deleted successfully.');
        } catch (QueryException $e) {
            return sendApiError('Failed to delete record', 500, $e->getMessage());
        }
    }


}
