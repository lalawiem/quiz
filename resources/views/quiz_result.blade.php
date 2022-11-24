<x-app-layout>
    <x-slot name="header">{{$quiz->title}} Sonucu</x-slot>
    <div class="card container mt-3">
        <div class="card-body">

            <div class= " container col-md-12 alert bg-light float-left">
                <div class= "row align-items-center">
                    <h4>Puan'ın: <strong>{{$quiz->my_result->point}}</strong> </h4>
                </div>
            </div>

        




            @foreach($quiz->questions as $question)
            <strong>- </strong><small>Bu soruya <strong>%{{$question->true_percent}}</strong> oranında doğru cevap
                verildi.</small>
            <br>

            @if($question->correct_answer == $question->my_answer->answer)
            <i class="fa fa-check text-success"></i>
            @else
            <i class="fa fa-times text-danger"></i>

            @endif
            <strong>#{{$loop->iteration}}</strong>

            {{$question->question}}
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