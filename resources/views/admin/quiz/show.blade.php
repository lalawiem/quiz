<x-app-layout>

    <x-slot name="header">
        <h4>{{$quiz->title}}</h4><small> {{$quiz->description}}</small>
    </x-slot>
    <div class="card container mt-3">
        <div class="card-body">
            <h5 class="card-title mb-2">
            <a href="{{route('quizzes.index')}}" class="btn btn-outline-secondary mb-1"><i
                        class="fa fa-arrow-left mr-2"></i><strong>Sınavlara dön</strong></a>
            </h5>

            <div class="row">
                <div class="col-md-4">
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
                        <div class="card mt-3 mb-3">
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

                </div>
            </div>
        </div>
</x-app-layout>