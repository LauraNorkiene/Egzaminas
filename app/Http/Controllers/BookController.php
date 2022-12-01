<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Category;
use Illuminate\Http\Request;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index(Request $request)
    {

        $categoryId=$request->session()->get('filter_category_id', null);
        $find=$request->session()->get('find_post',$request->search);
        $orderBy=$request->session()->get('order_by', 'name');
        $dir=$request->session()->get('order_direction', 'ASC');
        if($categoryId!=null){
            $books =  Book::where('category_id',$categoryId )->get();
        }else{
            $books=Book::filter($categoryId)->findPosts($find)->orderBy($orderBy,$dir)->get();
        }

        return view('books.index',['books'=>$books, 'categories'=>Category::all(), 'filter_category_id'=>$categoryId,'orderBy'=>$orderBy, 'orderDirection'=>$dir]);

//        return view('books.index',['books'=>Book::all()]);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function create()
    {
        return view('books.edit', ['categories'=>Category::all()]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $book = new Book();



        if($request->file('img')!=null) {
            $foto = $request->file('img');
            $fotoname = $request->id . '_' . rand() . '.' . $foto->extension();
            $foto->storeAs('images',$fotoname);
            $book->img=$fotoname;
        }
        $book->name=$request->name;
        $book->summary=$request->summary;
        $book->ISBN=$request->ISBN;
        $book->page_number=$request->page_number;
        $book->category_id=$request->category_id;

        $book->save();
        return redirect()->route('book.index');


//        Book::create($request->all());
//        return redirect()->route('book.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function show(Book $book)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Book  $book
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function edit(Book $book)
    {
        return view('books.edit',[
            'book'=>$book,
            'categories'=>Category::all()
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Book  $book
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, Book $book)
    {

        if($request->file('img')!=null) {
            $foto = $request->file('img');

            $fotoname = $request->book_name . '_' . rand() . '.' . $foto->extension();
            $foto->storeAs('images',$fotoname);
            $book->img=$fotoname;
        }

        $book->fill($request->all());
        $book->save();
        return redirect()->route('book.index');

//        $book->fill($request->all());
//        $book->save();
//        return redirect()->route('book.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Book  $book
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Book $book)
    {
        $book->delete();
        return redirect()->route('book.index');
    }

    public function display($name){
        $file=storage_path('app/images/'.$name);
        return response()->file( $file );
    }

    public function categorybooks($id)
    {
        return view('books.index',['books'=>Book::where('category_id',$id)->get()]);
    }

    public function findPost(Request $request) {
        $request->session()->put('find_post', $request->book_name);
        return redirect()->route('book.index');
    }

}
