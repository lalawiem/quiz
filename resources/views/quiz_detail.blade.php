<x-app-layout>
    <x-slot name="header">
        <h4>{{$quiz->title}}</h4>
    </x-slot>
    <div class="card container mt-3">
        <div class="row">
            <div class="card-body">
                <div class="row">
                    <h5 class="float-right">
                        <a href="{{route('dashboard')}}" class="btn btn-outline-secondary mr-1"><i
                                class="fa fa-arrow-left mr-1"></i><strong> Geriye dön </strong></a>
                    </h5>
                    <div class="col-md-4 mt-2">
                        <ul class="list-group">
                            @if($quiz->my_rank)
                            <li class="list-group-item d-flex justify-content-between align-items-center">Sıralama
                                <span title="{{$quiz->finished_at}}"
                                    class="badge bg-primary badge-pill">{{$quiz->my_rank}}</span>
                            </li>
                            @endif

                            @if($quiz->my_result)
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                <strong>Puan</strong>
                                <span title="{{$quiz->finished_at}}">
                                    @if($quiz->my_result->point<'50') <span class="badge bg-danger badge-pill">
                                        {{$quiz->my_result->point}}</span>
                                @else($quiz->my_result->point>'50') <span class="badge bg-success badge-pill">
                                    {{$quiz->my_result->point}}</span>
                                @endif

                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center"><strong> Doğru
                                    /
                                    Yanlış Sayısı </strong>
                                <div class="float-right">
                                    <span title="{{$quiz->finished_at}}"
                                        class="badge bg-success badge-pill">{{$quiz->my_result->correct}} Doğru</span>
                                    <span title="{{$quiz->finished_at}}"
                                        class="badge bg-danger badge-pill">{{$quiz->my_result->wrong}} Yanlış</span>
                                </div>
                            </li>
                            @endif

                            @if($quiz->finished_at)
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                <strong> Son Katılım Tarihi </strong>
                                <span title="{{$quiz->finished_at}}"
                                    class="badge bg-warning text-black badge-pill">{{$quiz->finished_at->diffForHumans()}}</span>
                            </li>
                            @endif
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                Soru Sayısı
                                <span class="badge bg-secondary badge-pill">{{$quiz->questions_count}}</span>
                            </li>

                            @if($quiz->details)
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                Katılımcı Sayısı
                                <span class="badge bg-secondary badge-pill">{{$quiz->details['join_count']}}</span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                Ortalama Puan
                                <span class="badge bg-secondary badge-pill">{{$quiz->details['average']}}</span>
                            </li>
                            @endif
                        </ul>

                        @if(count($quiz->topTen)> 0)
                        <div class="card mt-3 mb-3">
                            <div class="card-body">
                                <h5 class="card-title ml-2"> En Yüksek Puanlar:</h5>
                                <ul class="list-group">
                                    @foreach($quiz->topTen as $result)
                                    <li class="list-group-item d-flex justify-content-between align-items-center">
                                        <strong class="h5 mt-2">{{$loop->iteration}}.</strong> 
                                        <img class="w-8 h8 rounded-full" src="{{$result->user->profile_photo_url}}">
                                        <span @if(auth()->user()->id==$result->user_id) class="text-primary" @endif>
                                            <strong>{{$result->user->name}}</strong> </span>
                                        <span class="badge bg-dark badge-pill">{{$result->point}}</span>
                                    </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                        @endif
                    </div>

                    <div class="col-md-8 mt-2">
                        <div id="carouselExampleIndicators" class="carousel slide carousel-fade" data-ride="carousel">
                            <ol class="carousel-indicators">
                                <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
                                <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
                                <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
                            </ol>
                            <div class="carousel-inner">
                                <div class="carousel-item active">

                                    <img src="/uploads/impedit-necessitatibus-unde-corporis-sint-impedit-accusamus.png "
                                        alt="First slide">
                                    <div class="carousel-caption d-none d-md-block">
                                        <h5 style="color:black;"> <strong> {{$quiz->title}} </strong> </h5>
                                    </div>
                                </div>

                                <div class="carousel-item">
                                    <img src="/uploads/impedit-necessitatibus-unde-corporis-sint-impedit-accusamus.png"
                                        alt="Second slide">
                                    <div class="carousel-caption d-none d-md-block">
                                        <h5 style="color:black;"> <strong> {{$quiz->title}} </strong> </h5>
                                    </div>
                                </div>

                                <div class="carousel-item">
                                    <img src="/uploads/ratione-nulla-quis-officia-quis-voluptas-optio.png"
                                        alt="Third slide">
                                    <div class="carousel-caption d-none d-md-block">
                                        <h5 style="color:black;"> <strong> {{$quiz->title}} </strong> </h5>
                                    </div>
                                </div>
                                <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button"
                                    data-slide="prev">
                                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                    <span class="sr-only">Previous</span>
                                </a>
                                <a class="carousel-control-next" href="#carouselExampleIndicators" role="button"
                                    data-slide="next">
                                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                    <span class="sr-only">Next</span>
                                </a>
                            </div>
                            <div class="mt-2">
                                {{$quiz->description}}
                            </div>
                            </p>
                            <div class="mb-2">
                                @if($quiz->my_result)
                                <a href="{{route('quiz.join',$quiz->slug)}}"
                                    class="btn btn-warning btn-sm w-100">Sınav'ı
                                    Görüntüle</a>
                                @elseif($quiz->finished_at>now())
                                <a href="{{route('quiz.join',$quiz->slug)}}" class="btn btn-primary btn-sm w-100">Sınava
                                    Katıl</a>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
</x-app-layout>