<x-base-layout>
    @include('includes.sidebar', ['catalog_link_prod'=>['name'=>$catalog_name, 'href'=>'catalog_data/'.$data_id], 'catalog_link_onliner'=>['name'=>'Товары', 'href'=>'catalog/onliner']])
    <div class="p-4">
        <div class="flex">
            <div class="flex-2 h-screen overflow-x-auto">
                @foreach($catalogs_onliner as $one)
                    <div x-data="{ open: {{($catalog_link->catalog_onliner_id == $one->id)?1:0}} }" class="border-2 bg-teal-50">
                        <button @click="open = ! open" class="p-1 align-text-left">{{$one->name}}</button>
                        @foreach($one->links as $link)
                            <div x-show="open">
                                @if($link->id == $id)
                                    <span class="bg-white p-2 block relative -right-2">{{$link->name}}</span>
                                @else
                                <a href="{{asset('catalog_catalog/'.$data_id.'/'.$link->id)}}"
                                   class="text-amber-950 p-2">{{$link->name}}</a>
                                @endif

                            </div>
                        @endforeach
                    </div>
                @endforeach
            </div>
            <div class="flex-auto">
                 https://catalog.api.onliner.by/search/{{$catalog_link->url }} <br />
                <div class="grid grid-cols-3 gap-3">
                    @foreach($products as $product)
                    @include('includes.product')
                    @endforeach
                </div>
            </div>
        </div>

    </div>
</x-base-layout>
