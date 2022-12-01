<x-app-layout>
    <x-slot name="header">Quizler</x-slot>



    <div class="card container mt-1">
        <div class="card-body">
            <h5 class="card-title float-right">
                <a href="{{route('quizzes.create')}}" class="btn btn-sm btn-primary mt-4"><i class="fa fa-plus"></i>Quiz
                    Oluştur</a>
            </h5>

            <form method="GET" action="">
                <div class="row">
                    <div class="col-md-2 mt-3">
                        <input type="text" name="title" value="{{request()->get('title')}}" placeholder="Quiz Adı"
                            class="form-control"> </input>
                    </div>
                    <div class="col-md-2 mt-3">
                        <select class="form-control" onchange="this.form.submit()" name="status">
                            <option value="">Durum Seçiniz </option>
                            <option @if(request()->get('status')=='publish') selected @endif value="publish">Aktif
                            </option>
                            <option @if(request()->get('status')=='passive') selected @endif value="passive">Pasif
                            </option>
                            <option @if(request()->get('status')=='draft') selected @endif value="draft">Taslak</option>
                        </select>
                    </div>
                    @if(request()->get('title') || request()->get('status'))
                    <div class="col-md-2 mt-3">
                        <a href="{{route('quizzes.index')}}" class="btn btn-secondary">Sıfırla</a>
                    </div>
                    @endif
                </div>
            </form>
            <table class="table table-bordered mt-2">
                <thead>
                    <tr>
                        <th>Quiz</th>
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
                            <a href="{{route('quizzes.show',$quiz->id)}}" class="btn btn-sm btn-secondary">
                                <i class="fa fa-info-circle"></i></a>
                            <a href="{{route('quizzes.soruGor', $quiz->id)}}" class="btn btn-sm btn-warning">
                                <i class="fa fa-question"></i></a>
                            <a href="{{route('quizzes.edit', $quiz->id)}}" class="btn btn-sm btn-primary">
                                <i class="fa fa-edit"></i></a>
                                <td style="text-align: center">
                                <form method="POST" action="{{route('quizzes.destroy',[$quiz->id])}}" >
                                @method('DELETE')
                                @csrf
                                    <button type="submit" class="btn btn-sm btn-danger"><i class="fa fa-times"></i></button>
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