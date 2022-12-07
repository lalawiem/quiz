<x-app-layout>
    <x-slot name="header"><h4> Duyurular</h4></x-slot>
    <div class="card container mt-3">
        <div class="card-body">
            <h5 class="card-title float-right">
                <a href="{{route('dashboard')}}" class="btn btn-sm btn-secondary mr-1"><i class="fa fa-arrow-left mr-1"></i>Anasayfaya Dön</a>
                @if (Auth()->user()->type=='admin')


                <a href="{{route('duyurular.create')}}" class="btn btn-sm btn-primary mr-1"><i class="fa fa-plus mr-1"></i>Duyuru Ekle</a>
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