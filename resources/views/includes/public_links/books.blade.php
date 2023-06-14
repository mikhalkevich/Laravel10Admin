@foreach(App\Models\CatalogBook::whereParentId(null)->get() as $catalog_book)
    <a href="{{asset('catalog/book/'.$catalog_book->id)}}" class="text-amber-950">{{$catalog_book->name}}</a><br />
    @foreach(App\Models\CatalogBook::whereParentId($catalog_book->id)->get() as $catalog_book2)
     ---  <a href="{{asset('catalog/book/'.$catalog_book2->id)}}" class="text-amber-950">{{$catalog_book2->name}}</a><br />
    @endforeach
@endforeach
