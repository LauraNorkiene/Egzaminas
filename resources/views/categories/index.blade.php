@extends('layouts.app')

@section('content')
    <div class="container mt-3">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header fs-2 fw-bold">Kategorijos</div>

                    <div class="card-body">
                        @can('admin')
                        <a href="{{ route('category.create') }}" class="btn btn-primary float-end">Pridėti naują</a>
                        @endcan
                        <table class="table">
                            <thead>
                            <tr>
                                <th class="fw-bold">Pavadinimas</th>

                                <th></th>
                                <th colspan="2" class="fw-bold">Veiksmai</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($categories as $category)
                                <tr>
                                    <td>{{ $category->name }}</td>

                                    <td>
                                        <a href="{{ route('categoryBooks',$category->id) }}" class="btn btn-success">Knygos</a>
                                    </td>
                                    <td>
                                        @can('admin')
                                        <a href="{{ route('category.edit', $category->id) }}" class="btn btn-primary"><i class="fa-solid fa-pencil"></i></a>
                                        @endcan
                                    </td>
                                    <td>
                                        @can('admin')
                                        <form method="post" action="{{ route('category.destroy', $category->id) }}">
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
