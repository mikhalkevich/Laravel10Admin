<?php

namespace App\Parser;

use App\Models\Product;
use App\Models\ProductImage;
use App;
use Auth;

class ProductOnlinerParse implements ParseContract
{
    public $crawler;
    use ParseTrait;

    public function getParse($catalog_link = null)
    {
        $parser_url = 'https://catalog.api.onliner.by/search/' . $catalog_link->url;
        $file = file_get_contents($parser_url);
        $result = json_decode($file);
        foreach ($result->products as $one) {
            $product = Product::updateOrCreate([
                'catalog_onliner_link_id' => $catalog_link->id,
                'name' => $one->name
            ], [
                'full_name' => $one->full_name,
                'extended_name' => $one->extended_name,
                'description' => $one->description,
                'description_small' => $one->micro_description,
                'key' => $one->key,
                'price_min' => optional(optional($one->prices)->price_min)->amount,
                'price_max' => optional(optional($one->prices)->price_max)->amount,
                'price' => optional(optional($one->sale)->min_prices_median)->amount
            ]);
            $url = 'http:' . optional($one->images)->header;
            $pic_obj = ProductImage::where('product_id', $product->id)->where('url', $url)->first();
            if (!$pic_obj) {
                $pic_obj = new ProductImage;
                $pic_obj->product_id = $product->id;
                $pic_obj->url = $url;
                $pic_obj->save();
            }
        }
    }
}
