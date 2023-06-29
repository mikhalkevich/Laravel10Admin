<x-base-layout>
    @include('includes.sidebar', ['catalog_link_onliner'=>['name'=>'Книги', 'href'=>'catalog/books']])
    <div class="p-4">
        <div class="grid grid-cols-4">
            <div class="h-screen overflow-x-auto">
                @include('includes.public_links.books')
            </div>
            <div class="col-span-3">
                <div class="grid grid-cols-2 p-5">
                    <div>
                        @include('includes.book_add_form')
                    </div>
                    <div class="p-2">
                        <div class="first-letter:text-7xl first-letter:font-bold first-letter:text-gray-900 dark:first-letter:text-gray-100 first-letter:mr-3 first-letter:float-left">{{$catalog_book->name}}</div>
                        <p class="mb-3 text-gray-500 dark:text-gray-400 first-line:uppercase first-line:tracking-widest">добавить книгу в раздел "{{$catalog_book->name}}".</p>
                        <p class="pt-2">Для этого необходимо заполнить форму, указав Название книги, автора (или коллектив авторов),
                            ISBN (если таковой имеется), информацию об издательстве и год издания.</p>
                        <p class="pt-2">Загрузить обложку, файл или ссылку на книгу можно будет после заполнения этой формы.</p>

                    </div>
                </div>
                <div class="grid grid-cols-5">
                    @foreach($books as $book)
                    @include('includes.book_card')
                    @endforeach
                </div>
                <div>
                    {!! $books->links() !!}
                </div>
            </div>
        </div>
    </div>
</x-base-layout>
