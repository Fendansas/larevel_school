<?php

namespace App\Http\Controllers;

use App\Models\HomeService;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Image;

class ServiceController extends Controller
{
    public function HomeService(){

        $service = HomeService::all();

        return view('admin.service.index', compact('service'));
    }

    public function AddService(){

        return view('admin.service.create');

    }

    public function StoreService(Request $request){
//        dd($request);
        $validateData = $request->validate([
            'title'=>'required|unique:home_services|min:1',
            'text'=>'required|unique:home_services|min:1',
            'link'=>'required|unique:home_services|min:1',
            'image'=>'required|mimes:jpg,jpeg,png,svg'
        ],
            [
                'title.required'=>'Please Input Brand Name',
                'title.min'=>'Brand Longer then 3 Characters',
                'text.required'=>'Please Input Brand Name',
                'text.min'=>'Brand Longer then 3 Characters',
                'link.required'=>'Please Input Brand Name',
                'link.min'=>'Brand Longer then 3 Characters',
            ]);

        $image = $request->file('image');

        $name_gen = hexdec(uniqid()).'.'.$image->getClientOriginalExtension();
        Image::make($image)->resize(300,200)->save('image/service/'.$name_gen);
        $last_img = 'image/service/'.$name_gen;

        HomeService::insert([
            'title'=> $request->title,
            'text'=> $request->text,
            'link'=> $request->link,
            'image'=>$last_img,
            'created_at'=>Carbon::now(),
        ]);
        return Redirect()->route('home.service')->with('success', 'Service Inserted Successfully');

    }

    public function Edit($id){

        $service = HomeService::find($id);

        return view('admin.service.edit', compact('service'));

    }

    public function Update(Request $request,$id){

        $image = $request->file('image');

        if($image) {

            $name_gen = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();
            Image::make($image)->resize(1920, 1088)->save('image/service/' . $name_gen);
            $last_img = 'image/service/' . $name_gen;

            HomeService::find($id)->update([
                'title'=> $request->title,
                'text'=> $request->text,
                'link'=> $request->link,
                'image'=>$last_img,
                'created_at'=>Carbon::now(),

            ]);
            return Redirect()->back()->with('success', 'Slider Updated Successfully');
        }else{

            HomeService::find($id)->update([
                'title'=> $request->title,
                'text'=> $request->text,
                'link'=> $request->link,
                'created_at'=>Carbon::now(),
            ]);
            return Redirect()->back()->with('success', 'Slider Updated Successfully');
        }
    }

    public function Delete($id){

        $image = HomeService::find($id);
        unlink($image->image);

        HomeService::find($id)->delete();
        return Redirect()->back()->with('success', 'Service Deleted Successfully');
    }



}
