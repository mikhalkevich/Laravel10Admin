@if (count($errors) > 0)
    <p>Whoops! Найдены ошибки.</p>
    @foreach ($errors->all() as $error)
        <p>{{ $error }}</p>
    @endforeach
@endif
<form role="form text-left" action="{{asset('catalog_book/'.$catalog_book->id.'/book_add')}}" method="post">
    @csrf
    <div class="mb-4">
        <input type="text" class="text-sm focus:shadow-soft-primary-outline leading-5.6 ease-soft block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding py-2 px-3 font-normal text-gray-700 transition-all focus:border-fuchsia-300 focus:bg-white focus:text-gray-700 focus:outline-none focus:transition-shadow" name="name" placeholder="Название книги">
    </div>
    <div class="mb-4">
        <datalist id="authors">
            @foreach($authors as $author)
            <option value="{{$author->name}}">
            @endforeach
        </datalist>
        <input type="text" list="authors" autocomplete="off" class="text-sm focus:shadow-soft-primary-outline leading-5.6 ease-soft block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding py-2 px-3 font-normal text-gray-700 transition-all focus:border-fuchsia-300 focus:bg-white focus:text-gray-700 focus:outline-none focus:transition-shadow" name="author" placeholder="Автор">
    </div>
    <div class="mb-4">
        <datalist id="publishs">
            @foreach($publishs as $public)
                <option value="{{$public->name}}">
            @endforeach
        </datalist>
        <input type="text" list="publishs" autocomplete="off" class="text-sm focus:shadow-soft-primary-outline leading-5.6 ease-soft block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding py-2 px-3 font-normal text-gray-700 transition-all focus:border-fuchsia-300 focus:bg-white focus:text-gray-700 focus:outline-none focus:transition-shadow" name="press" placeholder="Издательство">
    </div>
    <div class="mb-4">
        <input type="number" max="{{date('Y')}}" class="text-sm focus:shadow-soft-primary-outline leading-5.6 ease-soft block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding py-2 px-3 font-normal text-gray-700 transition-all focus:border-fuchsia-300 focus:bg-white focus:text-gray-700 focus:outline-none focus:transition-shadow" name="year" placeholder="Год">
    </div>
    <div class="mb-4">
        <input type="text" class="text-sm focus:shadow-soft-primary-outline leading-5.6 ease-soft block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding py-2 px-3 font-normal text-gray-700 transition-all focus:border-fuchsia-300 focus:bg-white focus:text-gray-700 focus:outline-none focus:transition-shadow" name="isbn" placeholder="ISBN">
    </div>
    <div class="text-center">
        <button type="submit" class="inline-block w-full px-6 py-3 font-bold text-center text-white uppercase align-middle transition-all bg-transparent border-0 rounded-lg cursor-pointer active:opacity-85 hover:scale-102 hover:shadow-soft-xs leading-pro text-xs ease-soft-in tracking-tight-soft shadow-soft-md bg-150 bg-x-25 bg-gradient-to-tl from-gray-900 to-slate-800 hover:border-slate-700 hover:bg-slate-700 hover:text-white">Добавить</button>
    </div>
</form>
