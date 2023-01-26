<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $youtube = ["MLpWrANjFbI", "TGbUpEJ1z-k", "SKbHHcdLGKw", "7abGwVjXSY4", "n7EmdNsKIhk", "mATMpaPBBFI", "AVpcxtH8hWg", "tJlzIJaokVY", "eEzD-Y97ges"];
        $images = [
            'https://loremflickr.com/640/360',
            'http://placeimg.com/640/360/any',
            'https://picsum.photos/640/360.webp'
        ];

        // Build description
        $desc = $this->faker->text($this->faker->randomElement([200, 400, 300]));
        $desc .= str_replace("::LINK::", $this->faker->randomElement($youtube), '<p><br/><iframe frameborder="0" src="//www.youtube.com/embed/::LINK::" class="note-video-clip" style="width: 100%; height: 475px; float: none;"></iframe></p><br/>');
        $desc .= $this->faker->text($this->faker->randomElement([100, 200, 300]));
        $desc .= str_replace("::LINK::", $this->faker->randomElement($images), '<img src="::LINK::" style="width: 50%; float: right;">');
        $desc .= $this->faker->text($this->faker->randomElement([1000, 1200, 1500, 1800]));
        $desc .= str_replace("::LINK::", $this->faker->randomElement($images), '<p><br/><img src="::LINK::" style="width: 100%; float: none;"></p><br/>');
        $desc .= $this->faker->text($this->faker->randomElement([400, 200, 300]));

        $stores = \DB::table('stores')->pluck('id')->toArray();
        $num = $this->faker->randomFloat($nbMaxDecimals = NULL, $min = 100, $max = 400);

        return [
            'store_id'         => $this->faker->randomElement($stores),
            'brand'            => $this->faker->word,
            'name'             => $this->faker->sentence,
            'sale_price'       => $num+rand(50, 200),
            'purchase_price'   => $num,
            'quantity'         => rand(9, 99),
            'model_number'     => $this->faker->word .' '.$this->faker->bothify('??###'),
            'mpn'              => $this->faker->randomNumber(NULL, false),
            'description'      => $desc,
            'slug'             => $this->faker->slug,
            'meta_title'       => $this->faker->sentence,
            'meta_description' => $this->faker->realText,
            'sale_count'       => $this->faker->randomDigit,
            'active'           => 1,
        ];
    }
}
