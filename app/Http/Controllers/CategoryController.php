<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;

class CategoryController extends Controller
{
    public function __construct(){

        $this->middleware('auth');

    }

    public function AllCat(){

//        $categories = Category::all();
        $categories = Category::latest()->paginate(5); // по дате создания(сначало самые новые)
        $trachCat= Category::onlyTrashed()->latest()->paginate(3);

//        $categories = DB::table('categories')->latest()->get();

        return view('admin.category.index', compact('categories', 'trachCat'));
    }

    public function AddCat(Request $request){

        $validated = $request->validate([
            'category_name' => 'required|unique:categories|max:255',
        ],[
            'category_name.required' => 'Please Input Category name'
        ]);

//        Category::insert([
//            'category_name'=>$request->category_name,
//            'user_id'=>Auth::user()->id,
//            'created_at'=>Carbon::now(),
//
//        ]);

//        $data = array();
//        $data['category_name'] = $request->category_name;
//        $data['user_id']= Auth::user()->id;
//        DB::table('categories')->insert($data);

//      Лучше всего делать так
        $category = new Category;
        $category->category_name = $request->category_name;
        $category->user_id = Auth::user()->id;
        $category->save();

        return Redirect()->back()->with('success', 'Category inserted successful');

    }

    public function Edit($id){

        $categories = Category::find($id);
        return view('admin.category.edit', compact('categories'));
    }

    public function Update(Request $request, $id){

        $validated = $request->validate([
            'category_name' => 'required|unique:categories|max:255',
        ],[
            'category_name.required' => 'Please Input Category name'
        ]);

        $update = Category::find($id)->update([
            'category_name' => $request->category_name,
            'user_id'=>Auth::user()->id,
        ]);

        return Redirect()->route('all.category')->with('success', 'Category updated successful');
    }

    public function SoftDelete($id){
        $delete = Category::find($id)->delete();
        return Redirect()->back()->with('success', 'Category Soft deleted successful');

    }

    public function Restore($id){
        $delete = Category::withTrashed()->find($id)->restore();
        return Redirect()->back()->with('success', 'Category Restore successful');
    }

    public function Pdelete($id){
        $delete = Category::onlyTrashed()->find($id)->forceDelete();
        return Redirect()->back()->with('success', 'Category P Deleted successful');
    }
}
