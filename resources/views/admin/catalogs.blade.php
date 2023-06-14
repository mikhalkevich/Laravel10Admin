<x-admin-layout>
    <div class="container grid px-6 mx-auto">
        <h2 class="my-6 text-2xl font-semibold text-gray-700 dark:text-gray-200">
            Catalogs
        </h2>
    </div>

    <div class="py-12">
        <div
            class="px-4 py-3 mb-8 bg-white rounded-lg shadow-md dark:bg-gray-800"
        >
            <form method="post" action="{{asset('admin/catalog')}}">
                @csrf
                <label class="block text-sm">
                    <span class="text-gray-700 dark:text-gray-400">Name</span>
                    <input
                        name="name"
                        class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input"
                    />
                </label>
                <label class="block">
                    <textarea name="body" rows="3"
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
                <th class="px-4 py-3">Description</th>
                <th class="px-4 py-3">Products</th>
                <th class="px-4 py-3">Actions</th>
            </tr>
            </thead>
            <tbody class="bg-white divide-y dark:divide-gray-700 dark:bg-gray-800">
            @foreach($catalogs as $catalog)
                <tr class="text-gray-700 dark:text-gray-400">
                    <td class="px-4 py-3">
                        {{$catalog->id}}
                    </td>
                    <td class="px-4 py-3 text-sm">
                        {{$catalog->name}}
                    </td>
                    <td class="px-4 py-3 text-xs">
                        {{$catalog->body}}
                    </td>
                    <td class="px-4 py-3 text-xs">
                        @foreach($catalog->products as $prod)
                            <b>{{$prod->name}}</b> |
                        @endforeach
                    </td>
                    <td class="px-4 py-3 text-sm">

                        <form action="{{ asset('admin/catalog/'.$catalog->id) }}" method="POST">
                            <input type="hidden" name="_method" value="DELETE">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <button class="text-amber-950">Delete</button>
                        </form>

                        <a href="{{asset('admin/catalog/'.$catalog->id.'/edit')}}" class="text-amber-950">Edit</a>

                        @includeIf('includes.admin_links.'.$catalog->url)


                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
</x-admin-layout>
