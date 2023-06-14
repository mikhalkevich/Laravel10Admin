<x-base-layout>
    <div class="container grid px-6 mx-auto">
        <h2 class="my-6 text-2xl font-semibold text-gray-700 dark:text-gray-200">
            Каталоги
        </h2>
    </div>
    <div class="py-12">
        <div class="grid gap-6 mb-8 md:grid-cols-2">
        @foreach($catalogs as $catalog)
        <div class="min-w-0 p-4 bg-white rounded-lg shadow-xs dark:bg-gray-800">
            <h3 class="mb-4 font-semibold text-gray-600 dark:text-gray-300 font-sans">
                <a href="{{asset('catalog/'.$catalog->url)}}">{{$catalog->name}}</a>
            </h3>
            <div class="text-gray-600 dark:text-gray-400 font-body">
                <a href="{{asset('catalog/'.$catalog->url)}}">{!! $catalog->body !!}</a>
            </div>
            <div x-data="{ open: false, answer: '&#8595; показать' }" class="border-2">
                <button @click="open = ! open; answer=open?'&#8593; скрыть':'&#8595; показать'"><span x-text="answer"></span></button>
                <div x-show="open">
                    @includeIf('includes.public_links.'.$catalog->url)
                </div>
            </div>
        </div>

        @endforeach
        </div>
    </div>
</x-base-layout>
