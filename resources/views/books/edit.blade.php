@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Knyga</div>

                    <div class="card-body">

                        <form method="POST" action="{{ isset($book)?route('book.update',$book->id):route('book.store') }}" enctype="multipart/form-data">
                            @csrf

                            @if (isset($book))
                                @method('put')
                            @endif

                            <div class="mb-3">
                                <label class="form-label">Nuotrauka</label>
                                <input type="file" class="form-control" name="img">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Pavadinimas</label>
                                <input type="text" name="name" class="form-control" value="{{ isset($book)?$book->name:'' }}">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Santrauka</label>
                                <input type="text" name="summary" class="form-control"  value="{{ isset($book)?$book->summary:'' }}">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">ISBN kodas</label>
                                <input type="text" name="ISBN" class="form-control"  value="{{ isset($book)?$book->ISBN:'' }}">
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Puslapių skaičius</label>
                                <input type="text" name="page_number" class="form-control"  value="{{ isset($book)?$book->page_number:'' }}">
                            </div>
                            <div class="mb-3">
                                <select name="category_id" class="form-select">
                                    @foreach($categories as $category)
                                        <option  value="{{$category->id}}" {{ isset($book)&&($category->id==$book->category_id)?'selected':'' }}> {{ $category->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <button type="submit" class="btn btn-success">{{ isset($book)?'Išsaugoti':'Pridėti' }}</button>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
