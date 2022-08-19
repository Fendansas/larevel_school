<?php

namespace App\Http\Controllers\Backend\Setup;

use App\Http\Controllers\Controller;
use App\Models\StudentGroup;
use Illuminate\Http\Request;

class StudentGroupController extends Controller
{
    public function ViewGroup(){

        $data = StudentGroup::all();

        return view('backend.setup.group.view_group', compact('data'));

    }

    public function StudentGroupAdd() {

        return view('backend.setup.group.add_group');
    }

    public function StudentGroupStore(Request $request){

        $validatedData = $request->validate([
            'name'=> 'required|unique:student_groups',
        ]);

        $data = new StudentGroup();
        $data->name = $request->name;
        $data->save();

        $notification = array(
            'message' => 'Student Group  Inserted Successfully',
            'alert-type'=> "success"
        );

        return redirect()->route('student.group.view')->with($notification);

    }

    public function StudentGroupEdit($id){
        $editData = StudentGroup::find($id);

        return view('backend.setup.group.edit_group', compact('editData'));
    }



    public function StudentGroupUpdate(Request $request, $id){

        $data = StudentGroup::find($id);

        $validatedData = $request->validate([
            'name'=> 'required|unique:student_groups',
        ]);


        $data->name = $request->name;
        $data->save();

        $notification = array(
            'message' => 'Student Group Updated Successfully',
            'alert-type'=> "success"
        );

        return redirect()->route('student.group.view')->with($notification);

    }


    public function StudentGroupDelete($id){

        $data = StudentGroup::find($id);
        $data->delete();
        $notification = array(
            'message' => 'Student Group Deleted Successfully',
            'alert-type'=> "success"
        );

        return redirect()->route('student.group.view')->with($notification);

    }

}
