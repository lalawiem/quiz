

<x-app-layout>

    <x-slot name="header">Quiz Oluştur </x-slot>




    <div class="card container mt-3">
        <div class="card-body">
            <form method="POST" action="{{route('quizzes.store')}}">
                @csrf
                <div class="form-group mt-2">
                    <label>Quiz Başlığı</label>
                    <input type="text" name="title" class="form-control" value="{{ old('title') }}">
                </div>

                <div class="form-group mt-2">
                    <label>Quiz Açıklama</label>
                    <textarea name="description" class="form-control" rows=4">{{ old('description') }}</textarea>
                </div>
                

                <div class="form-group mt-2">
                    <input id="isFinished" @if(old('finished_at')) checked @endif type="checkbox">
                    <label>Bitiş Tarihi Olacak mı? </label>
                </div>

                <div id="finishedInput" @if(!old('finished_at')) style="display: none;" @endif class="form-group mt-2">
                    <label>Bitiş Tarihi </label>
                    <input type="datetime-local" name="finished_at" class="form-control" value="{{old('finished_at')}}">
                </div>

                <div class="form-group mt-3">
                    <button type="submit" class="btn btn-success btn-sm btn-block">Quiz Oluştur</button>
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