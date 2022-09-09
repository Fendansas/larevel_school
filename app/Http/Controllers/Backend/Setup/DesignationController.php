<?php

namespace App\Http\Controllers\Backend\Setup;

use App\Http\Controllers\Controller;
use App\Models\Designation;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class DesignationController extends Controller
{

    public function ViewDesignation()
    {

        $data = Designation::all();

        return view('backend.setup.designation.view_designation', compact('data'));

    }

    public function DesignationAdd()
    {

        return view('backend.setup.designation.add_designation');

    }

    public function DesignationStore(Request $request){

        $validatedData = $request->validate([
            'name'=> 'required|unique:designations',
        ]);

        $data = new Designation();
        $data->name = $request->name;
        $data->save();

        $notification = array(
            'message' => 'Designation Inserted Successfully',
            'alert-type'=> "success"
        );

        return redirect()->route('designation.view')->with($notification);

    }

    public function DesignationEdit($id){

        $editData = Designation::find($id);

        return view('backend.setup.designation.edit_designation', compact('editData'));
    }



    public function DesignationUpdate(Request $request, $id){

        $data = Designation::find($id);

        $validatedData = $request->validate([
            'name'=> 'required|unique:designations',
        ]);


        $data->name = $request->name;
        $data->save();

        $notification = array(
            'message' => 'Designations Updated Successfully',
            'alert-type'=> "success"
        );

        return redirect()->route('designation.view')->with($notification);

    }



    public function DesignationDelete($id){

        $data = Designation::find($id);
        $data->delete();
        $notification = array(
            'message' => 'Designations Deleted Successfully',
            'alert-type'=> "success"
        );

        return redirect()->route('designation.view')->with($notification);

    }

}
