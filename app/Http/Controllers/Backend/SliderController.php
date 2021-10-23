<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Slider;
use Illuminate\Http\Request;
use Image;
class SliderController extends Controller
{
    public function viewSlide(){
        $sliders = Slider::latest()->get();
        return view('admin.slide.slide_view',compact(['sliders']));
    }

    public function storeSlide(Request $request)
    {
        $notification = array(
                'message'    => 'Slide added successfully',
                'alert-type' => 'success',
        );
        if($request->hasFile('slide_image'))
        {
            $img = $request->file('slide_image');
            $name_gen = hexdec(uniqid()).$img->getClientOriginalName();
            Image::make($img)->resize(850,350)->save('upload/sliders/'.$name_gen);
            $saveUrl = 'upload/sliders/'.$name_gen;

            $slide = Slider::create([
                    'slide_image'=>$saveUrl,
            ]);
            return redirect()->back()->with($notification);
        }
        return redirect()->back()->with($notification);
    }


    public function activeSlide($id){
        $slide = Slider::findOrFail($id);
        $slide->status = 1;
        $slide->save();
        return redirect()->back();
    }

    public function inactiveSlide($id){
        $slide = Slider::findOrFail($id);
        $slide->status = 0;
        $slide->save();
        return redirect()->back();
    }

    public function deleteSlide($id){
        $slide = Slider::findOrFail($id);

        // Unlink image
        unlink($slide->slide_image);
        $slide->delete();

        $notification = array(
                'message'    => 'Slide deleted successfully',
                'alert-type' => 'info',
        );
        return redirect()->route('slide.view')->with($notification);
    }
}
