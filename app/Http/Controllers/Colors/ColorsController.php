<?php

namespace App\Http\Controllers\Colors;

use App\Http\Controllers\Controller;
use App\Http\Controllers\MainController;
use App\Http\Requests\Color\ColorCreateRequest;
use App\Http\Requests\Color\ColorUpdateRequest;
use App\Http\Resources\Color\ColorResource;
use App\Http\Services\ColorServices\ColorService;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class ColorsController extends MainController
{
    protected $colorService;

    public function __construct(ColorService $colorService)
    {
        $this->colorService = $colorService;
    }

    /**
     * @OA\Get(
     *     path="/api/v1/colors",
     *     tags={"Colors"},
     *     summary="Get all colors",
     *     @OA\Parameter(name="paginate", in="query", description="Paginate the Data", required=false, @OA\Schema(type="boolean")),
     *     @OA\Parameter(name="perPage", in="query", description="Per page", required=false, @OA\Schema(type="integer")),
     *     @OA\Parameter(name="orderBy", in="query", description="Order by", required=false, @OA\Schema(type="string")),
     *     @OA\Parameter(name="order", in="query", description="Order", required=false, @OA\Schema(type="string")),
     *     @OA\Response(response=200, description="Get all colors")
     * )
     */
    public function index(Request $request): JsonResponse
    {
        $colors = $this->colorService->get($request->all());
        if($colors instanceof LengthAwarePaginator)
            return $this->paginatedResponse(__('responses.success') , ColorResource::collection($colors) , Response::HTTP_OK);
        return $this->response(__('responses.success') , ColorResource::collection($colors) , Response::HTTP_OK);
        
    }

    /**
     * @OA\Post(
     *     path="/api/v1/colors",
     *     tags={"Colors"}, 
     *     summary="Create a new color",
     *     @OA\RequestBody(
     *         @OA\JsonContent(ref="App\Http\Requests\Color\ColorCreateRequest")
     *     ),
     *     @OA\Response(response=200, description="Create a new color")
     * )
     */
    public function store(ColorCreateRequest $request): JsonResponse
    {
        $request = $request->validated();
        $color = $this->colorService->create($request);
        return $this->response(__('responses.success') , new ColorResource($color) , Response::HTTP_CREATED);
    }

    /**
     * @OA\Get(
     *     path="/api/v1/colors/{id}",
     *     tags={"Colors"}, 
     *     summary="Get a color by id",
     *     @OA\Parameter(name="id", in="path", description="Id of the color", required=true, @OA\Schema(type="integer")),
     *     @OA\Response(response=200, description="Get a color by id")
     * )
     */
    public function show(int $id): JsonResponse
    {
        $color = $this->colorService->find($id);
        return $this->response(__('responses.success') , new ColorResource($color) , Response::HTTP_OK);
    }

    /**
     * @OA\Put(
     *     path="/api/v1/colors/{id}",
     *     tags={"Colors"}, 
     *     summary="Update a color",
     *     @OA\Parameter(name="id", in="path", description="Id of the color", required=true, @OA\Schema(type="integer")),
     *     @OA\RequestBody(
     *         @OA\JsonContent(ref="App\Http\Requests\Color\ColorUpdateRequest")
     *     ),
     *     @OA\Response(response=200, description="Update a color")
     * )
     */
    public function update(ColorUpdateRequest $request, int $id): JsonResponse
    {
        $color = $this->colorService->update($request->all(), $id);
        return $this->response(__('responses.success') , new ColorResource($color) , Response::HTTP_ACCEPTED);
    }

    /**
     * @OA\Delete(
     *     path="/api/v1/colors/{id}",
     *     tags={"Colors"}, 
     *     summary="Delete a color",
     *     @OA\Parameter(name="id", in="path", description="Id of the color", required=true, @OA\Schema(type="integer")),
     *     @OA\Response(response=200, description="Delete a color")
     * )
     */
    public function destroy(int $id): JsonResponse
    {
        $this->colorService->delete($id);
        return $this->response(__('responses.success') , null , Response::HTTP_NO_CONTENT);
    }
}
