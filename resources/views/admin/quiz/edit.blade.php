<x-app-layout>

    <x-slot name="header"><h4>Quiz'i Düzenle</h4> </x-slot>
    <div class="card container mt-3">
        <div class="card-body ">
            <form method="POST" action="{{route('quizzes.update',$quiz->id)}}">
                @csrf
                @method('PUT')
                <div class="form-group mt-1 mb-2">
                    <strong><label>Quiz Başlığı:</label></strong>
                    <input type="text" name="title" class="form-control mt-1 " value="{{$quiz->title}}">
                </div>
                <div class="form-group mt-2">
                    <strong><label>Quiz Açıklaması:</label></strong>
                    <textarea name="description" class="form-control mt-1 " rows=4"> {{$quiz->description}}</textarea>
                </div>
                <div class="form-group mt-2">
                    <strong><label>Quiz Durumu:</label></strong>
                    <select name="status" class="form-control mt-1 ">
                        <option @if($quiz->questions_count<4) disabled @endif
                        @if($quiz->status==='publish') selected @endif value="publish">Aktif
                        </option>
                        <option @if($quiz->status==='passive') selected @endif value="passive">Pasif</option>
                        <option @if($quiz->status==='draft') selected @endif value="draft">Taslak</option>

                    </select>
                </div>
                <div class="form-group mt-3">
                    <input id="isFinished" @if($quiz->finished_at) checked @endif type="checkbox">
                    <strong><label>Bitiş Tarihi Olacak mı? </label></strong>
                </div>

                <div id="finishedInput" @if(!$quiz->finished_at) style="display: none;" @endif class="form-group mt-2">
                    <strong><label>Bitiş Tarihi: </label></strong>
                    <input type="datetime-local" name="finished_at" value="{{ $quiz->finished_at}}"
                        class="form-control mt-2">
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