<x-app-layout>
    <x-slot name="header">Anasayfa </x-slot>
    <div class="card container mt-3">
        <div class="card-body">
            <p class="card-text">
            <div class="row container">

                <div class="col-md-4">
                    <div class="card">
                        <div class="card-header">
                            <strong>Quiz Sonuçları</strong>
                        </div>
                        <ul class="list-group list-group-flush">
                            @foreach($results as $result)
                            <li class="list-group-item">
                                <!-- <span class="badge bg-success badge-pill">{{$result->point}}</span>  -->
                                @if( $result->point<'50') <span class="badge bg-danger badge-pill">
                                    {{$result->point}}</span>
                                @else( $result->point>'50') <span class="badge bg-success badge-pill">
                                        {{$result->point}}</span>
                                @endif
                                    <a href="{{route('quiz_detail',$result->quiz->slug)}}">
                                        {{$result->quiz->title}}
                                    </a>
                            </li>
                            @endforeach
                        </ul>
                    </div>
                </div>

                <div class="col-md-8">
                    <div class="list-group">
                        @foreach($quizzes as $quiz)
                        <a href="{{route('quiz_detail',$quiz->slug)}}"
                            class="list-group-item list-group-item-action flex-column align-items-start ">
                            <div class="d-flex w-100 justify-content-between">
                                <h5 class="mb-1">{{$quiz->title}}</h5>
                                <small>{{$quiz->finished_at ? $quiz->finished_at->diffForHumans().' bitiyor' : null}}</small>
                            </div>
                            <p class="mb-1">{{Str::limit($quiz->description,100)}}</p>
                            <small>{{$quiz->questions_count}} Soru</small>
                        </a>
                        @endforeach
                        <div class="mt-2">
                            {{$quizzes->links()}}
                        </div>
                    </div>
                </div>

            </div>
</x-app-layout>