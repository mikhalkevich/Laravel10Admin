<?php

namespace App\Parser;

use Illuminate\Support\Facades\Auth;
use mysql_xdevapi\Exception;
use Symfony\Component\DomCrawler\Crawler;
use App\Models\Event;
use App\Models\CatalogOnliner;
use App\Models\CatalogOnlinerLink;
use Carbon\Carbon;
use App;

class CatalogOnlinerParse implements ParseContract
{
    public $crawler;
    use ParseTrait;

    public function getParse($parser_url = null)
    {
        $file = file_get_contents($parser_url);
        $this->crawler = new Crawler($file);
        $this->crawler->filter('.catalog-navigation-list__category')->each(function (Crawler $node) use ($parser_url) {
            $data_id = $node->attr('data-id');
            $node->filter('.catalog-navigation-list__aside-item')->each(function (Crawler $node2) use ($data_id) {
                $text = $this->text($node2, '.catalog-navigation-list__aside-title');
                $catalog_onliner_obj = CatalogOnliner::updateOrCreate([
                    'name' => $text
                ], [
                    'data_id' => $data_id
                ]);
                $node2->filter('.catalog-navigation-list__dropdown-item')->each(function (Crawler $node3) use ($catalog_onliner_obj) {
                    $text_link = $this->text($node3, '.catalog-navigation-list__dropdown-title');
                    $href_link = $this->attr($node3, 'a.catalog-navigation-list__dropdown-item', 'href');
                    $url_arr = explode('/', $href_link);
                    $link = CatalogOnlinerLink::where('name', $text_link)->where('catalog_onliner_id', $catalog_onliner_obj->id)->first();
                    if (!$link) {
                        $link = CatalogOnlinerLink::create([
                            'catalog_onliner_id' => $catalog_onliner_obj->id,
                            'name' => $text_link,
                            'attr_href' => $href_link,
                            'url' => end($url_arr),
                        ]);
                    }
                });
            });
        });
    }

    private function saveHrefToDb($href, $country_id, $small_pic)
    {

    }
}
