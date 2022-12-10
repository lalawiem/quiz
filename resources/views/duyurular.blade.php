<x-app-layout>
    <x-slot name="header">
        <h4> Duyurular</h4>
    </x-slot>
    <div class="card container mt-3">
        <div class="card-body">
            <h5 class="card-title float-left">
                <a href="{{route('dashboard')}}" class="btn btn-sm btn-secondary mr-1"><i
                        class="fa fa-arrow-left mr-1"></i>Anasayfaya Dön</a>
                @if (Auth()->user()->type=='admin')
            </h5>
            <h5 class=" float-right">
                <a href="{{route('duyurular.create')}}" class="btn btn-sm btn-primary mr-1"><i
                        class="fa fa-plus mr-1"></i>Duyuru Ekle</a>
                @endif
            </h5>

        <table class="table table-bordered mt-5">
            <thead>
                <tr>
                    <th scope="col">Duyuru Adı</th>
                    <th> Tarih </th>
                    <th style="text-align: center"> Detay </th>
                    @if (Auth()->user()->type=='admin')
                    <th style="text-align: center"> İşlemler </th>
                    @endif
                </tr>
            </thead>
            <tbody>

                @foreach ($duyurular as $duyuru)
                <tr>
                    <td>{{$duyuru->title}}</td>
                    <td>{{$duyuru->created_at ? $duyuru->created_at->diffForHumans() : '-' }}</td>
                    <td style="text-align: center">
                        <button type="button" class="btn btn-success mb-1" data-toggle="modal"
                            data-target="#duyuru{{ $loop->index }}">
                            <i class="fa-solid fa-circle-info mr-1"></i>
                            Duyuruyu Oku </button>
                    </td>

                    @if (Auth()->user()->type=='admin')
                    <td style="text-align: center">
                        <form method="POST" class="mb-1" action="{{route('duyurular.destroy',[$duyuru->id])}}">
                            @method('DELETE')
                            @csrf
                            <button type="submit" class="btn btn-danger"><i
                                    class="fa-solid fa-circle-xmark mr-1"></i>Duyuruyu Sil</button>
                        </form>

                        <a href="{{route('duyurular.edit', $duyuru->id)}}" class="btn btn-primary"> <i
                                class="fa fa-edit mr-1"></i>Duyuruyu Düzenle</a>
                        @endif

                    </td>
                    <div class="modal fade" id="duyuru{{ $loop->index }}" tabindex="-1" role="dialog"
                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">
                                        <strong>{{$duyuru->title}}</strong>
                                    </h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    {{$duyuru->description}}
                                </div>
                                <div class="modal-body">
                                    <p class="card-title float-right">
                                        {{$duyuru->created_at ? $duyuru->created_at->diffForHumans() : '-' }}</p>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-primary" data-dismiss="modal">Okundu <i
                                            class="fa-solid fa-circle-check ml-1"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    </div>
</x-app-layout>