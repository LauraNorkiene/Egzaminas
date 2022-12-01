@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Knygos</div>

                    <div class="card-body">
                        <a href="{{ route('book.create') }}" class="btn btn-success">Pridėti naują</a>

                        <table class="table">
                            <thead>
                            <tr>
                                <th>Nuotrauka</th>
                                <th>Pavadinimas</th>
                                <th>Santrauka</th>
                                <th>ISBN kodas</th>

                                <th>Puslapių skaičius</th>
                                <th>Kategorija</th>

                                <th colspan="2">Veiksmai</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($books as $book)
                                <tr>
                                    <td><img src="{{ route('images',$book->img)}}" style=" width: 200px; height: 250px;"></td>
                                    <td>{{ $book->name }}</td>
                                    <td>{{ $book->summary }}</td>
                                    <td>{{ $book->ISBN }}</td>

                                    <td>{{ $book->page_number }}</td>
                                    <td>{{ $book->category->name }}</td>

                                    <td>
                                        <a href="{{ route('book.edit', $book->id) }}" class="btn btn-success">Redaguoti</a>


                                    </td>
                                    <td>
                                        <form method="post" action="{{ route('book.destroy', $book->id) }}">
                                            @csrf
                                            @method('delete')
                                            <button  class="btn btn-danger">Ištrinti</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
