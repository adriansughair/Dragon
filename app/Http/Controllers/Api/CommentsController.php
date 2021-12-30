<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Api\BaseController as BaseController;
use Illuminate\Http\Request;
use App\Comment;
use App\RealEstate;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class CommentsController extends BaseController
{
    public function get(Request $request, $id)
    {
        $comments = Comment::where('real_estate_id', $id)->with([
            'user' => function ($query) {
                $query->select('id', 'name', 'phone_number', 'whatsapp');
            },
        ])->get();
        return $this->sendResponse($comments, "test");
    }

    public function add(Request $request, $id)
    {
        $realEstate = RealEstate::find($id);
        if ($realEstate == null) {
            throw new NotFoundHttpException('realestate with id ' . $id . ' not found');
        }

        $comment = new Comment();
        $comment->real_estate_id = $id;
        $comment->text = $request->get('text');
        $comment->user_id = auth('api')->user()->id;
        $comment->save();
        return $this->sendResponse($comment, 'success');
    }
}
