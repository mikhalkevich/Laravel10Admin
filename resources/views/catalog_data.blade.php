<x-base-layout>
    <div class="container grid px-6 mx-auto">
        <h2 class="my-6 text-2xl font-semibold text-gray-700 dark:text-gray-200">
            Каталог
        </h2>
    </div>
    @foreach($catalogs_onliner as $one)
        <h2>{{$one->name}}</h2>
        @foreach($one->links as $link)
            <b>{{$link->name}}</b>
            https://catalog.api.onliner.by/search/{{$link->url}} <br />
        @endforeach
    @endforeach
</x-base-layout>
