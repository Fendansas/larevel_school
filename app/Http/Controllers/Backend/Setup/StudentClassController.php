<?php

namespace App\Http\Controllers\Backend\Setup;

use App\Http\Controllers\Controller;
use App\Models\StudentClass;
use Illuminate\Http\Request;

class StudentClassController extends Controller
{
    public function ViewStudent(){

        $data = StudentClass::all();
        return view('backend.setup.student_class.view_class', compact('data')) ;
    }

    public function StudentClassAdd(){
        return view('backend.setup.student_class.add_class');

    }

    public function StudentClassStore(Request $request){

        $validatedData = $request->validate([
            'name'=> 'required|unique:student_classes',
        ]);

        $data = new StudentClass();
        $data->name = $request->name;
        $data->save();

        $notification = array(
            'message' => 'Student Class Inserted Successfully',
            'alert-type'=> "success"
        );

        return redirect()->route('student.class.view')->with($notification);

    }

    public function StudentClassEdit($id){

        $data = StudentClass::find($id);

        return view('backend.setup.student_class.edit_class', compact('data'));
    }

    public function StudentClassUpdate(Request $request, $id){

        $data = StudentClass::find($id);

        $validatedData = $request->validate([
            'name'=> 'required|unique:student_classes',
        ]);


        $data->name = $request->name;
        $data->save();

        $notification = array(
            'message' => 'Student Class Updated Successfully',
            'alert-type'=> "success"
        );

        return redirect()->route('student.class.view')->with($notification);

    }

    public function StudentClassDelete($id){

        $data = StudentClass::find($id);
        $data->delete();
        $notification = array(
            'message' => 'Student Class Deleted Successfully',
            'alert-type'=> "success"
        );

        return redirect()->route('student.class.view')->with($notification);

    }




}
