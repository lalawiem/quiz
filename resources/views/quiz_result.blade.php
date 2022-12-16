<x-app-layout>
    <x-slot name="header"> <h4>{{$quiz->title}}</h4> </x-slot>
        <div class="card container mt-3">
            <div class="card-body">
                <div class= "float-left mt-1"> 
                    <a href="{{route('dashboard')}}" class="btn btn-outline-secondary float-left">
                        <i class="fa fa-arrow-left mr-1"></i> <strong> Anasayfaya Dön </strong>
                    </a>
                </div>

                <div class= "float-right mr-3 mt-1"> 
                    @if($quiz->my_result)
                        <h4> Aldığın puan: <span title="{{$quiz->finished_at}}">
                            @if($quiz->my_result->point<'50') <span class="badge bg-danger badge-pill">
                                {{$quiz->my_result->point}}</span>
                            @else($quiz->my_result->point>'50') <span class="badge bg-success badge-pill">
                                {{$quiz->my_result->point}}</span> 
                            @endif
                        </h4>    
                    @endif
                </div>
            </div>

            <div class="card-body">
            @foreach($quiz->questions as $question)
            <strong>- </strong><small>Bu soruya <strong>%{{$question->true_percent}}</strong> oranında doğru cevap verildi.</small>
            <br>
            
            <h5> 
                @if($question->correct_answer == $question->my_answer->answer)
                <i class="fa fa-check text-success"></i>
                @else
                <i class="fa fa-times text-danger"></i>
                @endif

                <strong>{{$loop->iteration}}.</strong>
                {{$question->question}}
            </h5>

            @if($question->image)
            <img src="{{asset($question->image)}}" style="width: 50%" class="img-responsive">
            @endif

            <div class="form-check mt-2">
                @if('answer1' == $question->correct_answer)
                <i class="fa fa-check text-success"></i>
                @elseif('answer1' == $question->my_answer->answer)
                <i class="fa fa-times text-danger"></i>
                @endif
                <label class="form-check-label" for="quiz{{$question->id}}">
                    {{$question->answer1}}
                </label>
            </div>

            <div class="form-check">
                @if('answer2' == $question->correct_answer)
                <i class="fa fa-check text-success"></i>
                @elseif('answer2' == $question->my_answer->answer)
                <i class="fa fa-times text-danger"></i>
                @endif
                <label class="form-check-label" for="quiz{{$question->id}}">
                    {{$question->answer2}}
                </label>
            </div>

            <div class="form-check">
                @if('answer3' == $question->correct_answer)
                <i class="fa fa-check text-success"></i>
                @elseif('answer3' == $question->my_answer->answer)
                <i class="fa fa-times text-danger"></i>
                @endif
                <label class="form-check-label" for="quiz{{$question->id}}">
                    {{$question->answer3}}
                </label>
            </div>

            <div class="form-check">
                @if('answer4' == $question->correct_answer)
                <i class="fa fa-check text-success"></i>
                @elseif('answer4' == $question->my_answer->answer)
                <i class="fa fa-times text-danger"></i>
                @endif
                <label class="form-check-label" for="quiz{{$question->id}}">
                    {{$question->answer4}}
                </label>
            </div>
            @if(!$loop->last)
            <hr>
            @endif
            @endforeach
        </div>
    </div>
</x-app-layout>