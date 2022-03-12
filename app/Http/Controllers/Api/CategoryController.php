<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Record;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CategoryController extends Controller
{
    public function index()
    {
        return Category::with('records')->get();
    }

    /**
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): JsonResponse
    {
        $this->validate($request, [
            'name' => 'required',
        ]);

        $category = Category::create([
            'name' => $request['name'],
        ]);

        return response()->json([
            'category' => $category
        ], Response::HTTP_CREATED);
    }

    public function update(Request $request, $id): JsonResponse
    {
        try {
            $category = Category::findOrFail($id);
        } catch (Exception $ex) {
            return response()->json([
                'message' => 'Category is not found',
            ], Response::HTTP_NOT_FOUND);
        }

        $category->update([
            'name' => $request['name'],
        ]);

        return response()->json([
            'category' => $category
        ], Response::HTTP_ACCEPTED);
    }

    public function destroy($id)
    {
        Category::destroy($id);

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
