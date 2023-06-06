<?php

namespace App\Parser;

use Illuminate\Support\Facades\Auth;
use mysql_xdevapi\Exception;
use Symfony\Component\DomCrawler\Crawler;
use App\Models\Event;
use Carbon\Carbon;
use App;

class YouwebcamParse implements ParseContract
{
    public $crawler;
    use ParseTrait;

    public function getParse($parser_url = null)
    {
        $url           = $parser_url->url;
        $file          = file_get_contents($url);
        $this->crawler = new Crawler($file);
        $this->crawler->filter('.h-100')->each(function (Crawler $node) use ($parser_url) {
            // $text = $this->text($node,'a');
            $small_pic = $this->attr($node, 'img', 'data-src');
            $href = $this->attr($node, 'a', 'href');
            if ($href != null) {
                $this->saveHrefToDb($href, $parser_url->country_id, $small_pic);
            }
        });
    }

    private function saveHrefToDb($href, $country_id, $small_pic)
    {
        $file = file_get_contents($href);
        if ($file) {
            $this->crawler = new Crawler($file);
            $name          = $this->text($this->crawler, 'header h1');
            $body         = $this->text($this->crawler, '.lead');
            $iframe_camera = $this->attr($this->crawler, '.cam_in_new_window', 'href');
            $picture1 = $this->attr($this->crawler, '.cam_in_new_window img', 'src');
            echo '<img src="'.$small_pic.'" width="100%">';
            echo '<br />';
            $name_arr = explode(',', $name);
            $webcamera = [];
            $webcamera['name'] = $name;
            $webcamera['body'] = $body;
            $webcamera['city'] = isset($name_arr[1])??'';
            $webcamera['country_id'] = $country_id;
            $webcamera['picture1'] = $picture1;
            $webcamera['iframe_camera'] = $iframe_camera;
            $webcamera['link'] = $href;
            App::make(App\Utils\WebcameraParse::class)->find($webcamera, $country_id);
        }
    }
}
