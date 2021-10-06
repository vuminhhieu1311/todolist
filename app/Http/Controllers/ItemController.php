<?php

namespace App\Http\Controllers;

use App\Models\Item;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ItemController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $items = Item::orderBy('created_at', 'DESC')->get();

        return response()->json([
            'status_code' => 200,
            'items' => $items,
        ], 200);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            $item = new Item();
            $item->name = $request->item['name'];
            $item->save();

            return response()->json([
                'status_code' => 201,
                'message' => 'Create successfully',
                'item' => $item,
            ], 201);
        } catch (Exception $e) {
            report($e);

            return response()->json([
                'status_code' => 400,
                'error' => $e->getMessage(),
            ], 400);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $item = Item::find($id);
        if ($item) {
            $item->completed = $request->item['completed'] ? true : false;
            $item->completed_at = $request->item['completed'] ? Carbon::now() : null;
            $item->save();

            return response()->json([
                'status_code' => 200,
                'message' => 'Update successfully',
                'item' => $item,
            ], 200);
        }

        return response()->json([
            'status_code' => 404,
            'message' => 'Item not found',
        ], 404);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $item = Item::find($id);
        if ($item) {
            $item->delete();

            return response()->json([
                'status_code' => 200,
                'message' => 'Delete successfully',
            ], 200);
        }

        return response()->json([
            'status_code' => 404,
            'message' => 'Item not found',
        ], 404);
    }
}
