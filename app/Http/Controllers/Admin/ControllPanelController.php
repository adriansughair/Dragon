<?php

namespace App\Http\Controllers\Admin;

use App\Comment;
use App\RealEstate;
use App\Services\GalleryManager\Uploader;
use Illuminate\Http\Request;
use Validator;
use App\Http\Controllers\Controller;
use App\Testimonial;
use App\User;
use Illuminate\Support\Facades\Auth;

class ControllPanelController extends Controller
{

    public function index(Request $request)
    {
        $banners = RealEstate::where('is_banner', true)->get();
        $not_banners = RealEstate::where('is_banner', false)->get();
        return view('admin.real_estates.banners')->with([
            'banners' => $banners,
            'not_banners' => $not_banners,
        ]);
    }

    public function toggleBanner(Request $request, $id)
    {
        $realEstates = RealEstate::find($id);
        $realEstates->is_banner = !$realEstates->is_banner;
        $realEstates->save();
        return redirect()->route('admin.banners', app()->getLocale());
    }

    public function approveRealEstatesView(Request $request)
    {
        $realEstates = RealEstate::where('approved', false)->get();
        return view('admin.real_estates.approve')->with('realEstates', $realEstates);
    }

    public function handleApprove(Request $request, $id)
    {
        $realEstates = RealEstate::find($id);
        $realEstates->approved = true;
        $realEstates->save();
        return redirect()->route('admin.approve_real_estates_page', app()->getLocale());
    }

    public function comments(Request $request, $id = null)
    {
        if ($id) {
            $comments = Comment::where('real_estate_id', $id)->get();
        } else {
            $comments = Comment::all();
        }
        return view('admin.comments')->with([
            'comments' => $comments
        ]);
    }

    public function removeComment(Request $request, $id)
    {
        $comment = Comment::find($id);
        $comment->delete();
        return redirect()->route('admin.comments', app()->getLocale());
    }

    public function realEstates(Request $request)
    {
        $realEstates = RealEstate::all();
        return view('admin.real_estates.index')->with([
            'realEstates' => $realEstates
        ]);
    }

    public function testimonials(Request $request)
    {
        $testimonials = Testimonial::all();
        return view('admin.testimonials.index')->with('testimonials', $testimonials);
    }

    public function addTestimonial(Request $request)
    {
        return view('admin.testimonials.create');
    }

    public function storeTestimonial(Request $request)
    {
        $request->validate([
        'name' => 'required',
        'image' => 'required|mimes:jpg,png,jpeg',
        'body' => 'required|min:50'
        ]);

        
        $testimonial = new Testimonial();
        
        $imageName = uniqid() . '.' . $request->image->extension();
        $request->image->move(public_path('images/testimonials'), $imageName);

        $testimonial->name = $request->input('name');
        $testimonial->image = 'images/testimonials/' . $imageName;
        $testimonial->body = $request->input('body');
        if ($testimonial->save()) {
            return redirect()->route('admin.testimonials', app()->getLocale());
        }
    }

    public function removeTestimonial(Request $request, $id)
    {
        $testimonial = Testimonial::find($id);
        $testimonial->delete();
        return redirect()->route('admin.testimonials', app()->getLocale());
    }
}
