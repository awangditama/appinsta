@extends('user.template.base')
@section('title','Comment Post')
@section('content')
<div class="content-wrapper">
    <div class="row">
      <div class="col-md-6 grid-margin stretch-card">
        <div class="card">
          <div class="card-body">
            <h4 class="card-title">Happinees From : </h4>
            <p class="card-description">
              {{ $name->name }} 
            </p>
            <p>
              <img src="{{  asset('storage/thumbnail/'.$post->image) }}" style="width: 400px; height: 226px;"/>
            </p>
            <p>
               {{ $post->content }} 
            </p>
          </div>
        </div>
      </div>
      <div class="col-md-6 grid-margin stretch-card">
        <div class="card">
          <div class="card-body">
            <h4 class="card-title">Commentar : </h4>
            <div class="row">
              <form class="pt-3" method="POST" action="{{ route('user.create-commentar',$post->id) }}">
                @csrf
                <div class="form-group">
                  <textarea name="comment" class="form-control form-control-lg" id="exampleInputUsername1" placeholder="comment">{{ old('comment') }}</textarea>
                  @error('comment')
                  <div style="color:red">{{ $message}}</div>
                  @enderror
                </div>
                <div class="mt-3">
                  <button class="btn btn-block btn-primary btn-sm font-weight-medium auth-form-btn">Comment</button>
                </div>
              </form>
            </div>
            <ul class="icon-data-list" style="margin-top:20px;">
              @foreach($commentar as $commentar)
              <li>
                  <div class="d-flex">
                      <img src="{{ asset('images/faces/face1.jpg') }}" alt="user">
                      <div>
                          <p class="text-info mb-1">{{ $commentar->userto->name }}</p>
                          <p class="mb-0">{{ $commentar->comment }}</p>
                          <small>9:30 am</small>
                      </div>
                  </div>
              </li>
              @endforeach
          </ul>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection