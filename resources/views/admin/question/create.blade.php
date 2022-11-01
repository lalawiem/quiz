<x-app-layout>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css"
        integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous">
    </script>

    <x-slot name="header">{{$quiz->title}} için yeni soru oluştur</x-slot>




    <div class="card">
        <div class="card-body">
            <form method="POST" action="{{route('quizzes.store')}}">
                @csrf
                <div class="form-group">
                    <label>Quiz Başlığı</label>
                    <input type="text" name="title" class="form-control" value="{{ old('title') }}">
                </div>

                <div class="form-group">
                    <label>Quiz Açıklama</label>
                    <textarea name="description" class="form-control" rows=4">{{ old('description') }}</textarea>
                </div>

                <div class="form-group">
                    <input id="isFinished" @if(old('finished_at')) checked @endif type="checkbox">
                    <label>Bitiş Tarihi Olacak mı? </label>
                </div>

                <div id="finishedInput" @if(old('finished_at')) style="display:none" @endif class="form-group">
                    <label>Bitiş Tarihi </label>
                    <input type="datetime-local" name="finished_at" value="{{ old('finished_at') }}"
                        class="form-control">
                </div>

                <div class="form-group">
                    <button type="submit" class="btn btn-success btn-sm btn-block">Quiz Oluştur</button>
                </div>
            </form>
        </div>
    </div>
    <x-slot name="js">
        <script>
        $('#isFinished').change(function() {
            if ($('#isFinished').is(':checked')) {
                $('#finishedInput').show();
            } else {
                $('#finishedInput').hide();
            }
        })
        </script>
    </x-slot>




</x-app-layout>