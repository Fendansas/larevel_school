<?php

namespace App\Http\Controllers;

use App\Models\HomeAbout;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class AboutController extends Controller
{
    public function HomeAbout(){
        $homeAbout = HomeAbout::latest()->get();
        return view('admin.home.index', compact('homeAbout'));
    }

    public function AddAbout(){

        return view('admin.home.create');
    }

    public function StoreAbout(Request $request){

        $validateData = $request->validate([
            'title'=>'required|unique:home_abouts|min:1',
            'short_dis'=>'required|unique:home_abouts|min:1',
            'long_dis'=>'required|unique:home_abouts|min:1',

        ],
            [
                'title.required' => 'Please Input About Title',
                'title.min' => 'About Longer then 3 Characters',
                'short_dis.required' => 'Please Input Short Des',
                'short_dis.min' => 'Short Des Longer then 3 Characters',
                'long_dis.required' => 'Please Input Long Des',
                'long_dis.min' => 'Long Des Longer then 3 Characters',
            ]);


        HomeAbout::insert([
            'title' => $request->title,
            'short_dis' => $request->short_dis,
            'long_dis' => $request->long_dis,
            'created_at'=>Carbon::now(),
        ]);
        return Redirect()->route('home.about')->with('success', 'About Inserted Successfully');

    }

    public function Edit($id){

        $about = HomeAbout::find($id);

        return view('admin.home.edit', compact('about'));
    }

    public function Update(Request $request,$id){
        $validateData = $request->validate([
            'title'=>'required|unique:home_abouts|min:1',
            'short_dis'=>'required|unique:home_abouts|min:1',
            'long_dis'=>'required|unique:home_abouts|min:1',

        ],
            [
                'title.required' => 'Please Input About Title',
                'title.min' => 'About Longer then 3 Characters',
                'short_dis.required' => 'Please Input Short Des',
                'short_dis.min' => 'Short Des Longer then 3 Characters',
                'long_dis.required' => 'Please Input Long Des',
                'long_dis.min' => 'Long Des Longer then 3 Characters',
            ]);



        HomeAbout::find($id)->update([
            'title' => $request->title,
            'short_dis' => $request->short_dis,
            'long_dis' => $request->long_dis,
            'created_at'=>Carbon::now(),
        ]);

        return Redirect()->route('home.about')->with('success', 'About Updated Successfully');

    }

    public function Delete($id){

        HomeAbout::find($id)->delete();
        return Redirect()->back()->with('success', 'About Deleted Successfully');
    }
}
