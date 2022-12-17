<x-app-layout>
    @include('sweetalert::alert')
    <x-slot name="header">
        <h4> Sınavlar</h4>
    </x-slot>


    <div class="card container mt-2">
        <div class="card-body">
            <div class=" float-right">
            <h5 class=" float-right mt-2">
                <button type="button" class="btn btn-outline-primary" data-toggle="modal" data-target="#quiz">
                    <i class="fa fa-plus mr-1"></i><strong> Sınav ekle </strong> </button>
            </h5>
            
            <h5 class="float-right mt-2">
                <a href="{{route('dashboard')}}" class="btn btn-outline-secondary mr-1"><i
                        class="fa fa-arrow-left mr-1"></i><strong> Geriye dön </strong></a>
            </h5>
            </div>

            
            
            <!-- Duyuru oluştur MODAL -->
            @foreach ($quizzes as $quiz)
            <tr>
                <td style="text-align: center">
                    <div class="modal fade" id="quiz" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                        aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">
                                        <strong>{{$quiz->title}}</strong>
                                    </h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <div class="card-body">
                                        <form method="POST" action="{{route('quizzes.store')}}">
                                            @csrf
                                            <div class="form-group mt-2">
                                                <strong><label>Sınav Başlığı:</label></strong>
                                                <input type="text" name="title" class="form-control"
                                                    value="{{ old('title') }}">
                                            </div>

                                            <div class="form-group mt-2">
                                                <strong><label>Sınav Açıklaması:</label></strong>
                                                <textarea name="description" class="form-control"
                                                    rows=4">{{ old('description') }}</textarea>
                                            </div>

                                            <div class="form-group mt-3">
                                                <input id="isFinished" @if(old('finished_at')) checked @endif
                                                    type="checkbox">
                                                <strong><label>Bitiş Tarihi Olacak mı? </label></strong>
                                            </div>

                                            <div id="finishedInput" @if(!old('finished_at')) style="display: none;"
                                                @endif class="form-group mt-3">
                                                <strong><label>Bitiş Tarihi: </label></strong>
                                                <input type="datetime-local" name="finished_at" class="form-control"
                                                    value="{{old('finished_at')}}">
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
                                </div>

                                <div class="modal-footer">
                                    <button type="button" class="btn btn-danger" data-dismiss="modal">Kapat </button>
                                    <button type="submit" class="btn btn-success"> Sınavı oluştur <i
                                            class="fa-solid fa-circle-check ml-1"></i></button>
                                </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    @endforeach
                    <!-- --- -->

                    <form method="GET" action="">
                        <div class="row">
                            <div class="col-md-2 mt-1">
                                <input type="text" name="title" value="{{request()->get('title')}}"
                                    placeholder="Sınav Adı" class="form-control"> </input>
                            </div>
                            @if(request()->get('title') || request()->get('status'))
                            <div class="col-md-2 mt-1">
                                <a href="{{route('quizzes.index')}}" class="btn btn-secondary">Sıfırla</a>
                            </div>
                            @endif
                        </div>
                        <div class="row">

                            <div class="col-md-2 mt-1">
                                <select class="form-control" onchange="this.form.submit()" name="status">
                                    <option value="">Durum Seç </option>
                                    <option @if(request()->get('status')=='publish') selected @endif
                                        value="publish">Aktif
                                    </option>
                                    <option @if(request()->get('status')=='passive') selected @endif
                                        value="passive">Pasif
                                    </option>
                                    <option @if(request()->get('status')=='draft') selected @endif value="draft">Taslak
                                    </option>
                                </select>
                            </div>
                        </div>
                    </form>
                    <table class="table table-bordered mt-3">
                        <thead>
                            <tr>
                                <th>Sınav Adı</th>
                                <th style="text-align: center" scope="col">Durum</th>
                                <th style="text-align: center" scope="col">İşlemler</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($quizzes as $quiz)
                            <tr>
                                <td><strong> {{ $quiz->title }}</strong></td>
                                <td style="text-align: center">
                                    @switch($quiz->status)
                                    @case('publish')
                                    @if(!$quiz->finished_at)
                                    <span class="badge bg-success">AKTİF</span>
                                    @elseif($quiz->finished_at>now())
                                    <span class="badge bg-success">AKTİF</span>
                                    @else
                                    <span class="badge bg-secondary">Süresi Doldu</span>
                                    @endif
                                    @break

                                    @case('passive')
                                    <span class="badge bg-danger">Pasif</span>
                                    @break

                                    @case('draft')
                                    <span class="badge bg-warning text-black">Taslak</span>
                                    @break
                                    @endswitch
                                </td>


                                <td style="text-align: center">
                                    <div class="dropdown">
                                        <a class="btn btn-primary dropdown-toggle mb-1" href="#" role="button"
                                            id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true"
                                            aria-expanded="false">İşlemler
                                        </a>

                                        <form method="POST" action="{{route('quizzes.destroy',[$quiz->id])}}">
                                            @method('DELETE')
                                            @csrf
                                            <button type="submit" class="btn btn-danger">Sınavı sil</button>
                                        </form>

                                        <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                            <a class="dropdown-item"
                                                href="{{route('quizzes.show',$quiz->id)}}">Bilgi</a>
                                            <a class="dropdown-item" href="{{route('quizzes.soruGor', $quiz->id)}}">
                                                Sorular</a>
                                            <a class="dropdown-item" href="{{route('quizzes.edit', $quiz->id)}}">Düzenle
                                            </a>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    {{$quizzes->withQueryString()->links()}}
        </div>
    </div>
</x-app-layout>