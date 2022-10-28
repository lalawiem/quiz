
<x-app-layout>
    <x-slot name="header"> Quizler</x-slot>
    <link rel="stylesheet" href="app.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">

    
    <div class="card">
        <div class="card-body">
              <h5 class="card-title">
              <a href="{{route('quizzes.create')}}" class="btn btn-sm btn-primary"><i class="fa fa-plus"></i>Quiz Oluştur</a>
              </h5>
              <table class="table table-bordered">
  <thead>
    <tr>
      <th scope="col">Quiz</th>
      <th scope="col">Durum</th>
      <th scope="col">Bitiş Tarihi</th>
      <th scope="col">İşlemler</th>
    </tr>
  </thead>
  <tbody>
    @foreach($quizzes as $quiz)
    <tr>
      <th> {{ $quiz->title }}</th>
      <td>{{ $quiz->status }}</td>
      <td>{{ $quiz->finished_at }}</td>
      <td>
        <a href="#" class="btn btn-sm btn-primary"><i class="fa fa-edit"></i></a>
        <a href="#" class="btn btn-sm btn-danger"><i class="fa fa-times"></i></a>
        </td>
    </tr>
    @endforeach
  </tbody>
</table>
{{$quizzes->links()}}
              </div>
              </div>
</x-app-layout>
