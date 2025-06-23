<?php

namespace App\Http\Controllers;

use App\Http\Resources\CategoryResource;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    //

    public function index()
    {

        return CategoryResource::collection(Category::all());
    }


    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255'
        ]);

        $category = Category::create($data);

        return response()->json($category, 201);
    }

    public function show($id)
    {
        $category = Category::findOrFail($id);
        return new CategoryResource($category);
    }

    public function update(Request $request, $id)
    {
        $category = Category::findOrFail($id);

        $data = $request->validate([
            'name' => 'required|string|max:255'
        ]);

        $category->update($data);

        return new CategoryResource($category);
    }

    public function destroy($id)
    {

        $category = Category::findOrFail($id);
        $category->delete();

        return response()->json(['message' => 'Đã xóa thành công']);
    }
}
