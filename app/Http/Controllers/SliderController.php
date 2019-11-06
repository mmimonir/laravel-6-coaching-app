<?php

namespace App\Http\Controllers;

use App\Slide;
use Illuminate\Http\Request;
use Image;

class SliderController extends Controller
{
    public function addSlide()
    {
        return view('admin.slider.slide-add-form');
    }

    public function uploadSlide(Request $request)
    {
        $this->validate($request, [
            'slide_image'=>'required',
            'slide_title'=>'required',
            'slide_description'=>'required',
            'status'=>'required'
        ]);

        $data = new Slide();
        $data->slide_image = $this->createSlide($request);
        $data->slide_title = $request->slide_title;
        $data->slide_description = $request->slide_description;
        $data->status = $request->status;
        $data->save();

        return back()->with('message', 'New Slide Added Successfully.');
    }

    protected function createSlide($request)
    {
        $file = $request->file('slide_image');
        $imageName = $file->getClientOriginalName();
        $directory = 'admin/assets/slider/';
        $imageUrl = $directory.$imageName;


        Image::make($file)->resize(1400, 570)->save($imageUrl);

        return $imageUrl;
    }

    public function manageSlide()
    {
        $slides = Slide::all();
        return view('admin.slider.manage-slide', ['slides'=>$slides]);
    }

    public function slideUnpublished($id)
    {
        $slide = Slide::find($id);
        $slide->status = 2;
        $slide->save();

        return redirect('/manage-slide')->with('error_message', 'Your Slide is Unpublished!');
    }

    public function slidePublished($id)
    {
        $slide = Slide::find($id);
        $slide->status = 1;
        $slide->save();

        return redirect('/manage-slide')->with('message', 'Your Slide is Published!');
    }

    public function photoGallery()
    {
        $slides = Slide::all();
        return view('admin.slider.photo-gallery', ['slides'=>$slides]);
    }

    public function slideEdit($id)
    {
        $slide = Slide::find($id);
        return view('admin.slider.slide-edit-form', ['slide'=> $slide]);
    }

    public function updateSlide(Request $request)
    {
        $slide = Slide::find($request->slide_id);
        $this->validate($request, [
            'slide_title'=>'required',
            'slide_description'=>'required',
            'status'=>'required'
        ]);

        $slide->slide_title = $request->slide_title;
        $slide->slide_description = $request->slide_description;
        $slide->status = $request->status;

        if ($request->file('slide_image')) {
            unlink($slide->slide_image);
            $slide->slide_image = $this->createSlide($request);
        }
        $slide->save();

        return redirect('/manage-slide')->with('message', 'Operation Successfull.');
    }

    public function slideDelete($id)
    {
        $slide = Slide::find($id);
        unlink($slide->slide_image);

        $slide->delete();

        return redirect('/manage-slide')->with('message', 'Operation Successfull.');
    }
}
