@extends('template.diffapp')
@section('content')
<div class="masthead">
    <div class="page-header text-center">
        <h1 class="display-1">
            OlaWikiWiki
            <br>
            <small class="text-muted">Welcome</small>
        </h1>
    </div>
    <div class="carousel carousel-landing slider" id="carousel-158813">
        <div class="carousel-inner text-center">
            <div class="carousel-item active">
                <img class="d-block w-100" alt="Top Community #1" src="{{ asset('storage/'.$comunity[0]->banner) }}">
                <div class="carousel-caption">
                    <h4 class="display-4 text-white">
                        <a class="badge text-white" href="{{ route('comunity.show',$comunity[0]->name) }}">{{ $comunity[0]->name }}</a>
                    </h4>
                    {{-- <p class="lead">Cras justo odio, dapibus ac facilisis in, egestas eget quam. Donec id elit non mi porta gravida at eget metus. Nullam id dolor id nibh ultricies vehicula ut id elit.</p> --}}
                </div>
            </div>
            <div class="carousel-item">
                <img class="d-block w-100" alt="Top Community #2" src="{{ asset('storage/'.$comunity[1]->banner) }}">
                <div class="carousel-caption">
                    <h4 class="display-4 text-white">
                        <a class="badge text-white" href="{{ route('comunity.show',$comunity[1]->name) }}">{{ $comunity[1]->name }}</a>
                    </h4>
                    {{-- <p class="lead">Cras justo odio, dapibus ac facilisis in, egestas eget quam. Donec id elit non mi porta gravida at eget metus. Nullam id dolor id nibh ultricies vehicula ut id elit.</p> --}}
                </div>
            </div>
            <div class="carousel-item">
                <img class="d-block w-100" alt="Top Community #2" src="{{ asset('storage/'.$comunity[1]->banner) }}">
                <div class="carousel-caption">
                    <h4 class="display-4 text-white">
                        <a class="badge text-white" href="{{ route('comunity.show',$comunity[2]->name) }}">{{ $comunity[2]->name }}</a>
                    </h4>
                    {{-- <p class="lead">Cras justo odio, dapibus ac facilisis in, egestas eget quam. Donec id elit non mi porta gravida at eget metus. Nullam id dolor id nibh ultricies vehicula ut id elit.</p> --}}
                </div>
            </div>
        </div>
        <a class="carousel-control-prev" href="#carousel-158813" data-slide="prev"><span class="carousel-control-prev-icon"></span> <span class="sr-only">Previous</span></a> <a class="carousel-control-next" href="#carousel-158813" data-slide="next"><span class="carousel-control-next-icon"></span> <span class="sr-only">Next</span></a>
    </div>
</div>
@endsection
@section('diffContent')
<br>
<div class="row">
    <div class="col-md-12">
      <div id="card-780788">
                <div class="card">
                    <div class="card-header text-center">
                         <a class="card-link" data-toggle="collapse" data-parent="#card-780788" href="#card-element-473299">Our Top Community</a>
                    </div>
                    <div id="card-element-473299" class="collapse">
                        @foreach($comunity as $item)
                        <div class="card-body">
                            {{ $item->name }}
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>  
    </div>
</div>
@endsection