@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8" >
                <div class="card">


                    <div class="card-header">Stream List</div>

                    <div class="card-body">


                        @if(auth()->user()->user_type == '2')
                            <a href="streams/new" class="btn btn-success">Add a Stream</a>
                        @endif

                        <br>

                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif
                        <br>
                        <div class="row" style="text-align: center;">
                        @forelse($streams as $stream)


                                <div class="col-md-3">
                                    <div class="thumbnail">
                                        <a href="streams/{{ $stream->slug }}">
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
                <div class="text-xs-center">
                    {{ $streams->links() }}

                </div>
            </div>

        </div>
    </div>
@endsection
