<?php

namespace App\Http\Controllers\Backend\Setup;

use App\Http\Controllers\Controller;
use App\Models\FeeCategory;
use App\Models\FeeCategoryAmount;
use App\Models\StudentClass;
use Illuminate\Http\Request;

class FeeAmountController extends Controller
{
    public function ViewFeeAmount(){

//        $data = FeeCategoryAmount::all();
        $data['allData'] = FeeCategoryAmount::select('fee_category_id')->groupBy('fee_category_id')->get();

        return view('backend.setup.fee_amount.view_fee_amount', $data);

    }

    public function FeeAmountAdd(){

        $date['fee_categories'] = FeeCategory::all();
        $date['classes'] = StudentClass::all();

        return view('backend.setup.fee_amount.add_fee_amount',$date);
    }

    public function FeeAmountStore(Request $request){

        $countClass = count($request->class_id);

        if($countClass != NULL){
            for ($i=0; $i < $countClass; $i++){
                $fee_amount = new FeeCategoryAmount();
                $fee_amount->fee_category_id = $request->fee_category_id;
                $fee_amount->class_id = $request->class_id[$i];
                $fee_amount->amount = $request->amount[$i];
                $fee_amount->save();

            }
        }

        $notification = array(
            'message' => 'Fee Amount Inserted Successfully',
            'alert-type'=> "success"
        );

        return redirect()->route('fee.amount.view')->with($notification);


    }

    public function FeeAmountEdit($fee_category_id){

        $data['editDate'] = FeeCategoryAmount::where('fee_category_id',$fee_category_id)->orderBy('class_id', 'asc')->get();


        $data['fee_categories'] = FeeCategory::all();
        $data['classes'] = StudentClass::all();

        return view('backend.setup.fee_amount.edit_fee_amount', $data);
    }


    public function FeeAmountUpdate(Request $request, $fee_category_id){

        if ($request->class_id == NULL){

            $notification = array(
                'message' => 'Sorry Your do not select any class amount',
                'alert-type'=> "error"
            );

            return redirect()->route('fee.amount.edit', $fee_category_id)->with($notification);

        } else {

            $countClass = count($request->class_id);

            FeeCategoryAmount::where('fee_category_id', $fee_category_id)->delete();

                for ($i=0; $i < $countClass; $i++){
                    $fee_amount = new FeeCategoryAmount();
                    $fee_amount->fee_category_id = $request->fee_category_id;
                    $fee_amount->class_id = $request->class_id[$i];
                    $fee_amount->amount = $request->amount[$i];
                    $fee_amount->save();

                }
            $notification = array(
                'message' => 'Data updated successfully',
                'alert-type'=> "success"
            );

            return redirect()->route('fee.amount.view')->with($notification);

        }
    }

    public function FeeAmountDetails($fee_category_id){

        $data['detailsDate'] = FeeCategoryAmount::where('fee_category_id',$fee_category_id)->orderBy('class_id', 'asc')->get();

        return view('backend.setup.fee_amount.details_fee_amount', $data);
    }



}
