<?php

use Illuminate\Database\Seeder;

class LinksTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            [
            'link_name' => 'Facebook',
            'link_title' => 'social media',
            'link_url' => 'https://www.facebook.com/',
            'link_order' => 1,
            ],
            [
            'link_name' => 'weibo',
            'link_title' => 'social media',
            'link_url' => 'http://us.weibo.com/gb',
            'link_order' => 2,
                ],

        ];
        DB::table('links')->insert($data);
    }
}
