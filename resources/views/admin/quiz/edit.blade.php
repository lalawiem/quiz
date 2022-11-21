<x-app-layout>

    <x-slot name="header">Quiz Güncelle </x-slot>
    <div class="card container mt-3">
        <div class="card-body ">
            <form method="POST" action="{{route('quizzes.update',$quiz->id)}}">
                @csrf
                @method('PUT')
                <div class="form-group mt-2 ">
                    <label>Quiz Başlığı</label>
                    <input type="text" name="title" class="form-control " value="{{$quiz->title}}">
                </div>
                <div class="form-group mt-2">
                    <label>Quiz Açıklama</label>
                    <textarea name="description" class="form-control " rows=4"> {{$quiz->description}}</textarea>
                </div>
                <div class="form-group mt-2">
                    <label>Quiz Durumu</label>
                    <select name="status" class="form-control ">
                        <option @if($quiz->questions_count<4) disabled @endif @if($quiz->status==='publish') selected
                                @endif value="publish">
                                Aktif
                        </option>
                        <option @if($quiz->status==='passive') selected @endif value="passive">Pasif</option>
                        <option @if($quiz->status==='draft') selected @endif value="draft">Taslak</option>

                    </select>
                </div>
                <div class="form-group mt-2">
                    <input id="isFinished" @if($quiz->finished_at) checked @endif type="checkbox">
                    <label>Bitiş Tarihi Olacak mı? </label>
                </div>

                <div id="finishedInput" @if(!$quiz->finished_at) style="display: none;" @endif class="form-group mt-2">
                    <label>Bitiş Tarihi </label>
                    <input type="datetime-local" name="finished_at" value="{{ $quiz->finished_at}}"
                        class="form-control">
                </div>

                <div class="form-group mt-3">
                    <button type="submit" class="btn btn-success btn-sm w-100">Quiz güncelle</button>
                </div>
            </form>
        </div>
    </div>
    <x-slot name="js">
        <script>
        $('#isFinished').change(function()  
        {
            if($('#isFinished').is(':checked')) 
            {
                $('#finishedInput').show();
            }else {
                $('#finishedInput').hide();
            }
        })
        </script>



    </x-slot>
</x-app-layout>