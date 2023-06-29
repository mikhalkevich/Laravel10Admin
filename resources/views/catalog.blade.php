<x-base-layout>
    @include('includes.sidebar')
    <div class="p-4">
        <div class="grid grid-cols-4">
            <div class="h-screen overflow-x-auto">
                @includeIf('includes.filters.'.$catalog->url)
                @include('includes.public_links.books')
            </div>
            <div class="col-span-3">
                @if($catalog->url == 'books')
                    <div class="grid grid-cols-3 p-5">
                        @foreach(App\Models\Book::filter(Request::all())->get() as $book)
                            @include('includes.book_card')
                        @endforeach
                    </div>

                @endif
            </div>
        </div>
    </div>
</x-base-layout>
