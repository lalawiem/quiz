<x-app-layout>
    <x-slot name="header">{{$quiz->title}}</x-slot>
    <div class="card container mt-3">
        <div class="card-body">
            <p class="card-text">
            <form method="POST" action="{{route('quiz.result',$quiz->slug)}}">
                @csrf
                @foreach($quiz->questions as $question)
    
                <strong>#{{$loop->iteration}}</strong> {{$question->question}}

                @if($question->image)
                <img src="{{asset($question->image)}}" style="width: 50%" class="img-responsive ">
                @endif

                <div class="form-check mt-2">
                    <input class="form-check-input" type="radio" name="{{$question->id}}" id="{{$question->name}}"
                        value="answer1" required>
                    <label class="form-check-label" for="quiz{{$question->id}}">
                        {{$question->answer1}}
                    </label>
                </div>

                <div class="form-check">
                    <input class="form-check-input" type="radio" name="{{$question->id}}" id="{{$question->name}}"
                        value="answer2" required>
                    <label class="form-check-label" for="quiz{{$question->id}}">
                        {{$question->answer2}}
                    </label>
                </div>

                <div class="form-check">
                    <input class="form-check-input" type="radio" name="{{$question->id}}" id="{{$question->name}}"
                        value="answer3" required>
                    <label class="form-check-label" for="quiz{{$question->id}}">
                        {{$question->answer3}}
                    </label>
                </div>

                <div class="form-check">
                    <input class="form-check-input" type="radio" name="{{$question->id}}" id="{{$question->name}}"
                        value="answer4" required>
                    <label class="form-check-label" for="quiz{{$question->id}}">
                        {{$question->answer4}}
                    </label>
                </div>
                @if(!$loop->last)
                <hr>
                @endif
                @endforeach
                <button type="submit" class="btn btn-success btn-sm btn-block">Sınavı Bitir</button>
            </form>

            </p>
        </div>
    </div>
</x-app-layout>