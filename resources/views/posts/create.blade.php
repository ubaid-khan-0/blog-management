@extends('master')

@section('content')

<div class="container mt-5">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between">
                    <h2>Create Post </h2><a class="btn btn-primary" href="{{ route('posts.index') }}">Back</a>
                </div>
                <div class="card-body">
                    <form action="{{ route('posts.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-sm-12">
                            <label>Title</label>
                            <input type="text" name="title" class="form-control" required>
                                @error('title')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror

                            </div>
                            <div class="col-sm-12 mt-4">
                            <label>Content</label>
                            <textarea name="content" rows="5" class="form-control" required></textarea>
                                @error('content')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-sm-12 mt-4">
                            <label class="control-label font-weight-600">Image <span class="text-danger fw-bold">size(370*420) *</span></label>
                                                        <input type="file" class="form-control dropify" name="image" data-default-file="{{ (!empty($editspeaker)) ? asset('storage/'.$editspeaker->image) : '' }}">
                                                        @error('image')
                                                        <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                           
                        </div>
                        <button class="btn btn-primary mt-4" type="submit">Create</button>
                    </form>

                </div>

            </div>
        </div>
    </div>
</div>
@endsection
