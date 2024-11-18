<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Models\Category;
use Yajra\DataTables\DataTables;

class CategoryController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function createCategory(Request $request)
    {
        $insert = new Category();
        $insert->name = $request->input('category_name');
        $insert->delete_category = 0;
        $insert->save();
        return response()->json([
            'success' => 1
        ]);
    }

    public function editCategory(Request $request)
    {
        $model = Category::where('id', $request->input('id_category'))->first();
        return response()->json([
            'success' => 1,
            'name' => $model->name
        ]);
    }

    public function updateCategory(Request $request)
    {
        $update = Category::where('id', $request->input('id_category'))->first();
        $update->name = $request->input('category_name');
        $update->save();
        return response()->json([
            'success' => 1
        ]);
    }

    public function softDeleteCategory(Request $request)
    {
        $category = Category::where('id', $request->input('id_category'))->first();
        $category->delete_category = 1;
        $category->deleted_at = Carbon::now()->format('Y-m-d H:i:s');
        $category->save();
        return response()->json([
            'success' => 1
        ]);
    }

    public function readCategory()
    {
        return view('categories.tablecategory', [
            'title' => 'Categories',
            'title_menu' => 'Categories'
        ]);
    }

    public function getCategory()
    {
        $data = Category::where('delete_category', 0)->get();
        return Datatables::of($data)
        ->addColumn('name', function ($data) {
            return $data->name;
        })
        ->addColumn('action', function ($data) {
            return
            '<button class="btn btn-icon btn-warning for-update" data-id="'.$data->id.'">
                <i class="fa-regular fa-pen-to-square"></i>
            </button>
            <button class="btn btn-icon btn-danger for-delete" data-id="'.$data->id.'">
                <i class="fa-regular fa-trash-can"></i>
            </button>';
        })
        ->rawColumns(['action'])
        ->make(true);
    }
}
