<x-admin-layout>
    <div class="container grid px-6 mx-auto">
        <h2 class="my-6 text-2xl font-semibold text-gray-700 dark:text-gray-200">
            Каталог Onliner
        </h2>
    </div>

    <div class="py-12">
        <table width="100%" class="w-full whitespace-no-wrap">
            <tr class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase border-b dark:border-gray-700 bg-gray-50 dark:text-gray-400 dark:bg-gray-800">
            <th>ID</th>
            <th>Название</th>
            <th>Ссылки</th>
            </tr>
            <tbody class="bg-white divide-y dark:divide-gray-700 dark:bg-gray-800">
@foreach($catalogs as $catalog)
    <tr class="text-gray-700 dark:text-gray-400">
        <td>{{$catalog->id}}</td>
        <td>
            <h2>{{$catalog->name}}</h2>
        </td>
        <td>
            @foreach($catalog->links as $link)
<a href="https://catalog.api.onliner.by/search/{{$link->url}}" class="text-amber-950" target="_blank">{{$link->name}}</a><hr />
            @endforeach
        </td>
    </tr>
@endforeach
            </tbody>
        </table>
    </div>
</x-admin-layout>
