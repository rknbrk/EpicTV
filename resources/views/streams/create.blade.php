@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">


                    <div class="card-header">Add New Stream</div>

                    <div class="card-body">

                        <form method="POST" action="{{ route('store_stream') }}">
                            @csrf

                            <div class="form-group row">
                                <label for="title" class="col-md-4 col-form-label text-md-right">Title</label>

                                <div class="col-md-6">
                                    <input id="title" type="text" class="form-control @error('title') is-invalid @enderror" name="title" value="{{ old('title') }}" required autocomplete="title" autofocus>

                                    @error('title')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="description" class="col-md-4 col-form-label text-md-right">Description</label>

                                <div class="col-md-6">
                                    <textarea class="form-control @error('description') is-invalid @enderror" name="description" value="{{ old('description') }}"  rows="5" id="description"></textarea>

                                    @error('description')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="stream_type" class="col-md-4 col-form-label text-md-right">Stream Type</label>

                                <div class="col-md-6">
                                    <div class="form-group">

                                        <select class="form-control @error('stream_type') is-invalid @enderror" id="stream_type" name="stream_type" required>
                                            <option value="1">Embed</option>
                                            <option value="2">HLS</option>
                                            <option value="3">IFrame</option>
                                            <option value="4">YouTube</option>
                                        </select>
                                    </div>


                                    @error('stream_type')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="stream_url" class="col-md-4 col-form-label text-md-right">Stream URL</label>

                                <div class="col-md-6">
                                    <textarea class="form-control @error('stream_url') is-invalid @enderror" name="stream_url" value="{{ old('stream_url') }}"  rows="7" id="stream_url" required>
                                        <div id="player" data-live="true" data-ratio="0.5625" data-share="false" class="flowplayer fp-mute">
                                            <video autoplay data-title="#"><source type="application/x-mpegurl" src="#"></video>
                                        </div>
                                    </textarea>

                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="photo_url" class="col-md-4 col-form-label text-md-right">Photo URL</label>

                                <div class="col-md-6">
                                    <input id="photo_url" type="text" class="form-control" name="photo_url" required autocomplete="photo_url">
                                </div>
                            </div>

                            <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        Save Stream
                                    </button>
                                </div>
                            </div>
                        </form>



                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
