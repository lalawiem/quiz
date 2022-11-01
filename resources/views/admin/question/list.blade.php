<x-app-layout>
    <x-slot name="header">{{$quiz->title}} Quizine ait Sorular</x-slot>
    <link rel="stylesheet" href="app.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" >

    <div class="card">
        <div class="card-body">
            <h5 class="card-title">
                <a href="#" class="btn btn-sm btn-primary"><i
                        class="fa fa-plus"></i>Soru
                    Oluştur</a>
            </h5>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th scope="col">Soru</th>
                        <th scope="col">Fotoğraf</th>
                        <th scope="col">1. Cevap</th>
                        <th scope="col">2. Cevap </th>
                        <th scope="col">3. Cevap</th>
                        <th scope="col">4. Cevap</th>
                        <th scope="col">Doğru Cevap</th>
                        <th scope="col">İşlemler </th>
                    </tr>
                    @foreach( $quiz->questions as $question)
                    <tr>
                        <td> {{$question->question}}</td>
                        <td>{{$question->image}}</td>
                        <td>{{$question->answer1}}</td>
                        <td>{{$question->answer2}}</td>
                        <td>{{$question->answer3}}</td>
                        <td>{{$question->answer4}}</td>
                        <td>{{$question->correct_answer}}</td>
                        <td>


                        <a href="{{route('questions.index', $question->id)}}" class="btn btn-sm btn-warning"><i class="fa fa-question"></i></>
                            <a href="{{route('quizzes.edit', $question->id)}}" class="btn btn-sm btn-primary"><i class="fa fa-edit"></i></a>
                            <a href="{{route('quizzes.destroy', $question->id)}}" class="btn btn-sm btn-danger"><i class="fa fa-times"></i></a>

                        </td>
                    </tr>
                    @endforeach

                </thead>
                <tbody>

                </tbody>
            </table>
        </div>
    </div>
</x-app-layout>