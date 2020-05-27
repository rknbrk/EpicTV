<?php

namespace App\Http\Controllers;

use App\Comment;
use DB;
use App\Customer;
use App\Stream;
use Illuminate\Http\Request;

class StreamController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $streams = Stream::paginate(12);;

        return view('streams.index',compact('streams'));
    }

    public function create()
    {
        return view('streams.create');
    }

    public function show($stream_slug)
    {

        $stream_id = Stream::where('slug',$stream_slug)->first();

        DB::table('streams')
            ->where('slug', $stream_slug)
            ->update([
                'visit_count' => DB::raw('visit_count + 1'),
            ]);

        $comments = Comment::where('comments.stream_id',$stream_id->id)
            ->leftJoin('users', 'users.id', '=', 'comments.user_id')
            ->select('users.name','comments.comment','comments.created_at')->paginate(5);


        $streams_all = Stream::all()->sortByDesc("visit_count")->take(6);

        $streams= Stream::where('slug',$stream_slug)->firstOrFail();

        return view('streams.show', compact('streams','streams_all','comments'));
    }

    public function edit($stream_slug)
    {
        $streams= Stream::where('slug',$stream_slug)->first();

        return view('streams.edit', compact('streams'));
    }

    public function update($stream_slug)
    {
        $data = request()->validate([
            'title' => 'required',
            'description' => 'required',
            'stream_type' => 'required',
            'stream_url' => 'required',
            'photo_url' => 'required'
        ]);

        $data['user_id'] = auth()->user()->id;

        $data['slug'] = $this->fixForUri(request('title'));




        //$stream = Stream::update($data);

        $streams = Stream::where('slug',$stream_slug)->first();

        //dd($streams);
        $streams->update($data);

        //Stream::update($data);



        return redirect('/streams');
    }


    public function destroy(Customer $customer)
    {

        $customer->delete();


        return redirect('/customer');
    }


    public function store()
    {


        $data = request()->validate([
            'title' => 'required',
            'description' => 'required',
            'stream_type' => 'required',
            'stream_url' => 'required',
            'photo_url' => 'required',
        ]);

        $data['user_id'] = auth()->user()->id;
        $data['slug'] = $this->fixForUri(request('title'));

        $stream = \App\Stream::create($data);

        return redirect('/streams');





    }



    public function fixForUri($string){
        $slug = trim($string); // trim the string
        $slug= preg_replace('/[^a-zA-Z0-9 -]/','',$slug ); // only take alphanumerical characters, but keep the spaces and dashes too...
        $slug= str_replace(' ','-', $slug); // replace spaces by dashes
        $slug= strtolower($slug);  // make it lowercase
        return $slug;
    }
}

