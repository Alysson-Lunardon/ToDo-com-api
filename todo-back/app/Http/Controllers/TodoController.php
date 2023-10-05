<?php

namespace App\Http\Controllers;

use App\Models\Todo;
use Illuminate\Http\Request;

class TodoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $items = Todo::all();
        return $items;
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $title = $request->input('title');

        $item = Todo::create([
            'title' => $title,
            'completed' => false
        ]);

        return $item;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $item = Todo::find($id);

        $item->title = $request->input('title');
        $item->save();

        return $item;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $item = Todo::find($id);
        $item->delete();
        return null;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function completed(Request $request, string $id)
    {
        $item = Todo::find($id);

        $item->completed = $request->input('completed');
        $item->save();

        return $item;
    }
    public function saveDescription(Request $request, string $id) 
    {
        $item = Todo::findOrFail($id);

        $item->description = $request->input('description');
        $item->save();

        return $item;
    }
    public function saveDate(Request $request, string $id)
    {
        $item = Todo::find($id);

        $item->due_date = $request->input('due_date');
        $item->save();

        return $item;
    }
}

