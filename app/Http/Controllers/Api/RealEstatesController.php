<?php

namespace App\Http\Controllers\Api;

use App\Gallery;
use Illuminate\Http\Request;
use App\Http\Controllers\Api\BaseController as BaseController;
use App\Like;
use App\RealEstate;
use App\Role;
use App\Services\GalleryManager\Uploader;
use App\User;
use Illuminate\Support\Facades\Auth;

class RealEstatesController extends BaseController
{
    /**
     * Upload api
     *
     * @return \Illuminate\Http\Response
     */
    public function upload(Request $request)
    {
        $uploaded = Uploader::upload64($request->input('image'));

        $success = [
            'id' => $uploaded
        ];

        if ($uploaded) {
            return $this->sendResponse($success, 'Image uploaded successfully.');
        } else {
            return $this->sendError([], 'Error uploading Image.');
        }
    }

    /**
     * Create api
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        if($request->input('offerType') != 2)
        {
            $request->validate([
                'title' => 'required',
                'price' => 'required|numeric',
                'area' => 'required',
                'rooms' => 'required|numeric',
                'baths' => 'required|numeric',
                'description' => 'required',
                'district' => 'required',
                'gallery' => 'required|array',
                'gallery.*' => 'int',
                'offerType' => 'required',
                'tax' => 'required',
                'paid' => 'required',
                'RE_Type' =>'required',
                'furniture' =>'required',
            ]);
        }
        else
        {
            $request->validate([
                'title' => 'required',
                //             'parkings' => 'required|numeric',
                //             'kitchens' => 'required|numeric',
                'price' => 'required|numeric',
                'area' => 'required',
                'rooms' => 'required|numeric',
                'baths' => 'required|numeric',
                'description' => 'required',
                'district' => 'required',
//                 'gallery' => 'required|array',
//                 'gallery.*' => 'int',
                //             'temp' => 'required',
                'offerType' => 'required',
                'tax' => 'required',
                'paid' => 'required',
                'RE_Type' =>'required',
                'furniture' =>'required',
            ]);
        }
        


        $realEstate = new RealEstate();

        $realEstate->approved = $request->input('paid') == '1' ? false : true;
        $realEstate->title = $request->input('title');
        $realEstate->price = $request->input('price');
        $realEstate->area = $request->input('area');
        $realEstate->description = $request->input('description');
        $realEstate->rooms = $request->input('rooms');
        $realEstate->baths = $request->input('rooms');
        $realEstate->district = $request->input('district');
        $realEstate->location = $request->input('location');
        $realEstate->user_id = auth('api')->user()->id;
//         $realEstate->temp = $request->input('temp');
        $realEstate->offerType = $request->input('offerType');
        $realEstate->tax = $request->input('tax');
//         $realEstate->kitchens = 0;
//         $realEstate->parkings = 0;
        $realEstate->paid = $request->input('paid');
        $realEstate->RE_Type = $request->input('RE_Type');
        $realEstate->furniture = $request->input('furniture');

        $realEstate->save();
        
        if($request->input('offerType') != "2")
        {
            foreach ($request->input('gallery') as $id) {
                $galleryItem = Gallery::find($id);
                $galleryItem->real_estate_id = $realEstate->id;
                $galleryItem->save();
            }
        }

        

        return $this->sendResponse($realEstate, 'Created successfully.');
    }

    /**
     * Get api
     *
     * @return \Illuminate\Http\Response
     */
    public function filter(Request $request, RealEstate $realEstate)
    {
        $data = $request->all();
        $realEstates = $realEstate->newQuery()->with([
            'gallery' => function ($query) {
                $query->select('real_estate_id', 'filepath');
            },
            'like' => function ($query) {
                $query->select('real_estate_id');
            }
        ]);

        if ($request->has('rooms')) {
            $realEstates->where('rooms', $request->input('rooms'));
        }
        if ($request->has('baths')) {
            $realEstates->where('baths', $request->input('baths'));
        }
        if ($request->has('offerType')) {
            $realEstates->where('offerType', $request->input('offerType'));
        }
        if ($request->has('tax')) {
            $realEstates->where('tax', $request->input('tax'));
        }
        if ($request->has('temp')) {
            $realEstates->where('temp', $request->input('temp'));
        }
        if ($request->has('paid')) {
            $realEstates->where('paid', $request->input('paid'));
        }
        if ($request->has('title')) {
            $realEstates->where('title', 'LIKE', '%' . $request->input('title') . '%');
        }

        if ($request->has('RE_Type')) {
            $realEstates->where('RE_Type', $request->input('RE_Type'));
        }
        
        if ($request->has('district')) {
            $realEstates->where('district', $request->input('district'));
        }
        
        if ($request->has('location')) {
            $realEstates->where('location', $request->input('location'));
        }
        
        if ($request->has('furniture')) {
            $realEstates->where('furniture', $request->input('furniture'));
        }
        
        if ($request->has('price')) {
            $arr = explode(",", $request->input('price'));
            $realEstates->whereBetween('price', $arr);
        }
        
        // Only approved real estates
        $realEstates->where('approved', true);

        if ($request->has('size')) {
            $data = $realEstates->paginate($request->input('size'));
        } else {
            $data = $realEstates->orderBy('created_at', 'desc')->get();
        }

        return $this->sendResponse($data, 'success');
    }

    /**
     * Gets Liked Real Estates By Current User
     *
     * @return \Illuminate\Http\Response
     */
    public function favorites(Request $request, RealEstate $realEstate)
    {
        $realEstate = RealEstate::whereHas('likes', function ($query) {
            $query->where('user_id', auth('api')->user()->id);
        })->with([
            'gallery' => function ($query) {
                $query->select('real_estate_id', 'filepath');
            }
        ])
        ->orderBy('created_at', 'desc')
        ->get();
        return $this->sendResponse($realEstate, 'success');
    }

    public function get(Request $request, RealEstate $realEstate)
    {
        if (!$request->has('increment')) {
            // Increment seen field
            $realEstate = RealEstate::find($request->id);
            $realEstate->seen = ++$realEstate->seen;
            $realEstate->save();
        }

        $realEstate = $realEstate->newQuery()->with([
            'user' => function ($query) {
                $query->select('id', 'name', 'whatsapp', 'phone_number');
            },
            'gallery' => function ($query) {
                $query->select('real_estate_id', 'filepath');
            },
            'like' => function ($query) {
                $query->select('real_estate_id');
            }
        ])->where('id', $request->id)->get()->first();

        return $this->sendResponse($realEstate, "success");
    }

    public function like(Request $request, RealEstate $realEstate)
    {
        $like = Like::where([
            'real_estate_id' => $request->id,
            'user_id' => auth('api')->user()->id
        ])->get()->first();

        if ($like == null) {
            Like::insert([
                'user_id' => auth('api')->user()->id,
                'real_estate_id' => $request->id
            ]);
            $message = 'liked';
        } else {
            Like::find($like->id)->delete();
            return $this->sendResponse('disliked', "success");
            $message = 'disliked';
        }
        $realEstate = RealEstate::find($request->id)->with([
            'like' => function ($query) {
                $query->select('real_estate_id');
            }
        ]);
        return $this->sendResponse($realEstate, $message);
    }

    public function banners(Request $request)
    {
        $realEstates = RealEstate::select('id', 'title')->with([
            'gallery' => function ($query) {
                $query->select('real_estate_id', 'filepath');
            }
        ])->where('is_banner', true)
          ->orderBy('created_at', 'desc')
          ->get();
        return $this->sendResponse($realEstates, 'seccess');
    }
}
