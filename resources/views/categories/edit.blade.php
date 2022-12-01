@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Kategorijos</div>

                    <div class="card-body">

                        <form method="POST" action="{{ isset($category)?route('category.update',$category->id):route('category.store') }}">
                            @csrf

                            @if (isset($category))
                                @method('put')
                            @endif

                            <div class="mb-3">
                                <label class="form-label">Pavadinimas</label>
                                <input type="text" name="name" class="form-control" value="{{ isset($category)?$category->name:'' }}">
                            </div>

                            <button type="submit" class="btn btn-success">{{ isset($category)?'Išsaugoti':'Pridėti' }}</button>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
