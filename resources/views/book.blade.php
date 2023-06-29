<x-base-layout>
    @include('includes.sidebar', [
    'catalog_link_onliner'=>['name'=>'Книги', 'href'=>'catalog/books'],
    'catalog_link_prod'=> ['name'=>$book->catalog->name, 'href'=>'catalog_book/'.$book->catalog_book_id],
    'article_name' => $book->name
    ])
    <div class="p-4">
        <div class="grid grid-cols-4">
            <div class="col-span-3">
                <b>{{$book->name}}</b>
                <hr/>
                @foreach($book->covers as $cover)
                    <img src="{{$cover->src}}" class="float-left" />
                @endforeach
                <hr class="clear-both" />
                <span>Автор</span> <a href="#">{{optional($book->author)->name}}</a> <br/>
                <span>Издательство</span> <a href="#">{{optional($book->publish)->name}}</a> {{$book->year}} <br/>
                <span>Описание</span> ... <br/>
                <span>Комментарии</span> <a href="#">+</a> <br/>
            </div>
            <div class="">
                <div x-data="{ tab: window.location.hash ? window.location.hash.substring(1) : 'description' }"
                     id="tab_wrapper">
                    <!-- The tabs navigation -->
                    <nav>
                        <a :class="{ 'active': tab === 'description' }"
                           @click.prevent="tab = 'description'; window.location.hash = 'description'" href="#">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                 stroke="currentColor" class="w-6 h-6 float-left">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                      d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10"/>
                            </svg>
                        </a>
                        <a :class="{ 'active': tab === 'reviews' }"
                           @click.prevent="tab = 'reviews'; window.location.hash = 'reviews'" href="#">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                 stroke="currentColor" class="w-6 h-6 float-left">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                      d="M2.25 15.75l5.159-5.159a2.25 2.25 0 013.182 0l5.159 5.159m-1.5-1.5l1.409-1.409a2.25 2.25 0 013.182 0l2.909 2.909m-18 3.75h16.5a1.5 1.5 0 001.5-1.5V6a1.5 1.5 0 00-1.5-1.5H3.75A1.5 1.5 0 002.25 6v12a1.5 1.5 0 001.5 1.5zm10.5-11.25h.008v.008h-.008V8.25zm.375 0a.375.375 0 11-.75 0 .375.375 0 01.75 0z"/>
                            </svg>
                        </a>
                        <a :class="{ 'active': tab === 'links' }"
                           @click.prevent="tab = 'links'; window.location.hash = 'links'" href="#">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                 stroke="currentColor" class="w-6 h-6 float-left">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                      d="M13.19 8.688a4.5 4.5 0 011.242 7.244l-4.5 4.5a4.5 4.5 0 01-6.364-6.364l1.757-1.757m13.35-.622l1.757-1.757a4.5 4.5 0 00-6.364-6.364l-4.5 4.5a4.5 4.5 0 001.242 7.244"/>
                            </svg>
                        </a>
                    </nav>
                    <br class="clear-both"/>
                    <!-- The tabs content -->
                    <div x-show="tab === 'description'">
                        <b>Редактирование книги</b><br /> только для зарегистрированных пользователей
                    </div>
                    <div x-show="tab === 'reviews'">
                        <b>Подбор обложки</b>
                        <div class="flex justify-end mb-2 md:flex">
                            <button @click="
                            const myArticle = document.getElementById('google_find_empty');
                            const response = await fetch('/book/{{$book->id}}/find_cover_original')
                            .then((response) => response.text())
                            .then((text) => {
                              myArticle.innerHTML = text;
                            });"
                                    class="inline-block px-6 py-2 text-xs font-medium leading-6 text-center text-white uppercase transition bg-blue-700 rounded shadow ripple hover:shadow-lg hover:bg-blue-800 focus:outline-none">
                                {{$book->name . ' ' .optional($book->author)->name . ' ' . $book->year}}
                            </button>
                            <button @click="
                            const myArticle = document.getElementById('google_find_empty');
                            const response = await fetch('/book/{{$book->id}}/find_cover')
                            .then((response) => response.text())
                            .then((text) => {
                              myArticle.innerHTML = text;
                            });"
                                    class="mb-2 inline-block px-6 py-2 text-xs font-medium leading-6 text-center text-white uppercase transition bg-blue-700 rounded shadow ripple hover:shadow-lg hover:bg-blue-800 focus:outline-none">
                                {{str()->slug($book->name . ' ' .optional($book->author)->name . ' ' . $book->year)}}
                            </button>
                        </div>
                        <div id="google_find_empty"></div>
                    </div>
                    <div x-show="tab === 'links'">
                        Ссылки здесь
                    </div>

                </div>

            </div>
        </div>
    </div>
</x-base-layout>
