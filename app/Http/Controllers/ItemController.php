<?php

namespace App\Http\Controllers;

use App\Models\Item;
use Illuminate\Http\Request;

class ItemController extends Controller
{
    /**
     * @OA\Get(
     *      path="/items",
     *      tags={"Items"},
     *      summary="Get list of items",
     *      description="Returns list of items",
     *      @OA\Response(
     *          response=200,
     *          description="Successful operation",
     *       ),
     *      @OA\Response(
     *          response=500,
     *          description="Internal server error",
     *      ),
     *      security={
     *          {"apiAuth": {}}
     *      }
     *     )
     */
    public function show()
    {
        try {
            $items = Item::all();
            return response()->json($items);
        } catch (\Exception $e) {
            return response()->json([
                'message' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * @OA\Get(
     *      path="/items/{id}",
     *      tags={"Items"},
     *      summary="Get item by id",
     *      description="Returns item by id",
     *      @OA\Parameter(
     *          name="id",
     *          description="Item id",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="integer"
     *          )
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="Successful operation",
     *       ),
     *      @OA\Response(
     *          response=500,
     *          description="Internal server error",
     *      ),
     *      security={
     *          {"apiAuth": {}}
     *      }
     *     )
     */
    public function index($id)
    {
        try {
            $item = Item::find($id);
            return response()->json($item);
        } catch (\Exception $e) {
            return response()->json([
                'message' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * @OA\Post(
     *      path="/items",
     *      tags={"Items"},
     *      summary="Create item",
     *      description="Create new item",
     *      @OA\RequestBody(
     *          required=true,
     *          @OA\JsonContent(
     *              required={"name", "description"},
     *              @OA\Property(property="name", type="string", format="string", example="Item 1"),
     *              @OA\Property(property="description", type="string", format="string", example="Description 1"),
     *          ),
     *      ),
     *      @OA\Response(
     *          response=201,
     *          description="Item created successfully",
     *       ),
     *      @OA\Response(
     *          response=500,
     *          description="Internal server error",
     *      ),
     *      security={
     *          {"apiAuth": {}}
     *      }
     *     )
     */
    public function store(Request $request)
    {
        try {
            $item = Item::create($request->all());
            return response()->json($item, 201);
        } catch (\Exception $e) {
            return response()->json([
                'message' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * @OA\Put(
     *      path="/items/{id}",
     *      tags={"Items"},
     *      summary="Update item",
     *      description="Update item by id",
     *      @OA\Parameter(
     *          name="id",
     *          description="Item id",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="integer"
     *          )
     *      ),
     *      @OA\RequestBody(
     *          required=true,
     *          @OA\JsonContent(
     *              required={"name", "description"},
     *              @OA\Property(property="name", type="string", format="string", example="Item 1"),
     *              @OA\Property(property="description", type="string", format="string", example="Description 1"),
     *          ),
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="Item updated successfully",
     *       ),
     *      @OA\Response(
     *          response=500,
     *          description="Internal server error",
     *      ),
     *      security={
     *          {"apiAuth": {}}
     *      }
     *     )
     */
    public function update(Request $request, $id)
    {
        try {
            $item = Item::find($id);
            $item->update($request->all());
            return response()->json($item, 200);
        } catch (\Exception $e) {
            return response()->json([
                'message' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * @OA\Delete(
     *      path="/items/{id}",
     *      tags={"Items"},
     *      summary="Delete item",
     *      description="Delete item by id",
     *      @OA\Parameter(
     *          name="id",
     *          description="Item id",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="integer"
     *          )
     *      ),
     *      @OA\Response(
     *          response=204,
     *          description="Item deleted successfully",
     *       ),
     *      @OA\Response(
     *          response=500,
     *          description="Internal server error",
     *      ),
     *      security={
     *          {"apiAuth": {}}
     *      }
     *     )
     */
    public function destroy($id)
    {
        try {
            Item::destroy($id);
            return response()->json(null, 204);
        } catch (\Exception $e) {
            return response()->json([
                'message' => $e->getMessage()
            ], 500);
        }
    }
}
