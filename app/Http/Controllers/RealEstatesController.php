<?php

namespace App\Http\Controllers;

use App\Like;
use App\RealEstate;
use App\Services\GalleryManager\Uploader;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Validator;

class RealEstatesController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth', ['only' => ['create', 'store', 'edit', 'destroy']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, $isFavorite = false)
    {

        $type = $request->has('offerType') ? $request->input('offerType') : false;

        if ($isFavorite) {
            $realEstates = RealEstate::whereHas('likes', function ($query) {
                $query->where('user_id', @auth()->user()->id);
            });
        } else {
            $realEstates = RealEstate::where('approved', true);
        }

        if ($request->has('offerType')) {
            
            switch ($type){
                case 'rent':
                    $offerType ='0';
                    break;
                case 'sale':
                    $offerType ='1';
                    break;
                case 'required':
                    $offerType ='2';
                    break;
                case 'Lands':
                    $offerType ='3';
                    break;
            }
            
//             $offerType = $type == 'rent' ? '0' : '1';
            $realEstates->where('offerType', $offerType);
        }
        if ($request->has('tax')) {
            $realEstates->where('tax', $request->input('tax'));
        }
        if ($request->has('title')) {
            $realEstates->where('title', 'LIKE', '%' . $request->input('title') . '%');
        }
        if ($request->has('rooms')) {
            $realEstates->where('rooms', $request->input('rooms'));
        }
        if ($request->has('baths')) {
            $realEstates->where('baths', $request->input('baths'));
        }
        if ($request->has('parkings')) {
            $realEstates->where('parkings', $request->input('parkings'));
        }
        if ($request->has('price')) {
            $realEstates->where('price', '>=', $request->input('price'));
        }

        return view('realestate.index', [
            'realEstates' => $realEstates->paginate(8),
            'type' => $type,
            'isFavorite' => $isFavorite
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Request
     */
    public function create(Request $request)
    {
        // $request->session()->forget('paid');
        // $request->session()->forget('tax');
        
        if ($request->session()->has('paid') && $request->session()->has('tax')) {
            return view('realestate.create');
        }
        
        if ($request->session()->has('paid')) {
            if ($request->session()->get('paid') == '1') {
                if ($request->session()->has('tax')) {
                    return view('realestate.create');
                } else {
                    return view('realestate.components.tax');
                }
            } else {
                return view('realestate.create');
            }
        } else {
            return view('realestate.components.paid');
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'price' => 'required|numeric',
            'area' => 'required',
            'rooms' => 'required|numeric',
            'baths' => 'required|numeric',
            'description' => 'required',
            'district' => 'required',
            'images' => 'required',
            'location'=>'required',
            'images.*' => 'mimes:jpg,png,jpeg',
            'offerType' => 'required',
            'RE_Type' =>'required',
            'furniture' =>'required',
            'tax' => 'required',
        ]);

        $realEstate = new RealEstate();

        $realEstate->approved = $request->session()->get('paid') == '1' ? false : true;
        $realEstate->title = $request->input('title');
        $realEstate->price = $request->input('price');
        $realEstate->area = $request->input('area');
        $realEstate->description = $request->input('description');
        $realEstate->rooms = $request->input('rooms');
        $realEstate->baths = $request->input('baths');
        $realEstate->district = $request->input('district');
        $realEstate->location = $request->input('location');
        $realEstate->user_id = @auth()->user()->id;
        $realEstate->offerType = $request->input('offerType');
        $realEstate->tax = $request->input('tax');
        $realEstate->furniture = $request->input('furniture');
        $realEstate->RE_Type = $request->input('RE_Type');
        $realEstate->paid = $request->session()->get('paid');
        $isPaid = $request->session()->get('paid');

        // Remove tax and paid from session
        $request->session()->forget('paid');
        $request->session()->forget('tax');

        if ($realEstate->save()) {
            if ($files = $request->file('images')) {
                Uploader::uploadMultiple64($files, $realEstate->id);
            }
            if ($isPaid == '1') {
                $request->session()->flash('realestate_added', __('We will contact you once your add is approved to be published'));
            } else {
                $request->session()->flash('realestate_added', __('Real estate added successfully added'));
            }
            return redirect()->route('realestates.index', app()->getLocale());
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\RealEstate  $realEstate
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $realEstate = RealEstate::where('id', $id)->get()->first();

        $liked = @($realEstate->likes()->where('user_id', @auth()->user()->id)->where('real_estate_id', $id)->get()->first() != null) ? true : false;

        $location = explode(',', $realEstate->location);

        return view('realestate.show', [
            'realEstate' => $realEstate,
            'location' => count($location) == 2 ? $location : false,
            'liked' => $liked
        ]);
    }

    /**
     * Render Edit Real Estate.
     *
     * @param  \App\RealEstate  $realEstate
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $realEstate = RealEstate::find($id);

        return view('realestate.edit', [
            'realEstate' => $realEstate
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\RealEstate  $realEstate
     * @return \Illuminate\Http\Response
     */
    public function destroy(RealEstate $realEstate, $id)
    {
        $realEstate = RealEstate::find($id);
        $realEstate->delete();
        return redirect()->route('admin.realestates', app()->getLocale());
    }

    public function like(Request $request, RealEstate $realEstate)
    {
        $like = Like::where([
            'real_estate_id' => $request->id,
            'user_id' => @auth()->user()->id
        ])->get()->first();

        if ($like == null) {
            Like::insert([
                'user_id' => @auth()->user()->id,
                'real_estate_id' => $request->id
            ]);
            return redirect()->route('realestates.favorite', [app()->getLocale()]);
        } else {
            Like::find($like->id)->delete();
            return redirect()->route('realestates.show', [app()->getLocale(), $request->id]);
        }
    }

    public function favorites(Request $request)
    {
        return $this->index($request, true);
    }

    public function setPaid(Request $request)
    {
        if ($request->has('paid')) {
            Session::put('paid', $request->input('paid'));
            return redirect()->route('realestates.create', [app()->getLocale()]);
        } else {
            dd('Invalid request');
        }
    }

    public function setTax(Request $request)
    {
        if ($request->has('tax')) {
            Session::put('tax', $request->input('tax'));
            return redirect()->route('realestates.create', [app()->getLocale()]);
        } else {
            dd('Invalid request');
        }
    }
}
