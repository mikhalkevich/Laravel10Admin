    <!--Card 1-->
    <div class="rounded overflow-hidden shadow-lg">
        <section class="hero container max-w-screen-lg mx-auto pb-5 pt-5 flex justify-center">
        @if($book->covers)
        <img class="text-center" src="{{optional($book->covers()->first())->src}}" alt="Mountain">
        @endif
        </section>
        <div class="px-6 py-4">
            <div class="font-bold text-xl mb-2"><a href="{{asset('book/'.$book->id)}}" class="text-amber-950">{{$book->name}}</a></div>
            <p class="text-gray-700 text-base">
                {{optional($book->author)->name}}
            </p>
            <p class="text-gray-700 text-sm">
                Издание: {{optional($book->publish)->name}} {{$book->year}}
            </p>
        </div>
        <div class="px-6 pt-4 pb-2">

        </div>
    </div>
