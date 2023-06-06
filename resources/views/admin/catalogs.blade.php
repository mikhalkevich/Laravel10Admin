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
                        <div x-data="{
    open: false,
    get isOpen() { return this.open },
    toggle() { this.open = ! this.open },
}">
                            <button @click="toggle()" class="text-amber-950">Open</button>

                            <div
                                x-show="isOpen"
                                x-transition:enter="transition ease-out duration-150"
                                x-transition:enter-start="opacity-0"
                                x-transition:enter-end="opacity-100"
                                x-transition:leave="transition ease-in duration-150"
                                x-transition:leave-start="opacity-100"
                                x-transition:leave-end="opacity-0"
                                class="fixed inset-0 z-30 flex items-end bg-black bg-opacity-50 sm:items-center sm:justify-center"
                            >
                                <!-- Modal -->
                                <div
                                    x-show="isOpen"
                                    x-transition:enter="transition ease-out duration-150"
                                    x-transition:enter-start="opacity-0 transform translate-y-1/2"
                                    x-transition:enter-end="opacity-100"
                                    x-transition:leave="transition ease-in duration-150"
                                    x-transition:leave-start="opacity-100"
                                    x-transition:leave-end="opacity-0  transform translate-y-1/2"
                                    @click.away="closeModal"
                                    @keydown.escape="closeModal"
                                    class="w-full px-6 py-4 overflow-hidden bg-white rounded-t-lg dark:bg-gray-800 sm:rounded-lg sm:m-4 sm:max-w-xl"
                                    role="dialog"
                                    id="modal{{$catalog->id}}"
                                >
                                    <!-- Remove header if you don't want a close icon. Use modal body to place modal tile. -->
                                    <header class="flex justify-end">
                                        <a
                                            class="inline-flex items-center justify-center w-6 h-6 text-gray-400 transition-colors duration-150 rounded dark:hover:text-gray-200 hover: hover:text-gray-700"
                                            aria-label="close"
                                            href="{{asset('admin/catalog')}}"
                                        >
                                            <svg
                                                class="w-4 h-4"
                                                fill="currentColor"
                                                viewBox="0 0 20 20"
                                                role="img"
                                                aria-hidden="true"
                                            >
                                                <path
                                                    d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                                                    clip-rule="evenodd"
                                                    fill-rule="evenodd"
                                                ></path>
                                            </svg>
                                        </a>
                                    </header>
                                    <!-- Modal body -->
                                    <div class="mt-4 mb-6">
                                        <!-- Modal title -->
                                        <p
                                            class="mb-2 text-lg font-semibold text-gray-700 dark:text-gray-300"
                                        >
                                            #{{$catalog->id}} {{$catalog->name}}
                                        </p>
                                        <!-- Modal description -->
                                        <div class="text-sm text-gray-700 dark:text-gray-400">
                                            @if($catalog->id == 8)
                                            <div class="text-center"><button
                                                class="px-3 py-1 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-md active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple parse" id="parse{{$catalog->id}}">Parse</button></div>
                                            @endif
                                        <div id="empty{{$catalog->id}}"></div>

                                        </div>
                                    </div>
                                    <footer
                                        class="flex flex-col items-center justify-end px-6 py-3 -mx-6 -mb-4 space-y-4 sm:space-y-0 sm:space-x-6 sm:flex-row bg-gray-50 dark:bg-gray-800"
                                    >
                                        <button
                                            @click="toggle()"
                                            class="w-full px-5 py-3 text-sm font-medium leading-5 text-gray-400 text-gray-700 transition-colors duration-150 border border-gray-300 rounded-lg dark:text-gray-400 sm:px-4 sm:py-2 sm:w-auto active:bg-transparent hover:border-gray-500 focus:border-gray-500 active:text-gray-500 focus:outline-none focus:shadow-outline-gray"
                                        >
                                            Cancel
                                        </button>
                                        <button
                                            class="w-full px-5 py-3 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg sm:w-auto sm:px-4 sm:py-2 active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple"
                                        >
                                            Accept
                                        </button>
                                    </footer>
                                </div>
                            </div>
                        </div>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
</x-admin-layout>
