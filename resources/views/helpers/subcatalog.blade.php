<select name="subcatalog" class="w-full">
    @foreach($subcatalogs as $subcatalog)
        <option value="{{$subcatalog->id}}">{{$subcatalog->name}}</option>
    @endforeach
</select>
ajax({
 'url':'/catalog/${$(this).val()}/subcatalog',
 'method':'Post',
 'error':function(){
 },
 'success':function(){

 }
})
