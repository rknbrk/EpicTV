<?php

namespace App\Http\Controllers;

use App\Stream;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function store($stream_slug)
    {


        $stream_id = Stream::where('slug',$stream_slug)->first();

        $data = request()->validate([
            'comment' => 'required',
        ]);

        $data['user_id'] = auth()->user()->id;
        $data['stream_id'] = $stream_id->id;

        $comment = \App\Comment::create($data);

        return redirect('/streams/'.$stream_slug);


    }
}
