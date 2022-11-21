<x-app-layout>
    <x-slot name="header">{{$question->question}} Düzenle</x-slot>

    <div class="card container mt-3">
        <div class="card-body">
            <form method="POST" action="{{route('questions.update',[$question->quiz_id,$question->id])}} "
                enctype="multipart/form-data">

                @csrf
                @method('PUT')
                <div class="form-group mt-2">
                    <label>Soru</label>
                    <textarea name="question" class="form-control" rows=4">{{ $question->question }}</textarea>
                </div>

                <div class="form-group mt-2">
                    <label>Fotoğraf</label>
                    @if($question->image)
                    <a href="{{ asset($question->image) }}" target="_blank">
                        <img src="{{asset($question->image)}}" class"img-responsive" style="width: 200px">
                    </a>
                    @endif
                    <input type="file" name="image" class="form-control">
                </div>

                <div class="row mt-2">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label> 1. Cevap</label>
                            <textarea name="answer1" class="form-control" rows=2">{{ $question->answer1 }}</textarea>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label> 2. Cevap</label>
                            <textarea name="answer2" class="form-control" rows=2">{{ $question->answer2 }}</textarea>
                        </div>
                    </div>
                </div>

                <div class="row mt-2">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label> 3 Cevap</label>
                            <textarea name="answer3" class="form-control" rows=2">{{ $question->answer3 }}</textarea>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label> 4. Cevap</label>
                            <textarea name="answer4" class="form-control" rows=2">{{ $question->answer4 }}</textarea>
                        </div>
                    </div>
                </div>

                <div class="form-group mt-2">
                    <label>Doğru Cevap</label>
                    <select name="correct_answer" class="form-control">
                        <option @if($question->correct_answer==='answer1') selected @endif value="answer1">1. Cevap
                        </option>
                        <option @if($question->correct_answer==='answer2') selected @endif value="answer4">2. Cevap
                        </option>
                        <option @if($question->correct_answer==='answer3') selected @endif value="answer3">3. Cevap
                        </option>
                        <option @if($question->correct_answer==='answer4') selected @endif value="answer2">4. Cevap
                        </option>

                    </select>
                </div>

                <div class="form-group mt-3">
                    <button type="submit" class="btn btn-primary btn-sm w-100"">Soruyu Güncelle </button>
            </div>
            </form>
        </div>
    </div>
</x-app-layout>