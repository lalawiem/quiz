<x-app-layout>

    <x-slot name="header"><h4>Duyuruyu Düzenle</h4> </x-slot>
    <div class="card container mt-3">
        <div class="card-body ">
            <form method="POST" action="{{route('duyurular.update',$duyuru->id)}}">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <strong><label>Duyuru Başlığı:</label></strong>
                    <input type="text" name="title" class="form-control " value="{{$duyuru->title}}">
                </div>
                <div class="form-group mt-2">
                    <strong><label>Duyuru Açıklaması:</label></strong>
                    <textarea name="description" class="form-control " rows=4"> "{{$duyuru->description}}</textarea>
                </div>
              
                <div class="form-group mt-3">
                    <button type="submit" class="btn btn-success btn-sm w-100">Güncelle</button>
                </div>
            </form>
        </div>
    </div>
  
</x-app-layout>