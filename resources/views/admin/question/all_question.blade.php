<x-app-layout>
    <x-slot name="header">Tüm Sorular</x-slot>

    <div class="card container mt-3">
        <div class="card-body">

            <h5 class="card-title float-right">
            </h5>

            <h5 class="card-title">
                <a href="{{route('quizzes.index')}}" class="btn btn-sm btn-secondary"><i class="fa fa-arrow-left"></i>
                    Quizlere Dön</a>
            </h5>

            <h5 class="card-title float-right">
                <a href="{{route('questions.create')}}" class="btn btn-sm btn-primary "><i class="fa fa-plus"></i> Soru
                    Oluştur</a>
            </h5>

            <table class="table table-bordered mt-3">
                <thead>
                    <tr>
                        <th scope="col">Soru:</th>
                        <th scope="col">Quiz:</th>
                        <th scope="col">Fotoğraf:</th>
                        <th scope="col">1. Cevap:</th>
                        <th scope="col">2. Cevap: </th>
                        <th scope="col">3. Cevap:</th>
                        <th scope="col">4. Cevap:</th>
                        <th scope="col">Doğru Cevap:</th>
                    </tr>
                    @foreach($questions as $soru)
                    <tr>
                        <td>{{$soru->question}}</td>
                        <td></td>
                        <td>{{$soru->image}}</td>
                        <td>{{$soru->answer1}}</td>
                        <td>{{$soru->answer2}}</td>
                        <td>{{$soru->answer3}}</td>
                        <td>{{$soru->answer4}}</td>
                        <td class="text-success">{{substr($soru->correct_answer,-1)}}. Cevap</td>
                    </tr>
                    @endforeach

               
                </thead>
            </table>
        </div>
    </div>
</x-app-layout>