<?php

namespace App\Http\Controllers\Backend\Setup;

use App\Http\Controllers\Controller;
use App\Models\FeeCategory;
use Illuminate\Http\Request;

class FeeCategoryController extends Controller
{
    public function ViewFeeCat(){

        $data = FeeCategory::all();

        return view('backend.setup.fee_category.view_fee_cat', compact('data'));

    }

    public function FeeCatAdd() {

        return view('backend.setup.fee_category.add_fee');
    }


    public function FeeCatStore(Request $request){

        $validatedData = $request->validate([
            'name'=> 'required|unique:fee_categories',
        ]);

        $data = new FeeCategory();
        $data->name = $request->name;
        $data->save();

        $notification = array(
            'message' => 'Student Fee Category Inserted Successfully',
            'alert-type'=> "success"
        );

        return redirect()->route('fee.category.view')->with($notification);

    }


    public function FeeCatEdit($id){
        $editData = FeeCategory::find($id);

        return view('backend.setup.fee_category.edit_fee_cat', compact('editData'));
    }


    public function FeeCatUpdate(Request $request, $id){

        $data = FeeCategory::find($id);

        $validatedData = $request->validate([
            'name'=> 'required|unique:fee_categories',
        ]);


        $data->name = $request->name;
        $data->save();

        $notification = array(
            'message' => 'Student Fee Category Updated Successfully',
            'alert-type'=> "success"
        );

        return redirect()->route('fee.category.view')->with($notification);

    }


    public function FeeCatDelete($id){

        $data = FeeCategory::find($id);
        $data->delete();
        $notification = array(
            'message' => 'Student Fee Category Deleted Successfully',
            'alert-type'=> "success"
        );

        return redirect()->route('fee.category.view')->with($notification);

    }



}
