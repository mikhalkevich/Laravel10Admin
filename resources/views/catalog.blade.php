<x-base-layout>
    <div class="container grid px-6 mx-auto">
        <h2 class="my-6 text-2xl font-semibold text-gray-700 dark:text-gray-200">
            {{$catalog->name}}
        </h2>
    </div>
    <div class="m-6">
        <aside class="z-20 flex-shrink-0 hidden w-64 overflow-y-auto bg-white dark:bg-gray-800 md:block">
            <div class="p-4 text-gray-500 dark:text-gray-400">

                @includeIf('includes.public_links.'.$catalog->url)

            </div>
        </aside>
    </div>
</x-base-layout>
