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
         		'link_name' => '北邮人论坛',
         		'link_title' => '北邮人家园',
				'link_url' => 'https://bbs.byr.cn/#!default',
				'link_order' => 1,
			],
			[
         		'link_name' => '北邮人bt',
         		'link_title' => '北邮人数据',
				'link_url' => 'http://bt.byr.cn/torrents.php',
				'link_order' => 2,
			]
     	];

        DB::table('links')->insert($data);
    }
}
