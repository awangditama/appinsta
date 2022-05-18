@extends('user.template.base')
@section('title','Create Your Posts')
@section('content')
<div class="content-wrapper">
<div class="row">
<div class="col-lg-12 grid-margin stretch-card">
<div class="col-12 grid-margin stretch-card">
    <div class="card">
      <div class="card-body">
        <h4 class="card-title">Post Story</h4>
        <p class="card-description">
          Share Your Happiness
        </p>
        <form class="forms-sample" action="{{ route('user.create.post') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="user_id" value="{{ auth()->user()->id }}"/>
            <div class="form-group">
                <label for="exampleTextarea1">Story</label>
                <textarea name="content" class="form-control"  id="exampleTextarea1" rows="4">{{ old('content') }}</textarea>
                @error('content')
                <div style="color:red">{{ $message}}</div>
                @enderror
              </div>
            <div class="form-group">
                <label>Images</label>
                <input type="file" name="image" class="file-upload-default">
            <div class="input-group col-xs-12">
              <input type="text" class="form-control file-upload-info" disabled placeholder="Upload Image">
              <span class="input-group-append">
                <button class="file-upload-browse btn btn-primary" type="button">Upload</button>
              </span>
              @error('image')
                <div style="color:red">{{ $message}}</div>
                @enderror              
            </div>
          </div>
          <button type="submit" class="btn btn-primary mr-2">Submit</button>
        </form>
      </div>
    </div>
  </div>
</div>
</div>
@endsection