<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Comment;
use App\RealEstate;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class CommentsController extends Controller
{

    public function add(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'text' => 'required'
        ]);

        if ($validator->fails()) {
            $request->session()->flash('comment_error');
            return redirect()->route('realestates.show', [app()->getLocale(), $id])->withErrors($validator);
        }

        $realEstate = RealEstate::find($id);
        if ($realEstate == null) {
            throw new NotFoundHttpException('realestate with id ' . $id . ' not found');
        }

        $comment = new Comment();
        $comment->real_estate_id = $id;
        $comment->text = $request->input('text');
        $comment->user_id = auth()->user()->id;
        $comment->save();
        $request->session()->flash('comment', 'comment-' . $comment->id);
        return redirect()->route('realestates.show', [app()->getLocale(), $id]);
    }
}
