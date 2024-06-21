<?php

namespace App\Http\Controllers;

use App\Models\Item;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

/**
 * @OA\Info(
 *     version="1.0.0",
 *     title="Item API",
 *     description="API for managing items",
 *     @OA\Contact(
 *         email="developer@example.com"
 *     ),
 *     @OA\License(
 *         name="Apache 2.0",
 *         url="http://www.apache.org/licenses/LICENSE-2.0.html"
 *     )
 * )
 *
 * @OA\Tag(
 *     name="Items",
 *     description="API Endpoints of Items"
 * )
 */
class ItemController extends Controller
{
    /**
     * Display a listing of the items.
     *
     * @OA\Get(
     *     path="/api/items",
     *     operationId="getItemsList",
     *     tags={"Items"},
     *     summary="Get list of items",
     *     description="Returns list of items",
     *     @OA\Response(
     *         response=200,
     *         description="Successful operation",
     *         @OA\JsonContent(
     *             type="array",
     *             @OA\Items(ref="#/components/schemas/Item")
     *         ),
     *     ),
     * )
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $items = Item::all();
        return response()->json($items);
    }

    /**
     * Store a newly created item in storage.
     *
     * @OA\Post(
     *     path="/api/items",
     *     operationId="storeItem",
     *     tags={"Items"},
     *     summary="Store new item",
     *     description="Stores a new item in the database",
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(ref="#/components/schemas/Item")
     *     ),
     *     @OA\Response(
     *         response=201,
     *         description="Successful operation",
     *         @OA\JsonContent(ref="#/components/schemas/Item")
     *     ),
     *     @OA\Response(
     *         response=422,
     *         description="Validation error",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="message", type="string"),
     *             @OA\Property(property="errors", type="object"),
     *         ),
     *     ),
     * )
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:50',
            'price' => 'required|integer',
        ]);

        $item = Item::create($request->all());
        return response()->json($item, 201);
    }

    /**
     * Display the specified item.
     *
     * @OA\Get(
     *     path="/api/items/{id}",
     *     operationId="getItemById",
     *     tags={"Items"},
     *     summary="Get item information",
     *     description="Returns item data",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Successful operation",
     *         @OA\JsonContent(ref="#/components/schemas/Item")
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Item not found",
     *     ),
     * )
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $item = Item::findOrFail($id);
        return response()->json($item);
    }

    /**
     * Update the specified item in storage.
     *
     * @OA\Put(
     *     path="/api/items/{id}",
     *     operationId="updateItem",
     *     tags={"Items"},
     *     summary="Update existing item",
     *     description="Updates a item in the database",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(ref="#/components/schemas/Item")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Successful operation",
     *         @OA\JsonContent(ref="#/components/schemas/Item")
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Item not found",
     *     ),
     *     @OA\Response(
     *         response=422,
     *         description="Validation error",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="message", type="string"),
     *             @OA\Property(property="errors", type="object"),
     *         ),
     *     ),
     * )
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'sometimes|string|max:50',
            'price' => 'sometimes|integer',
        ]);

        $item = Item::findOrFail($id);
        $item->update($request->all());

        return response()->json($item);
    }

    /**
     * Remove the specified item from storage.
     *
     * @OA\Delete(
     *     path="/api/items/{id}",
     *     operationId="deleteItem",
     *     tags={"Items"},
     *     summary="Delete existing item",
     *     description="Deletes a item in the database",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=204,
     *         description="Successful operation",
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Item not found",
     *     ),
     * )
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Item::findOrFail($id)->delete();
        return response()->json(null, 204);
    }

    /**
     * Search for items by name.
     *
     * @OA\Get(
     *     path="/api/items/search/{keyword}",
     *     operationId="searchItems",
     *     tags={"Items"},
     *     summary="Search items by name",
     *     description="Returns items that match the search criteria",
     *     @OA\Parameter(
     *         name="keyword",
     *         in="path",
     *         required=true,
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Successful operation",
     *         @OA\JsonContent(
     *             type="array",
     *             @OA\Items(ref="#/components/schemas/Item")
     *         ),
     *     ),
     * )
     *
     * @param  string  $keyword
     * @return \Illuminate\Http\Response
     */
    public function search($keyword)
    {
        $items = Item::where('name', 'LIKE', "%{$keyword}%")->get();
        return response()->json($items);
    }
}
