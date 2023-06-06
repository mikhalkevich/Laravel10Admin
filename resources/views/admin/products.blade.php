<x-admin-layout>
    <div class="container grid px-6 mx-auto">
        <h2 class="my-6 text-2xl font-semibold text-gray-700 dark:text-gray-200">
            Products
        </h2>
    </div>

    <div class="py-12">
        <div
            class="px-4 py-3 mb-8 bg-white rounded-lg shadow-md dark:bg-gray-800"
        >
            @if (count($errors) > 0)
                Whoops! Найдены следующие ошибки.
                @foreach ($errors->all() as $error)
                    <p> {{ $error }}</p>
                @endforeach
            @endif
            <form method="post" action="{{asset('admin/product')}}">
                @csrf
                <label class="block text-sm">
                    <span class="text-gray-700 dark:text-gray-400">Name</span>
                    <input
                        name="name"
                        class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input"
                    />
                </label>
                <label class="block">
                    <textarea name="description" rows="3"
                              class="block w-full mt-1 text-sm dark:text-gray-300 dark:border-gray-600 dark:bg-gray-700 form-textarea focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray"></textarea>
                </label>
                <label class="block">
                    <button
                        class="px-10 py-4 font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple">
                        Save
                    </button>
                </label>
            </form>
        </div>
        <table class="w-full whitespace-no-wrap">
            <thead>
            <tr class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase border-b dark:border-gray-700 bg-gray-50 dark:text-gray-400 dark:bg-gray-800">
                <th class="px-4 py-3">ID</th>
                <th class="px-4 py-3">Name</th>
                <th class="px-4 py-3">Pictures</th>
                <th class="px-4 py-3">Description</th>
                <th class="px-4 py-3">Catalogs</th>
                <th class="px-4 py-3">Status</th>
                <th class="px-4 py-3">Actions</th>
            </tr>
            </thead>
            <tbody class="bg-white divide-y dark:divide-gray-700 dark:bg-gray-800">
            @foreach($products as $product)
                <tr class="text-gray-700 dark:text-gray-400">
                    <td class="px-4 py-3">
                        {{$product->id}}
                    </td>
                    <td class="px-4 py-3 text-sm">
                        {{$product->name}}
                    </td>
                    <td class="px-4 py-3 text-sm">
                        @php
                            $arr_media = $product->getMedia();
                            $arr_pictures = [];
                            foreach($arr_media as $media){
    $arr_pictures[] = $media->getFullUrl();
                            }
                        @endphp
                        @foreach($arr_pictures as $picture)
                            <img src="{{$picture}}" width="100px" />
                        @endforeach
                        <form method="post" action="{{asset('admin/product/'.$product->id.'/add_picture')}}"
                              enctype="multipart/form-data">
                            @csrf
                            <input type="file" name="picture"/>
                            <button>OK</button>
                        </form>
                    </td>
                    <td class="px-4 py-3 text-xs">
                        {{$product->description}}
                    </td>
                    <td class="px-4 py-3 text-xs">
                        @foreach($product->catalogs as $cat)
                            <a href="{{asset('admin/catalog/'.$cat->id)}}">{{$cat->name}}</a>
                        @endforeach
                        <hr/>
                        <form method="post" action="{{asset('admin/product/'.$product->id)}}">
                            @csrf
                            <select name="catalog_id" id="catalog">
                                <option value="0">Выберите из списка</option>
                                @foreach($catalogs as $catalog)
                                    <option value="{{$catalog->id}}">{{$catalog->name}}</option>
                                @endforeach
                            </select>
                            <button type="submit">OK</button>
                        </form>
                    </td>
                    <td class="px-4 py-3 text-sm">
                        {{config('my.status.'.$product->status)}}
                    </td>
                    <td class="px-4 py-3 text-sm">
                        <form action="{{ asset('admin/catalog/'.$product->id) }}" method="POST">
                            <input type="hidden" name="_method" value="DELETE">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <button class="text-amber-950">Delete</button>
                        </form>
                        <a href="{{asset('admin/product/'.$product->id.'/edit')}}" class="text-amber-950">Edit</a>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
        {!! $products->links() !!}
    </div>
</x-admin-layout>
