<form action="{{'/catalog/books'}}" method="get">
    @csrf
    <div class="">
        <div>
            <select name="catalog" class="w-full" @change="
const subCatalog = document.getElementById('sub_catalog_empty');
const cat = $event.target.value;
                            const response = await fetch('/catalog/'+cat+'/subcatalogs')
                            .then((response) => response.text())
                            .then((text) => {
                              subCatalog.innerHTML = text;
                            });
            ">
                <option value="0" x-bind:value="0">Выберите каталог</option>
                @foreach(App\Models\CatalogBook::whereNull('parent_id')->get() as $catalog)
                    <option value="{{$catalog->id}}" x-bind:value="{{$catalog->id}}">{{$catalog->name}}</option>
                @endforeach
            </select>
        </div>
        <div>
            <div id="sub_catalog_empty"></div>
        </div>
        <div>
            <input type="text" name="name" class="text-sm focus:shadow-soft-primary-outline leading-5.6 ease-soft block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding py-2 px-3 font-normal text-gray-700 transition-all focus:border-fuchsia-300 focus:bg-white focus:text-gray-700 focus:outline-none focus:transition-shadow" placeholder="Название книги" value="{{request()->name?request()->name:''}}">
        </div>
        <div>

            <datalist id="authors">
                @foreach(App\Models\BookAuthor::all() as $author)
                    <option value="{{$author->name}}">
                @endforeach
            </datalist>
            <input type="text" name="author" list="authors" autocomplete="off" class="text-sm focus:shadow-soft-primary-outline leading-5.6 ease-soft block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding py-2 px-3 font-normal text-gray-700 transition-all focus:border-fuchsia-300 focus:bg-white focus:text-gray-700 focus:outline-none focus:transition-shadow" placeholder="Автор">
        </div>
        <div>
            <input type="text" name="publish" class="text-sm focus:shadow-soft-primary-outline leading-5.6 ease-soft block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding py-2 px-3 font-normal text-gray-700 transition-all focus:border-fuchsia-300 focus:bg-white focus:text-gray-700 focus:outline-none focus:transition-shadow" placeholder="Издательство">
        </div>
        <div>
            <input type="text" name="year" class="text-sm focus:shadow-soft-primary-outline leading-5.6 ease-soft block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding py-2 px-3 font-normal text-gray-700 transition-all focus:border-fuchsia-300 focus:bg-white focus:text-gray-700 focus:outline-none focus:transition-shadow" placeholder="Год">
        </div>
        <div>
            <input type="checkbox" name="cover" id="is_cover"><label for="is_cover">Наличие обложки</label>
            <input type="checkbox" name="link" id="is_link"><label for="is_link">Наличие ссылки</label>
            <div>
                <button type="submit" class="inline-block px-6 py-3 font-bold text-center text-white uppercase align-middle transition-all bg-transparent border-0 rounded-lg cursor-pointer active:opacity-85 hover:scale-102 hover:shadow-soft-xs leading-pro text-xs ease-soft-in tracking-tight-soft shadow-soft-md bg-150 bg-x-25 bg-gradient-to-tl from-gray-900 to-slate-800 hover:border-slate-700 hover:bg-slate-700 hover:text-white">Filter</button>
                <a href="{{asset('catalog/books')}}">Reset</a>
            </div>
        </div>

    </div>
</form>
