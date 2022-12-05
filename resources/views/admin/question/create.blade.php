<x-app-layout>
    <div class="card container mt-3">
        <div class="card-body">
            <form method="POST" action="{{route('questions.store')}} " enctype="multipart/form-data">
                @csrf
                <div class="form-group mt-2">
                    <strong><label>Soru:</label></strong>
                    <textarea name="question" class="form-control" rows=4">{{ old('question') }}</textarea>
                
                <div class="row mt-2">
                <div class="col-md-6 form-group mt-1">
                    <strong><label>Fotoğraf:</label></strong>
                    <input type="file" name="image" class="form-control">
                </div>
                <div class='col-md-6 form-group'>
                <strong><label>Quiz Seç:</label></strong> <br>
                    <select name="quiz_id">
                        <option>...</option>
                        @foreach($quizzes as $quiz)
                            <option value="{{$quiz->id}}">{{$quiz->id}}-{{$quiz->title}}</option>
                        @endforeach
                    </select>
                </div>
                </div>

                <div class="row mt-2">
                    <div class="col-md-6">
                        <div class="form-group">
                            <strong><label> 1. Cevap:</label></strong>
                            <textarea name="answer1" class="form-control" rows=2">{{ old('answer1') }}</textarea>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <strong><label> 2. Cevap:</label></strong>
                            <textarea name="answer2" class="form-control" rows=2">{{ old('answer2') }}</textarea>
                        </div>
                    </div>
                </div>

                <div class="row mt-2">
                    <div class="col-md-6">
                        <div class="form-group">
                            <strong><label> 3 Cevap:</label></strong>
                            <textarea name="answer3" class="form-control" rows=2">{{ old('answer3') }}</textarea>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <strong><label> 4. Cevap:</label></strong>
                            <textarea name="answer4" class="form-control" rows=2">{{ old('answer4') }}</textarea>
                        </div>
                    </div>
                </div>

                <div class="form-group mt-2">
                    <strong><label>Doğru Cevap:</label></strong>
                    <select name="correct_answer" class="form-control">
                        <option @if(old('correct_answer')==='answer1' ) selected @endif value="answer1">1. Cevap
                        </option>
                        <option @if(old('correct_answer')==='answer2' ) selected @endif value="answer4">2. Cevap
                        </option>
                        <option @if(old('correct_answer')==='answer3' ) selected @endif value="answer3">3. Cevap
                        </option>
                        <option @if(old('correct_answer')==='answer4' ) selected @endif value="answer2">4. Cevap
                        </option>

                    </select>
                </div>

                <div class="form-group mt-3">
                    <button type="submit" class="btn btn-success btn-sm w-100">Soru Oluştur</button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>