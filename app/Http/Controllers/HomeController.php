<?php

namespace App\Http\Controllers;

use App\RealEstate;
use App\Testimonial;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $banners = RealEstate::where('is_banner', true)->where('approved', true)->get();
        
        $realEstates = RealEstate::where('approved', true)->limit(4)->orderBy('created_at')->with([
            'gallery' => function ($query) {
                $query->select('real_estate_id', 'filepath');
            }
        ])->get();

        $latestProperties = RealEstate::where('approved', true)->limit(3)->orderBy('created_at')->with([
            'gallery' => function ($query) {
                $query->select('real_estate_id', 'filepath');
            }
        ])->get();

        $testimonials = Testimonial::limit(4)->orderBy('created_at')->get();
        
        return view('home.homepage')->with([
            'realEstates' => $realEstates,
            'banners' => $banners,
            'latestProperties' => $latestProperties,
            'testimonials' => $testimonials
        ]);
    }
}
