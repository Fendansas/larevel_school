<?php

namespace App\Http\Controllers;

use App\Models\Slider;
use Illuminate\Http\Request;
use Image;
use Illuminate\Support\Carbon;


class HomeController extends Controller
{

    public function HomeSlider(){
        $sliders = Slider::latest()->get();
        return view('admin.slider.index', compact('sliders'));
    }

    public function AddSlider(){
        return view('admin.slider.create');
    }

    public function StoreSlider(Request $request){

        $validateData = $request->validate([
            'title'=>'required|unique:sliders|min:1',
            'description'=>'required|unique:sliders|min:1',
            'image'=>'required|mimes:jpg,jpeg,png'
        ],
            [
                'title.required'=>'Please Input  Title',
                'title.min'=>'Title Longer then 1 Characters',
                'description.min'=>'Description Longer then 3 Characters',
                'description.required'=>'Please Input Title Description',

            ]);

        $slider_image = $request->file('image');


        $name_gen = hexdec(uniqid()).'.'.$slider_image->getClientOriginalExtension();
        Image::make($slider_image)->resize(1920,1088)->save('image/slider/'.$name_gen);
        $last_img = 'image/slider/'.$name_gen;

        Slider::insert([
            'title'=> $request->title,
            'description'=> $request->description,
            'image'=>$last_img,
            'created_at'=>Carbon::now(),
        ]);
        return Redirect()->route('home.slider')->with('success', 'Slider Inserted Successfully');

    }

    public function Edit($id){
        $slider = Slider::find($id);
        return view('admin.slider.edit', compact('slider'));
    }

    public function Update(Request $request, $id){

        $validateData = $request->validate([
            'title'=>'required|unique:sliders|min:1',
            'description'=>'required|unique:sliders|min:1',
            'image'=>'mimes:jpg,jpeg,png'
        ],
            [
                'title.required'=>'Please Input  Title',
                'title.min'=>'Title Longer then 1 Characters',
                'description.min'=>'Description Longer then 3 Characters',
            ]);

        $slider_image = $request->file('image');

        if($slider_image) {

            $name_gen = hexdec(uniqid()) . '.' . $slider_image->getClientOriginalExtension();
            Image::make($slider_image)->resize(1920, 1088)->save('image/slider/' . $name_gen);
            $last_img = 'image/slider/' . $name_gen;

            Slider::find($id)->update([
                'title' => $request->title,
                'description' => $request->description,
                'image'=>$last_img,
                'created_at' => Carbon::now(),

            ]);
            return Redirect()->back()->with('success', 'Slider Updated Successfully');
        }else{

            Slider::find($id)->update([
                'title' => $request->title,
                'description' => $request->description,
                'created_at' => Carbon::now(),
            ]);
            return Redirect()->back()->with('success', 'Slider Updated Successfully');
        }
    }


    public function Delete($id){

        $image = Slider::find($id);
        $old_image = $image->image;
        unlink($old_image);

        Slider::find($id)->delete();
        return Redirect()->back()->with('success', 'Brand Deleted Successfully');
    }

}
