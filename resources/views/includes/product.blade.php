<div>
    <h2>{{$product->name}}</h2>
    @if(isset($product->images))
    <img src="{{optional(optional($product->images)[0])['url']}}" />
    @endif
</div>
