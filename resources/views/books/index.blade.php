@extends('layouts.app')

@section('content')
    <div class="container mt-3">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header fs-2 fw-bold">Knygos</div>

                    <div class="card-body">
                        @can('admin')
                        <a href="{{ route('book.create') }}" class="btn btn-primary float-end">Pridėti naują</a>
                        @endcan
                        <table class="table">
                            <thead>
                            <tr>
                                <th class="fw-bold">Nuotrauka</th>
                                <th class="fw-bold">Pavadinimas</th>
                                <th class="fw-bold">Santrauka</th>
                                <th class="fw-bold">ISBN kodas</th>

                                <th class="fw-bold">Puslapių skaičius</th>
                                <th class="fw-bold">Kategorija</th>

                                <th colspan="2" class="fw-bold">Veiksmai</th>
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

                                    <td><i class="fa fa-heart text-danger"> </i></td>

                                    <td>
                                        @can('admin')
                                        <a href="{{ route('book.edit', $book->id) }}" class="btn btn-primary">
                                            <i class="fa-solid fa-pencil"></i>
                                        </a>

                                        @endcan
                                    </td>
                                    <td>
                                        @can('admin')
                                        <form method="post" action="{{ route('book.destroy', $book->id) }}">
                                            @csrf
                                            @method('delete')
                                            <button  class="btn btn-danger"><i class="fa-solid fa-trash"></i></button>
                                        </form>
                                        @endcan
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
