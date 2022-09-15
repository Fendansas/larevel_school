<?php

namespace App\Http\Controllers\Backend\Student;

use App\Http\Controllers\Controller;
use App\Models\AssignStudent;
use App\Models\DiscountStudent;
use App\Models\StudentClass;
use App\Models\StudentGroup;
use App\Models\StudentShift;
use App\Models\StudentYear;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


/**
 * Class StudentRegController
 * @package App\Http\Controllers\Backend\Student
 */
class StudentRegController extends Controller
{


    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function StudentRegView()
    {

        $years = StudentYear::all();
        $classes = StudentClass::all();

        $year_id = StudentYear::orderBy('id', 'desc')->first()->id;
        $class_id = StudentClass::orderBy('id', 'desc')->first()->id;

        $data = AssignStudent::where('year_id',$year_id)->where('class_id',$class_id)->get();

        return view('backend.student.student_reg.student_view', compact(
            'data',
            'years',
            'classes',
            'year_id',
            'class_id'
        ));
    }


    public function StudentClassYearWise(Request $request){
        $years = StudentYear::all();
        $classes = StudentClass::all();

        $year_id = $request->year_id;
        $class_id = $request->class_id;

        $data = AssignStudent::where('year_id', $request->year_id)->where('class_id', $request->class_id)->get();

        return view('backend.student.student_reg.student_view', compact(
            'data',
            'years',
            'classes',
            'year_id',
            'class_id'
        ));
    }



    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function StudentRegAdd(){

        $years = StudentYear::all();
        $classes = StudentClass::all();
        $groups = StudentGroup::all();
        $shifts = StudentShift::all();

        return view('backend.student.student_reg.student_add', compact('years','classes','groups','shifts'));
    }

    /**
     * @param Request $request
     */
    public function StudentRegStore(Request $request){

        DB::transaction(function () use($request){
           $checkYear = StudentYear::find($request->year_id)->name;
           $student = User::where('usertype','Student')->orderBy('id', 'DESC')->first();

           if($student == null){
               $firstReg = 0;
               $studentId = $firstReg + 1;
               if($studentId <10){
                   $id_no = '000'.$studentId;
               } elseif ($studentId < 100){
                   $id_no = '00'.$studentId;
               } elseif ($studentId < 1000){
                   $id_no = '0'.$studentId;
               }
           } else{
               $student = User::where('usertype','Student')->orderBy('id', 'DESC')->first()->id;
               $studentId = $student+1;
               if($studentId <10){
                   $id_no = '000'.$studentId;
               } elseif ($studentId < 100){
                   $id_no = '00'.$studentId;
               } elseif ($studentId < 1000){
                   $id_no = '0'.$studentId;
               }
           }

           $final_id_no = $checkYear.$id_no;
           $user = new User();
           $code = rand(0000,9999);
           $user->id_no = $final_id_no;
           $user->password = bcrypt($code);
           $user->usertype = 'Student';
           $user->code = $code;
           $user->name = $request->name;
           $user->fname = $request->fname;
           $user->mname = $request->mname;
           $user->mobile = $request->mobile;
           $user->address = $request->address;
           $user->gender = $request->gender;
           $user->religion = $request->religion;
           $user->dob = date('Y-m-d', strtotime($request->dob));
            if ($request->file('image')) {
                $file = $request->file('image');
//                @unlink(public_path('upload/user_images/'.$user->image));
                $filename = date('YmdHi').$file->getClientOriginalName();
                $file->move(public_path('upload/student_images'),$filename);
                $user['image'] = $filename;
            }
//            $user->email = $code.'@test.ru';

            $user->save();

            $assign_student = new AssignStudent();


            $assign_student->year_id = $request->year_id;
            $assign_student->class_id = $request->class_id;
            $assign_student->group_id = $request->group_id;
            $assign_student->shift_id = $request->shift_id;
//            dd($assign_student);
            $assign_student->student_id = $user->id;
//            $assign_student->setStudentId($user->id);
//            $assign_student->setYearId($request->year_id);
//            $assign_student->setClassId($request->class_id);
//            $assign_student->setGroupId($request->group_id);
//            $assign_student->setShiftId($request->shift_id);
            $assign_student->save();

            $discount_student = new DiscountStudent();
            $discount_student->assign_student_id = $assign_student->id;
            $discount_student->fee_category_id = '1';
            $discount_student->discount = $request->discount;
            $discount_student->save();

        });

        $notification = array(
            'message' => 'Student registration Inserted Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('student.registration.view')->with($notification);

    }

    public function StudentRegEdit($student_id){

        $years = StudentYear::all();
        $classes = StudentClass::all();
        $groups = StudentGroup::all();
        $shifts = StudentShift::all();

        $editData = AssignStudent::with(['student', 'discount'])->where('student_id',$student_id)->first();

        return view('backend.student.student_reg.student_edit', compact('years','classes','groups','shifts','editData'));

    }




}
