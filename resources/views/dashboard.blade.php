<x-app-layout>
    <x-slot name="header"> <h4>Sonuç Ekranı</h4></x-slot> 
    <div class="card container mt-3">
        <div class="card-body">
            <p class="card-text">
            <div class="row ">
                <div class="col-md-3" style="text-align:center">
                <div align="center">
                <img class="rounded" src="{{ Auth::user()->profile_photo_url }}" alt="{{ Auth::user()->name }}" />
                </div>

                <div class="mt-3">
                    <span class="inline-flex rounded-md">
                        <span class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none transition">
                            <strong> {{ Auth::user()->name }} </strong>
                        </span>
                    </span>
                    </div>

                    <div class="card mt-2 mb-2">
                        <div class="card-header">
                            <strong>Sınav Sonuçları</strong>
                        </div>
                        <ul class="list-group list-group-flush">
                            @foreach($results as $result)
                            <li class="list-group-item" style="text-align:left">
                                <!-- <span class="badge bg-success badge-pill">{{$result->point}}</span>  -->
                                <strong> Puan: </strong>
                                @if($result->point<'50') <span class="badge bg-danger">
                                    {{$result->point}}</span>
                                    @else( $result->point>'50') <span class="badge bg-success">
                                        {{$result->point}}</span>
                                @endif
                                    <strong> - </strong>
                                    <a href="{{route('quiz_detail',$result->quiz->slug)}}">
                                        {{$result->quiz->title}}
                                    </a>
                            </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
                <div class="col-md-9 mb-3">
                    <div class="list-group">
                        @foreach($quizzes as $quiz)
                        <a href="{{route('quiz_detail',$quiz->slug)}}"
                            class="list-group-item list-group-item-action flex-column align-items-start ">
                            <div class="d-flex w-100 justify-content-between">
                                <h4 class="mb-0">{{$quiz->title}}</h4>
                                <small>{{$quiz->finished_at ? $quiz->finished_at->diffForHumans().' bitiyor.' : null}}</small>
                            </div>

                            <p class="mb-1">{{Str::limit($quiz->description,50)}}</p>
                            <strong> <small>{{$quiz->questions_count}} Soru</small></strong>

                            <div class="float-right text-success">
                                @if($quiz->my_result)
                                <strong> Tamamlandı </strong>
                                @else
                            </div>
                            <div class="float-right text-danger">
                                <strong> Tamamlanmadı </strong>
                                @endif
                            </div>
                        </a>
                        @endforeach
                        <div class="mt-2">
                            {{$quizzes->links()}}
                        </div>
                    </div>
                </div>
            </div>
</x-app-layout>