<x-app-layout>
    <x-slot name="header">
        <h4> Sorular</h4>
    </x-slot>
    <div class="card container mt-3">
        <div class="card-body">
            <h5 class="card-title float-left">
                <a href="{{route('quizzes.index')}}" class="btn btn-outline-secondary mb-1"><i
                        class="fa fa-arrow-left mr-2"></i><strong>Sınavlara dön</strong></a>
            </h5>

            <h5 class=" float-right">
                <button type="button" class="btn btn-outline-primary mb-1" data-toggle="modal" data-target="#question">
                    <i class="fa fa-plus mr-1"></i><strong> Soru ekle </strong> </button>
            </h5>
            <table class="table table-bordered mt-3">
                <thead>
                    <tr>
                        <th scope="col">Soru Adı</th>
                        <th scope="col" style="text-align: center">Doğru cevap</th>
                        <th scope="col" style="text-align: center">İşlemler</th>
                        <th scope="col" style="text-align: center">Sil</th>
                    </tr>
                    @foreach( $questions as $question)
                    <tr>
                        <td> {{$question->question}}</td>
                        <td class="text-success" style="text-align: center">
                            {{substr($question->correct_answer,-1)}}. Cevap</td>

                        <!-- Edit modal -->
                        <td style="text-align: center">
                            <button type="button" class="btn btn-sm btn-primary text-align: center" data-toggle="modal"
                                data-target="#edit"> <i class="fa fa-edit"></i></button>
                        </td>

                        <div class="modal fade" id="edit" tabindex="-1" role="dialog"
                            aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">
                                            <strong>{{$question->question}}</strong>
                                        </h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>

                                    <div class="modal-body">
                                        <div class="card-body">
                                            <form method="POST"
                                                action="{{route('questions.update',[$question->quiz_id,$question->id])}} "
                                                enctype="multipart/form-data">

                                                @csrf
                                                @method('PUT')
                                                <div class="form-group mt-2">
                                                    <strong> <label> Soru:</label> </strong>
                                                    <textarea name="question" class="form-control"
                                                        rows=4">{{ $question->question }}</textarea>
                                                </div>

                                                <div class="form-group mt-2">
                                                    <strong> <label>Fotoğraf:</label></strong>
                                                    @if($question->image)
                                                    <a href="{{ asset($question->image) }}" target="_blank">
                                                        <img src="{{asset($question->image)}}" class"img-responsive"
                                                            style="width: 200px">
                                                    </a>
                                                    @endif
                                                    <input type="file" name="image" class="form-control">
                                                </div>

                                                <div class="row mt-2">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <strong> <label> 1. Cevap:</label></strong>
                                                            <textarea name="answer1" class="form-control"
                                                                rows=2">{{ $question->answer1 }}</textarea>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <strong> <label> 2. Cevap:</label></strong>
                                                            <textarea name="answer2" class="form-control"
                                                                rows=2">{{ $question->answer2 }}</textarea>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="row mt-2">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <strong> <label> 3 Cevap:</label></strong>
                                                            <textarea name="answer3" class="form-control"
                                                                rows=2">{{ $question->answer3 }}</textarea>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <strong> <label> 4. Cevap:</label></strong>
                                                            <textarea name="answer4" class="form-control"
                                                                rows=2">{{ $question->answer4 }}</textarea>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="form-group mt-2">
                                                    <strong> <label>Doğru Cevap:</label></strong>
                                                    <select name="correct_answer" class="form-control">
                                                        <option @if($question->correct_answer==='answer1') selected
                                                            @endif
                                                            value="answer1">1. Cevap
                                                        </option>
                                                        <option @if($question->correct_answer==='answer2') selected
                                                            @endif
                                                            value="answer2">2. Cevap
                                                        </option>
                                                        <option @if($question->correct_answer==='answer3') selected
                                                            @endif
                                                            value="answer3">3. Cevap
                                                        </option>
                                                        <option @if($question->correct_answer==='answer4') selected
                                                            @endif
                                                            value="answer4">4. Cevap
                                                        </option>
                                                    </select>
                                                </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-danger" data-dismiss="modal">Kapat</button>
                                        <button type="submit" class="btn btn-success"> Soruyu güncelle <i
                                                class="fa-solid fa-circle-check ml-1"></i></button>
                                    </div>
                                    </form>
                                </div>
                            </div>
                            <!-- --- -->
                            <td style=" text-align: center">
                                <form method="POST" action="{{route('questions.destroy',[$question->id])}}">
                                    @method('DELETE')
                                    @csrf
                                    <button type="submit" class="btn btn-sm btn-danger"><i
                                            class="fa fa-times"></i></button>
                                </form>
                            </td>
                    </tr>
                    @endforeach
                </thead>
            </table>

            <!-- Soru oluştur -->
            @foreach ($questions as $question)
            <tr>
                <td style="text-align: center">
                    <div class="modal fade" id="question" tabindex="-1" role="dialog"
                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content bs-modal-width: 100%;">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">
                                        <strong>{{$question->question}}</strong>
                                    </h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                </td>
        </div>
        <div class="modal-body">
            <div class="card-body">
                <form method="POST" action="{{route('questions.store')}} " enctype="multipart/form-data">
                    @csrf
                    <div class="form-group row-cols-md-1">
                        <strong><label>Soru:</label></strong>
                        <textarea name="question" class="form-control" rows=4">{{ old('question') }}</textarea>

                        <div class="row mt-2">
                            <div class="col-md-6 form-group mt-1">
                                <strong><label>Fotoğraf:</label></strong>
                                <input type="file" name="image" class="form-control">
                            </div>
                        </div>

                        <div class=" row mt-3 col-md-auto">
                            <div class="col-md-6 ">
                                <div class="form-group">
                                    <strong><label> 1. Cevap:</label></strong>
                                    <textarea name="answer1" class="form-control"
                                        rows=2">{{ old('answer1') }}</textarea>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <strong><label> 2. Cevap:</label></strong>
                                    <textarea name="answer2" class="form-control"
                                        rows=2">{{ old('answer2') }}</textarea>
                                </div>
                            </div>
                        </div>

                        <div class="row mt-2 col-md-auto">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <strong><label> 3 Cevap:</label></strong>
                                    <textarea name="answer3" class="form-control"
                                        rows=2">{{ old('answer3') }}</textarea>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <strong><label> 4. Cevap:</label></strong>
                                    <textarea name="answer4" class="form-control"
                                        rows=2">{{ old('answer4') }}</textarea>
                                </div>
                            </div>
                        </div>

                        <div class="form-group mt-2">
                            <strong><label>Doğru Cevap:</label></strong>
                            <select name="correct_answer" class="form-control">
                                <option @if(old('correct_answer')==='answer1' ) selected @endif value="answer1">1. Cevap
                                </option>
                                <option @if(old('correct_answer')==='answer2' ) selected @endif value="answer4">2. Cevap
                                </option>
                                <option @if(old('correct_answer')==='answer3' ) selected @endif value="answer3">3. Cevap
                                </option>
                                <option @if(old('correct_answer')==='answer4' ) selected @endif value="answer2">4. Cevap
                                </option>
                            </select>
                        </div>
                        <div class="mt-3">
                            <strong><label>Sınav Seç:</label></strong> <br>
                            <select name="quiz_id" class="w-100">
                                <option>...</option>
                                @foreach($quizzes as $quiz)
                                <option value="{{$quiz->id}}">{{$quiz->id}}-{{$quiz->title}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
            </div>
        </div>

        <div class="modal-footer">
            <button type="button" class="btn btn-danger" data-dismiss="modal">Kapat </button>
            <button type="submit" class="btn btn-success"> Soruyu oluştur <i
                    class="fa-solid fa-circle-check ml-1"></i></button>
        </div>
    </div>
    </form>
    @endforeach
    <!-- --- -->
</x-app-layout>