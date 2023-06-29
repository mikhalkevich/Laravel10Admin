<?php

namespace App\Http\Controllers;

use App\Models\CatalogBook;
use App\Models\Book;
use App\Models\BookAuthor;
use App\Models\BookPublishing;
use App\Models\BookCover;
use App\Parser\BookParse;
use Illuminate\Http\Request;
use App\Http\Requests\BookRequest;

class BookController extends Controller
{
    public function getCatalogBook($id = null)
    {
        $catalog_book = CatalogBook::find($id);
        $books = Book::where('catalog_book_id', $id)->orderBy('id', 'DESC')->simplePaginate(12);
        $authors = BookAuthor::all();
        $publishs = BookPublishing::all();
        $catalogs = CatalogBook::all();
        return view('catalog_book', compact('catalog_book', 'books', 'authors', 'publishs', 'catalogs'));
    }

    public function postBook(BookRequest $request, $id)
    {
        $request['catalog_book_id'] = $id;
        $author = BookAuthor::firstOrCreate(
            ['name' => $request->author],
            ['name' => $request->author]
        );
        $publish = BookPublishing::firstOrCreate(
            ['name' => $request->press],
            ['name' => $request->press]
        );
        $request['author_id'] = $author->id;
        $request['publishing_id'] = $publish->id;
        Book::create($request->all());
        return redirect()->back();
    }

    public function getOne(Book $book)
    {
        return view('book', compact('book'));
    }

    public function findCover(Book $book)
    {
        $parse = new BookParse();
        return $parse->getParse($book);
    }

    public function findCoverOriginal(Book $book)
    {
        $parse = new BookParse();
        return $parse->getParseOriginal($book);
    }

    public function getBookCover(Book $book, Request $request)
    {
        abort_if(!$request->src, '404');
        $cover = BookCover::where('book_id', $book->id)->where('src', $request->src)->first();
        if (!$cover) {
            BookCover::create([
                'book_id' => $book->id,
                'src' => $request->src
            ]);
        }
        return redirect()->back();
    }
}
