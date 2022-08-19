<?php

namespace App\Http\Controllers\Backend\Setup;

use App\Http\Controllers\Controller;
use App\Models\StudentShift;
use Illuminate\Http\Request;

class StudentShiftController extends Controller
{
    public function ViewShift(){

        $data = StudentShift::all();

        return view('backend.setup.shift.view_shift', compact('data'));

    }

    public function StudentShiftAdd() {

        return view('backend.setup.shift.add_shift');
    }



    public function StudentShiftStore(Request $request){

        $validatedData = $request->validate([
            'name'=> 'required|unique:student_shifts',
        ]);

        $data = new StudentShift();
        $data->name = $request->name;
        $data->save();

        $notification = array(
            'message' => 'Student Shift Inserted Successfully',
            'alert-type'=> "success"
        );

        return redirect()->route('student.shift.view')->with($notification);

    }



    public function StudentShiftEdit($id){
        $editData = StudentShift::find($id);

        return view('backend.setup.shift.edit_shift', compact('editData'));
    }



    public function StudentShiftUpdate(Request $request, $id){

        $data = StudentShift::find($id);

        $validatedData = $request->validate([
            'name'=> 'required|unique:student_shifts',
        ]);


        $data->name = $request->name;
        $data->save();

        $notification = array(
            'message' => 'Student Shift Updated Successfully',
            'alert-type'=> "success"
        );

        return redirect()->route('student.shift.view')->with($notification);

    }


    public function StudentGroupDelete($id){

        $data = StudentShift::find($id);
        $data->delete();
        $notification = array(
            'message' => 'Student Shift Deleted Successfully',
            'alert-type'=> "success"
        );

        return redirect()->route('student.shift.view')->with($notification);

    }




}
