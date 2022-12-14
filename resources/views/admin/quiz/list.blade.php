<x-app-layout>
    <x-slot name="header">
        <h4> Quizler</h4>
    </x-slot>
    <div class="card container mt-3">
        <div class="card-body">
            <h5 class=" float-right mt-2">
                <button type="button" class="btn btn-outline-primary mb-1 " data-toggle="modal" data-target="#quiz">
                    <i class="fa fa-plus mr-1"></i><strong> Quiz ekle </strong> </button>
            </h5>
            <h5 class="card-title float-right mt-2 mr-1">
                <a href="{{route('dashboard')}}" class="btn btn-outline-secondary mr-1"><i
                        class="fa fa-arrow-left mr-1"></i><strong> Anasayfaya Dön </strong></a>
            </h5>
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
                                                <strong><label>Quiz Başlığı:</label></strong>
                                                <input type="text" name="title" class="form-control"
                                                    value="{{ old('title') }}">
                                            </div>

                                            <div class="form-group mt-2">
                                                <strong><label>Quiz Açıklaması:</label></strong>
                                                <textarea name="description" class="form-control"
                                                    rows=4">{{ old('description') }}</textarea>
                                            </div>

                                            <div class="form-group mt-3">
                                                <input id="isFinished" @if(old('finished_at')) checked @endif
                                                    type="checkbox">
                                                <strong><label>Bitiş Tarihi Olacak mı? </label></strong>
                                            </div>

                                            <div id="finishedInput" @if(!old('finished_at')) style="display: none;"
                                                @endif class="form-group mt-2">
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
                                    <button type="submit" class="btn btn-success"> Oluştur <i
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
                                    placeholder="Quiz Adı" class="form-control"> </input>
                            </div>
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
                            @if(request()->get('title') || request()->get('status'))
                            <div class="col-md-2 mt-1">
                                <a href="{{route('quizzes.index')}}" class="btn btn-secondary">Sıfırla</a>
                            </div>
                            @endif
                        </div>
                    </form>
                    <table class="table table-bordered mt-3">
                        <thead>
                            <tr>
                                <th>Quiz Adı</th>
                                <th style="text-align: center" scope="col">Soru Sayısı</th>
                                <th style="text-align: center" scope="col">Durum</th>
                                <th style="text-align: center" scope="col">Bitiş Tarihi</th>
                                <th style="text-align: center" scope="col">İşlemler</th>
                                <th style="text-align: center" scope="col">Sil</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($quizzes as $quiz)
                            <tr>
                                <td> {{ $quiz->title }}</td>
                                <td style="text-align: center">{{ $quiz->questions_count }}</td>
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
                                    {{$quiz->finished_at ? $quiz->finished_at->diffForHumans() : '-' }}</td>

                                <td style="text-align: center">
                                    <div class="dropdown">
                                        <a class="btn btn-primary dropdown-toggle" href="#" role="button"
                                            id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true"
                                            aria-expanded="false">İşlemler
                                        </a>
                                        <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                            <a class="dropdown-item"
                                                href="{{route('quizzes.show',$quiz->id)}}">Bilgi</a>
                                            <a class="dropdown-item" href="{{route('quizzes.soruGor', $quiz->id)}}">
                                                Sorular</a>
                                            <a class="dropdown-item" href="{{route('quizzes.edit', $quiz->id)}}">Düzenle
                                            </a>
                                        </div>
                                    </div>

                                <td style="text-align: center">
                                    <form method="POST" action="{{route('quizzes.destroy',[$quiz->id])}}">
                                        @method('DELETE')
                                        @csrf
                                        <button type="submit" class="btn btn-sm btn-danger"><i
                                                class="fa fa-times mt-1"></i></button>
                                    </form>
                                </td>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            {{$quizzes->withQueryString()->links()}}
        </div>
    </div>
</x-app-layout>