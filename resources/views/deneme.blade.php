<x-app-layout>
    <x-slot name="header">
        <h4> Duyurular</h4>
    </x-slot>
    <div class="card container mt-3">
        <div class="card-body">
            <h5 class="card-title float-left mb-3">
                <a href="{{route('dashboard')}}" class="btn btn-outline-secondary"><i
                        class="fa fa-arrow-left mr-1 mt-1"></i><strong> Anasayfaya Dön </strong></a>
            </h5>

            <!-- Duyuru oluştur -->
            @if (Auth()->user()->type=='admin')
            <h5 class=" float-right mb-3">
                <button type="button" class="btn btn-outline-primary " data-toggle="modal"
                    data-target="#olustur">
                    <i class="fa fa-plus mr-1 mt-1"></i> <strong> Duyuru ekle </strong> </button>
            </h5>
</x-app-layout>