<x-app-layout>

    <x-slot name="header">
        <h4>{{$quiz->title}}</h4><small> {{$quiz->description}}</small>
    </x-slot>
    <div class="card container mt-3">
        <div class="card-body">
            <p class="card-text">
            <h5 class="card-title">
                <a href="{{route('quizzes.index')}}" class="btn btn-sm btn-secondary"><i class="fa fa-arrow-left"></i>
                    Quizlere Dön</a>
            </h5>

            <div class="row">
                <div class="col-md-4 mt-2">
                    <ul class="list-group">
                        @if($quiz->finished_at)
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            Son Katılım Tarihi
                            <span title="{{$quiz->finished_at}}"
                                class="badge bg-warning badge-pill">{{$quiz->finished_at->diffForHumans()}}</span>
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
                            <span class="badge bg-dark badge-pill">{{$quiz->details['average']}}</span>
                        </li>
                        @endif


                        @if(count($quiz->topTen)> 0)
                        <div class="card mt-3">
                            <div class="card-body">
                                <h5 class="card-title">İlk 10</h5>
                                <ul class="list-group">
                                    @foreach($quiz->topTen as $result)
                                    <li class="list-group-item d-flex justify-content-between align-items-center">
                                        <strong class="h5">{{$loop->iteration}}.</strong>
                                        <img class="w-9 h-8 rounded-full" src="{{$result->user->profile_photo_url}}">
                                        <span @if(auth()->user()->id==$result->user_id) class="text-primary"
                                            @endif>{{$result->user->name}}</span>
                                        <span class="badge bg-success badge-pill">{{$result->point}}</span>
                                    </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                        @endif
                    </ul>
                </div>

                <div class="col-md-8">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <div id="carouselExampleFade" class="carousel slide carousel-fade" data-ride="carousel">
                                    <div class="carousel-inner">
                                        <div class="carousel-item active">
                                            <img class="d-block w-100"
                                                src="/public/uploads/velit-ut-facere-reprehenderit-minima-natus-facilis-sit.jpg"
                                                alt="First slide">
                                        </div>
                                        <div class="carousel-item">
                                            <img class="d-block w-100"
                                                src="/public/uploads/impedit-necessitatibus-unde-corporis-sint-impedit-accusamus.png"
                                                alt="Second slide">
                                        </div>
                                        <div class="carousel-item">
                                            <img class="d-block w-100"
                                                src="/public/uploads/s88hac2fdf444b1f0a29f097683c1ad4d4ff2041ff17.jpeg"
                                                alt="Third slide">
                                        </div>
                                    </div>
                                    <a class="carousel-control-prev" href="#carouselExampleFade" role="button"
                                        data-slide="prev">
                                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                        <span class="sr-only">Previous</span>
                                    </a>
                                    <a class="carousel-control-next" href="#carouselExampleFade" role="button"
                                        data-slide="next">
                                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                        <span class="sr-only">Next</span>
                                    </a>
                                </div>


                            </tr>




                            <tr>
                                <th scope="col">Ad Soyad</th>
                                <th scope="col">Puan</th>
                                <th scope="col">Doğru</th>
                                <th scope="col">Yanlış</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($quiz->results as $result)
                            <tr>
                                <th>{{$result->user->name}}</th>
                                <td>{{$result->point}}</td>
                                <td>{{$result->correct}}</td>
                                <td>{{$result->wrong}}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>

                    </p>
                </div>
            </div>
        </div>
</x-app-layout>