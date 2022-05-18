@extends('user.template.base')
@section('title', 'Dashboard App Your Happinies')
@section('content')
    <div class="content-wrapper">
        <div class="row">
            <div class="col-12 col-xl-8 mb-4 mb-xl-0">
                <h3 class="font-weight-bold">Welcome to My AppInsta</h3>
                <h6 class="font-weight-normal mb-0">{{ auth()->user()->name }} , Share your happiness today </h6>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 grid-margin stretch-card">
                <div class="card position-relative">
                    <div class="card-body">
                        <div id="detailedReports" class="carousel slide detailed-report-carousel position-static pt-2"
                            data-ride="carousel">
                            <div class="carousel-inner">
                                <?php $carousel = 1;
                                $no = 0; ?>
                                @foreach ($post as $post)
                                    <?php if($carousel == 1){ ?>
                                    <div class="carousel-item active">
                                        <?php }else{ ?> <div class="carousel-item">
                                            <?php } ?>
                                            <div class="row">
                                                <div class="col-md-12 col-xl-5" style="margin: auto;">
                                                    <img src="{{ asset('storage/thumbnail/' . $post->image) }}"
                                                        style="width: 400px; height: 226px;" alt="people">
                                                </div>
                                                <div class="col-md-12 col-xl-7">
                                                    <div class="row">
                                                        <div class="col-md-6 border-right">
                                                            <p class="card-title">{{ $post->userto->name }}</p>
                                                            <p class="mb-2 mb-xl-0">{{ $post->content }}</p>
                                                            <div style="margin-top: 20px;">
                                                                <?php if($like[$no]->likes > 0) {
                                                                    if(str_contains($like[$no]->user_likes, ',') or $like[$no]->user_likes){
                                                                        $user_likes = explode(',',$like[$no]->user_likes);
                                                                        if(in_array($user_session,$user_likes)){ ?>
                                                                               <form action="{{ route('user.unlike', $post->id) }}"
                                                                                method="POST">
                                                                                @csrf
                                                                                <a href="{{ route('user.commentar', $post->id) }}"
                                                                                    style="color: darkgrey">
                                                                                    <i class="mdi mdi-comment"></i>
                                                                                </a>
                                                                                <button style="border-width: 0px;">
                                                                                    <i class="mdi mdi-heart" id="like"
                                                                                        style="color:red"></i>
                                                                                </button>
                                                                                <p><b>like by {{ $like[$no]->likes }} users</b></p>
                                                                            </form>
                                                                          <?php }else{ ?>
                                                                            <form action="{{ route('user.like', $post->id) }}"
                                                                                method="POST">
                                                                                @csrf
                                                                                <a href="{{ route('user.commentar', $post->id) }}"
                                                                                    style="color: darkgrey">
                                                                                    <i class="mdi mdi-comment"></i>
                                                                                </a>
                                                                                <button style="border-width: 0px;">
                                                                                    <i class="mdi mdi-heart" id="like"
                                                                                        style="color:darkgrey"></i>
                                                                                </button>
                                                                                <p><b>like by {{ $like[$no]->likes }} users</b></p>
                                                                            </form>
                                                                <?php }}}else{ ?>
                                                                    <form action="{{ route('user.like', $post->id) }}"
                                                                        method="POST">
                                                                        @csrf
                                                                        <a href="{{ route('user.commentar', $post->id) }}"
                                                                            style="color: darkgrey">
                                                                            <i class="mdi mdi-comment"></i>
                                                                        </a>
                                                                        <button style="border-width: 0px;">
                                                                            <i class="mdi mdi-heart" id="like"
                                                                                style="color:darkgrey"></i>
                                                                        </button>
                                                                    </form>
                                                                <?php } ?>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <p class="card-title">Komentar:</p>
                                                            <div class="card">
                                                                <div class="card-body">
                                                                    <ul class="icon-data-list">
                                                                        <?php if (str_contains($info[$no]->comment, ',')) { 
                                                                        $commentar = explode(',',$info[$no]->comment);
                                                                        $user =  explode(',',$info[$no]->user_name);
                                                                        $lengthcommentar = count($commentar);
                                                                        for ($x = 0; $x < $lengthcommentar; $x++) {?>
                                                                        <li>
                                                                            <div class="d-flex">
                                                                                <img src="{{ asset('images/faces/face1.jpg') }}"
                                                                                    alt="user">
                                                                                <div>
                                                                                    <p class="text-info mb-1">
                                                                                        <?php echo $user[$x]; ?></p>
                                                                                    <p class="mb-0">
                                                                                        <?php echo $commentar[$x]; ?></p>
                                                                                    <small>9:30 am</small>
                                                                                </div>
                                                                            </div>
                                                                        </li><?php }} elseif($info[$no]->comment){?>
                                                                        <li>
                                                                            <div class="d-flex">
                                                                                <img src="{{ asset('images/faces/face1.jpg') }}"
                                                                                    alt="user">
                                                                                <div>
                                                                                    <p class="text-info mb-1">
                                                                                        <?php echo $info[$no]->user_name; ?></p>
                                                                                    <p class="mb-0">
                                                                                        <?php echo $info[$no]->comment; ?></p>
                                                                                    <small>9:30 am</small>
                                                                                </div>
                                                                                <?php } ?>
                                                                    </ul>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <?php $carousel++;
                                        $no++; ?>
                                @endforeach


                            </div>
                            <a class="carousel-control-prev" href="#detailedReports" role="button" data-slide="prev">
                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                <span class="sr-only">Previous</span>
                            </a>
                            <a class="carousel-control-next" href="#detailedReports" role="button" data-slide="next">
                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                <span class="sr-only">Next</span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endsection
