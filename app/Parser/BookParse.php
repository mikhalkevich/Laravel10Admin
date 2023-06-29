<?php

namespace App\Parser;

use App\Models\Book;
use App;
use Auth;
use Str;
use Symfony\Component\DomCrawler\Crawler;

class BookParse implements ParseContract
{
    public $crawler;
    use ParseTrait;

    public function getParse($book = null)
    {
        $str =  Str::slug($book->name . ' ' . optional($book->author)->name) . ' ' . $book->year;
        $url = 'https://duckduckgo.com/?q='.$str.'&t=newext&atb=v375-1&iax=images&ia=images';

        $url_google = 'https://www.google.com/search?q='.$str.'&tbm=isch&sa=X&ved=2ahUKEwiKscDW6eX_AhWZwQIHHdG2CngQ0pQJegQICxAB&biw=1280&bih=324&dpr=1';
        $file          = file_get_contents($url_google);
        $this->crawler = new Crawler($file);
        echo $this->crawler->filter('.GpQGbf')->html();
    }
    public function getParseOriginal($book = null){
        $str =   urlencode($book->name . ' ' . optional($book->author)->name . ' ' . $book->year);
        $url = 'https://duckduckgo.com/?q='.$str.'&t=newext&atb=v375-1&iax=images&ia=images';

        $url_google = 'https://www.google.com/search?q='.$str.'&tbm=isch&sa=X&ved=2ahUKEwiKscDW6eX_AhWZwQIHHdG2CngQ0pQJegQICxAB&biw=1280&bih=324&dpr=1';
        $file          = file_get_contents($url_google);
        $this->crawler = new Crawler($file);
        $this->crawler->filter('.IkMU6e img')->each(function (Crawler $node) use ($book) {
            $data_src = $node->attr('src');
            echo "<div class=''>";
            echo "<img src='$data_src' class='left' />";
            echo "<a href='".asset('book/'.$book->id.'/get_book_cover?src='.$data_src)."' class='inline-block px-6 py-2 text-xs font-medium leading-6 text-center text-white uppercase transition bg-blue-700 rounded shadow ripple hover:shadow-lg hover:bg-blue-800 focus:outline-none'>Сохранить</a>";
            echo '<br />';
            echo '</div>';
        });
    }
}
