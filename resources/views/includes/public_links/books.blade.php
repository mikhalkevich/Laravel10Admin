@php
    function articleList($options, $site_product_id, $a){
    foreach ($options as $one) {
    if($one->parent_id == $site_product_id){
    echo "<li class='p-1 ml-$a'>";
    $request_arr = explode("/",$_SERVER['REQUEST_URI']);
if($one->id == end($request_arr)){
    echo "<span class='p-1'>";
    echo str_repeat('*', $a);
echo  $one->name;
    echo "</span>";
}else{
    echo "<a href='".asset('catalog_book/'.$one->id)."' class='text-amber-950 bg-sky-50  block p-1'>";
echo str_repeat('*', $a);
echo  $one->name;
echo "</a>";
}

    echo '</li>';
    articleList(App\Models\CatalogBook::whereParentId($one->id)->get(), $one->id, $a+1);
    }
    }
    }
@endphp
<ul>
    @php
        articleList(App\Models\CatalogBook::whereParentId(null)->get(), 0, 0);
    @endphp
</ul>

