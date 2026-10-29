<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Exceptions\HttpResponseException;

use App\Models\{
    Film,
};
use App\Interfaces\MovieRepositoryInterface;
use App\Classes\ApiResponseClass;
use App\Http\Resources\MovieResource;

class MovieController extends Controller
{
    private MovieRepositoryInterface $movieRepositoryInterface;

    public function __construct(MovieRepositoryInterface $movieRepositoryInterface)
    {
        $this->movieRepositoryInterface = $movieRepositoryInterface;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $data = $this->movieRepositoryInterface->index();

        return ApiResponseClass::sendResponse(MovieResource::collection($data), '', 200);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): JsonResponse
    {
        //
        $validated = $request->validate([
            'title'    => ['required', 'string', 'max:255'],
            'sinopsis' => ['required', 'string', 'max:2000'],
            'year'     => ['required', 'integer', 'min:1900', 'max:' . (date('Y') + 5)],
            'genre_id' => ['required', 'integer', 'exists:genres,id'],
            'poster'   => ['required', 'string', 'max:255'],
        ]);

        DB::beginTransaction();

        try {
            $movie = $this->movieRepositoryInterface->store($validated);

            DB::commit();

            return ApiResponseClass::sendResponse(
                new MovieResource($movie),
                'Movie created successfully.',
                201
            );
        } catch (\Exception $e) {
            ApiResponseClass::rollback($e);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id): JsonResponse
    {
        //
        $movie = $this->movieRepositoryInterface->getById($id);

        return ApiResponseClass::sendResponse(new MovieResource($movie), '', 200);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id): JsonResponse
    {
        //
        $movie = $this->movieRepositoryInterface->getById($id);

        $validated = $request->validate([
            'title'    => ['sometimes', 'required', 'string', 'max:255'],
            'sinopsis' => ['sometimes', 'required', 'string', 'max:2000'],
            'year'     => ['sometimes', 'required', 'integer', 'min:1900', 'max:' . (date('Y') + 5)],
            'genre_id' => ['sometimes', 'required', 'integer', 'exists:genres,id'],
            'poster'   => ['sometimes', 'required', 'string', 'max:255'],
        ]);

        DB::beginTransaction();

        try {
            $this->movieRepositoryInterface->update($validated, $id);

            DB::commit();

            return ApiResponseClass::sendResponse(
                new MovieResource($movie->fresh()),
                'Movie updated successfully.',
                200
            );
        } catch (\Exception $e) {
            ApiResponseClass::rollback($e);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id): JsonResponse
    {
        //
        $this->movieRepositoryInterface->delete($id);

        return ApiResponseClass::sendResponse($id, 'Movie deleted successfully.', 200);
    }
}
