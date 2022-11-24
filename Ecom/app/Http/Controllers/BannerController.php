<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Banner;
use Illuminate\Support\Facades\File;

class BannerController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    //Add Banner
    public function AddBanner()
    {
        return view('Banner.AddBanner');
    }
    public function PostAddBanner(Request $req)
    {
        try {
            $validate = $req->validate(
                [
                    'heading' => ['required', 'min:3'],
                    'image' => ['required', 'mimes:jpg,jpeg,png'],
                ]
            );
            if ($validate) {
                $img = $req->file('image');
                $heading = $req->heading;
                $desc = $req->description;
                $fname = "Image-" . rand() . "-" . time() . "." . $img->getClientOriginalExtension();
                $dest = public_path('/BannerImages');
                if ($img->move($dest, $fname)) {
                    $banner = new Banner();
                    $banner->heading = $heading;
                    $banner->description = $desc;
                    $banner->image = $fname;
                    if ($banner->save()) {
                        return redirect('/banner/showbanner')->with('success', 'Banner added successfully');
                    } else {
                        $path = public_path() . 'BannerImages' . $fname;
                        unlink($path);
                        return ("Failed");
                    }
                }
            }
        } catch (\Illuminate\Database\QueryException $ex) {
            return redirect('/error')->with('error', $ex->getMessage());
        }
    }

    //Show banners
    public function ShowBanner()
    {
        $banners = Banner::orderBy('created_at', 'desc')->paginate(2);
        return view('Banner.ShowBanner', compact('banners'));
    }

    //Edit Banner
    public function EditBanner($id)
    {
        $banner = Banner::whereId($id)->first();
        return view('Banner.EditBanner', compact('banner'));
    }
    public function PostEditBanner(Request $req)
    {
        try {
            $banner = Banner::whereId($req->id)->first();
            $validate = $req->validate([
                'heading' => ['required', 'min:3'],
                'image' => ['mimes:jpg,jpeg,png']
            ]);
            if ($validate) {
                if ($req->hasFile('image')) {
                    $dest = public_path('BannerImages/' . $banner->image);
                    if (File::exists($dest)) {
                        unlink($dest);
                    }
                    $img = $req->file('image');
                    $filename = $img->getClientOriginalName();
                    $fname = 'Image-' . rand() . '-' . time() . '-' . $filename;
                    $destination = public_path('/BannerImages');
                    if ($img->move($destination, $fname)) {
                        $banner->image = $fname;
                    } else {
                        return back()->with('error', "Error uploading file");
                    }
                }
                $banner->heading = $req->heading;
                $banner->description = $req->description;
                $banner->save();
            }
            return redirect('/banner/showbanner')->with('success', "Banner updated successfully");
        } catch (\Illuminate\Database\QueryException $ex) {
            return redirect('/error')->with('error', $ex->getMessage());
        }
    }


    //Delete Banner
    public function DeleteBanner(Request $req)
    {
        try {
            $banner = Banner::whereId($req->bid)->first();
            $path = public_path('BannerImages/' . $banner->image);
            if (File::exists($path)) {
                unlink($path);
            }
            $banner->delete();
            return back()->with('success', "Deleted Successfully");
        } catch (\Illuminate\Database\QueryException $ex) {
            return redirect('/error')->with('error', $ex->getMessage());
        }
    }
}
