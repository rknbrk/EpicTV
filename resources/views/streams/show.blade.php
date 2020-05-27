@extends('layouts.app')

<!-- Flowplayer skin -->
<link rel="stylesheet" href="//releases.flowplayer.org/7.2.1/skin/skin.css">

<!-- Minimal styling for this standalone page, can be removed -->
<link rel="stylesheet" href="//demos.flowplayer.com/media/css/demo.css">
<!-- Syntax highlighting of source code, can be removed -->
<link rel="stylesheet" href="//demos.flowplayer.com/media/css/pygments.css">

<!-- Flowplayer depends on jquery 1.7.2+ for video tag based installations -->
<script src="//code.jquery.com/jquery-1.12.4.min.js"></script>
<!-- Flowplayer library -->
<script src="//releases.flowplayer.org/7.2.1/flowplayer.min.js"></script>
<!-- The hlsjs plugin (light) for playback of HLS without Flash in modern browsers -->
<script src="//releases.flowplayer.org/hlsjs/flowplayer.hlsjs.light.min.js"></script>

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">




                    <div class="card-body">


                        <div class="row" style="text-align: center;">
                            @forelse($streams_all as $stream)


                                <div class="col-md-2">
                                    <div class="thumbnail">
                                        <a href="{{ $stream->slug }}">
                                            <img src="{{ $stream->photo_url }}" alt="{{ $stream->title }}" style="width:50px;height: 50px;">
                                            <div class="caption" >
                                                <p>{{ $stream->title }}</p>
                                            </div>
                                        </a>
                                    </div>
                                </div>

                                <br>

                            @empty
                                No stream available!
                            @endforelse
                        </div>

                    </div>
                </div>

                <br>
                <h3>{{ $streams->title }}
                    @if(auth()->user()->user_type == '2')
                        <a href="/streams/{{ $streams->slug}}/edit" >(Edit)</a>
                    @endif

                </h3>



                    <div id="play" >

                        {!! $streams->stream_url !!}

                    </div>
                      <br>
                    <br>
                    <h4>About</h4>
                    <h5>{{ $streams->description }}</h5>
                <br>
                <h4>&nbsp;Comments</h4>

                @forelse($comments as $comment)
                    <div class="alert alert-warning">

                        <strong><u>{{$comment->name}} ({{$comment->created_at->format('d-m-Y H:i:s')}}):</u></strong>
                        <p style="white-space: pre-line">
                             {{$comment->comment}}
                        </p>
                    </div>
                @empty

                @endforelse
                <br>
                <div class="text-xs-center">
                    {{ $comments->links() }}

                </div>

                <form method="POST" action="/streams/comment/{{$streams->slug}}">
                    @csrf


                    <div class="form-group row">



                        <div class="col-md-12">
                            <textarea class="form-control @error('comment') is-invalid @enderror" name="comment"  rows="5" id="description"></textarea>

                            @error('comment')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row mb-0">
                        <div class="col-md-6">
                            <button type="submit" class="btn btn-primary">
                                Send Comment
                            </button>
                        </div>
                    </div>
                </form>

            </div>
        </div>
    </div>
@endsection
