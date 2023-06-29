<div class="flex items-center justify-between w-full px-4 py-1 mx-auto flex-wrap-inherit">
    <nav>
        <!-- breadcrumb -->
        <ol class="flex flex-wrap pt-1 mr-12 bg-transparent rounded-lg sm:mr-16">
            <li class="text-sm leading-normal">
                <a class="opacity-50 text-slate-700" href="/">Главная</a>
            </li>
            @if(isset($catalog_link_onliner))
                <li class="text-sm pl-2 capitalize leading-normal text-slate-700 before:float-left before:pr-2 before:text-gray-600 before:content-['/']">
                    <a class="opacity-50 text-slate-700" href="/{{$catalog_link_onliner['href']}}">{{$catalog_link_onliner['name']}}</a>
                </li>
            @endif
            @if(isset($catalog_link_prod))
                <li class="text-sm pl-2 capitalize leading-normal text-slate-700 before:float-left before:pr-2 before:text-gray-600 before:content-['/']">
                    <a class="opacity-50 text-slate-700" href="/{{$catalog_link_prod['href']}}">{{$catalog_link_prod['name']}}</a>
                </li>
            @endif
            @if(isset($catalog_link))
                <li class="text-sm pl-2 capitalize leading-normal text-slate-700 before:float-left before:pr-2 before:text-gray-600 before:content-['/']">
                    {{$catalog_link->name}}
                </li>
            @endif
            @if(isset($catalog))
                <li class="text-sm pl-2 capitalize leading-normal text-slate-700 before:float-left before:pr-2 before:text-gray-600 before:content-['/']">{{$catalog->name}}</li>
            @endif
            @if(isset($catalog_onliner_id))
                <li class="text-sm pl-2 capitalize leading-normal text-slate-700 before:float-left before:pr-2 before:text-gray-600 before:content-['/']">{{config('catalog.onliner.'.$catalog_onliner_id)}}</li>
            @endif
            @if(isset($article_name))
                <li class="text-sm pl-2 capitalize leading-normal text-slate-700 before:float-left before:pr-2 before:text-gray-600 before:content-['/']">{{$article_name}}</li>
            @endif
        </ol>
    </nav>


</div>
