<x-app-layout>
<x-slot name="header"><h4>Yeni duyuru oluştur</h4> </x-slot>

<div class="card container mt-3">
    <div class="card-body">
        <form method="POST" action="{{route('duyurular.store')}}">  
        @csrf
            <div class="form-group mt-2">
            <strong><label>Duyuru Başlığı:</label></strong>
                <input type="text" name="title" class="form-control" value="{{ old('title') }}">
            </div>

            <div class="form-group mt-2">
                <strong><label> Duyuru:</label></strong>
                <textarea name="description" class="form-control" rows=3">{{ old('description') }}</textarea>
            </div>

            <div class="form-group mt-2">
                <input id="isFinished" @if(old('finished_at')) checked @endif type="checkbox">
                <strong><label>Bitiş Tarihi Olacak mı? </label></strong>
            </div>

            <div id="finishedInput" @if(!old('finished_at')) style="display: none;" @endif class="form-group mt-2">
                <strong><label>Bitiş Tarihi: </label></strong>
                <input type="datetime-local" name="finished_at" class="form-control" value="{{old('finished_at')}}">
            </div>

            <div class="form-group mt-3">
                <button type="submit" class="btn btn-success btn-sm w-100">Duyuruyu Oluştur</button>
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