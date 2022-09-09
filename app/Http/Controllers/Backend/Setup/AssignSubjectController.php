<?php

namespace App\Http\Controllers\Backend\Setup;

use App\Http\Controllers\Controller;
use App\Models\AssignSubject;
use App\Models\SchoolSubject;
use App\Models\StudentClass;
use Illuminate\Http\Request;

/**
 * Class AssignSubjectController
 * @package App\Http\Controllers\Backend\Setup
 */
class AssignSubjectController extends Controller
{

    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function ViewAssignSubject(){

//        $data['allData'] = AssignSubject::all();
        $data['allData'] = AssignSubject::select('class_id')->groupBy('class_id')->get();


        return view('backend.setup.assign_subject.view_assign_subject',$data);
    }


    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function AssignSubjectAdd(){

        $date['subjects'] = SchoolSubject::all();
        $date['classes'] = StudentClass::all();

        return view('backend.setup.assign_subject.add_assign_subject',$date);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function AssignSubjectStore(Request $request){

        $countSubject = count($request->subject_id);

        if($countSubject != NULL){
            for ($i=0; $i < $countSubject; $i++){
                $assign_subject = new AssignSubject();
                $assign_subject->class_id = $request->class_id;
                $assign_subject->subject_id = $request->subject_id[$i];
                $assign_subject->full_mark = $request->full_mark[$i];
                $assign_subject->pass_mark = $request->pass_mark[$i];
                $assign_subject->subjective_mark = $request->subjective_mark[$i];
                $assign_subject->save();

            }
        }

        $notification = array(
            'message' => 'Subject Assign Inserted Successfully',
            'alert-type'=> "success"
        );

        return redirect()->route('assign.subject.view')->with($notification);


    }

    public function AssignSubjectEdit($class_id){

        $data['editData'] = AssignSubject::where('class_id',$class_id)->orderBy('subject_id', 'asc')->get();


        $data['subjects'] = SchoolSubject::all();
        $data['classes'] = StudentClass::all();

        return view('backend.setup.assign_subject.edit_assign_subject',$data);
    }


    /**
     * @param Request $request
     * @param $class_id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function AssignSubjectUpdate(Request $request, $class_id){

        if ($request->subject_id == NULL){

            $notification = array(
                'message' => 'Sorry Your do not select any class subject',
                'alert-type'=> "error"
            );

            return redirect()->route('assign.subject.edit', $class_id)->with($notification);

        } else {

            $countClass = count($request->subject_id);

            AssignSubject::where('class_id', $class_id)->delete();

            for ($i=0; $i < $countClass; $i++){
                $assign_subject = new AssignSubject();
                $assign_subject->class_id = $request->class_id;
                $assign_subject->subject_id = $request->subject_id[$i];
                $assign_subject->full_mark = $request->full_mark[$i];
                $assign_subject->pass_mark = $request->pass_mark[$i];
                $assign_subject->subjective_mark = $request->subjective_mark[$i];
                $assign_subject->save();

            }
            $notification = array(
                'message' => 'Data updated successfully',
                'alert-type'=> "success"
            );

            return redirect()->route('assign.subject.view')->with($notification);

        }
    }


    public function AssignSubjectDetails($class_id){

        $data['detailsData'] = AssignSubject::where('class_id',$class_id)->orderBy('subject_id', 'asc')->get();

        return view('backend.setup.assign_subject.details_assign_subject', $data);
    }




}
