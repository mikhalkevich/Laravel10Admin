<x-base-layout>
    @include('includes.sidebar', ['catalog_link_onliner'=>['name'=>'Товары', 'href'=>'catalog/onliner'], 'catalog_onliner_id'=>$id])
    <div class="p-4">
        <div class="flex">
            <div class="flex-2 h-screen overflow-x-auto">
                @foreach($catalogs_onliner as $one)
                    <div x-data="{ open: false}" class="border-2 bg-teal-50">
                        <button @click="open = ! open" class="p-1">{{$one->name}}</button>
                        @foreach($one->links as $link)
                            <div x-show="open">
                                <a href="{{asset('catalog_catalog/'.$id.'/'.$link->id)}}"
                                   class="text-amber-950 p-2">{{$link->name}}</a>
                                <!--https://catalog.api.onliner.by/search/ <br />-->
                            </div>
                        @endforeach
                    </div>
                @endforeach
            </div>
            <div class="flex-4">
                тут контент
            </div>
        </div>
    </div>
</x-base-layout>
