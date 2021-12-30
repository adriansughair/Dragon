<?php

namespace App\Http\Controllers;

use App\Like;
use App\RealEstate;
use App\Services\GalleryManager\Uploader;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Validator;

class PrivacyController extends Controller
{

    public function __construct()
    {
        
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, $isFavorite = false)
    {
       

        return view('privacy.privacy');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Request
     */
    
}
