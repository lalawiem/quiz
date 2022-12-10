<x-app-layout>
<x-slot name="header"> <h4> Sorular</h4></x-slot>
    <div class="card container mt-3">
        <div class="card-body">
            <h5 class="card-title float-right">
                <a href="{{route('questions.create')}}" class="btn btn-sm btn-primary "><i
                        class="fa fa-plus"></i> Soru Oluştur</a>
            </h5>

            <h5 class="card-title">
                <a href="{{route('quizzes.index')}}" class="btn btn-sm btn-secondary"><i
                        class="fa fa-arrow-left"></i> Quizlere Dön</a>
            </h5>
            <table class="table table-bordered mt-3">   
                <thead>
                    <tr>
                        <th scope="col">Soru</th>
                        <th scope="col">Fotoğraf</th>
                        <th scope="col">Cevap</th>
                        <th scope="col" style="text-align: center">İşlemler</th>
                        <th scope="col" style="text-align: center">Sil</th>
                    </tr>
                    @foreach( $questions as $question)
                    <tr>
                        <td> {{$question->question}}</td>
                        <td>{{$question->image}}</td>

                        <td class="text-success">{{substr($question->correct_answer,-1)}}. Cevap</td>
                        <td style="text-align: center"> <a href="{{route('questions.edit', $question->id)}}" class="btn btn-sm btn-primary"> <i class="fa fa-edit"></i></a> </td>
                        <td style="text-align: center">        
                                <form method="POST" action="{{route('questions.destroy',[$question->id])}}">
                                @method('DELETE')
                                @csrf
                                <button type="submit" class="btn btn-sm btn-danger"><i class="fa fa-times"></i></button>
                                </form>
                        </td>
                    </tr>
                    @endforeach
                </thead>
            </table>
        </div>
    </div>
</x-app-layout>