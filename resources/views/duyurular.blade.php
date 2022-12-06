<x-app-layout>
    <x-slot name="header"><h4> Duyurular</h4></x-slot>
    <div class="card container mt-3">
        <div class="card-body">
            <h5 class="card-title float-right">
                <a href="{{route('dashboard')}}" class="btn btn-sm btn-secondary mt-3"><i class="fa fa-arrow-left"></i>Anasayfaya Dön</a>
                @if (Auth()->user()->type=='admin')


                <a href="{{route('duyurular.create')}}" class="btn btn-sm btn-primary mt-3"><i class="fa fa-plus"></i>Duyuru Ekle</a>
                @endif
            </h5>
        </div>

        <table class="table table-bordered">
            <thead>
                <tr>
                    <th scope="col">Duyurular</th>
                </tr>
                <tr>
                </tr>
            </thead>
        </table>
    </div>
    </div>
</x-app-layout>