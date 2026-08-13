<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class MenuSeeder extends Seeder
{
    public function run(): void
    {
        $menus = [
            ['id' => 1, 'image_id' => null, 'name' => 'primary', 'class' => null, 'status' => '{"en": "1", "ar": "1"}', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['id' => 2, 'image_id' => null, 'name' => 'footer', 'class' => null, 'status' => '{"en": "1", "ar": "1"}', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['id' => 3, 'image_id' => null, 'name' => 'social', 'class' => null, 'status' => '{"en": "1", "ar": "1"}', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['id' => 4, 'image_id' => null, 'name' => 'legal', 'class' => null, 'status' => '{"en": 1, "ar": 1}', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
        ];
        $menulinks = [
            ['menu_id' => 1, 'page_id' => 1, 'parent_id' => null, 'image_id' => null, 'position' => 1, 'target' => null, 'class' => null, 'status' => '{"en": 1, "ar": 1}', 'description' => '{"en": null, "ar": null}', 'title' => '{"en": "Home", "ar": "الرئيسية"}', 'website' => '{"en": null, "ar": null}', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['menu_id' => 1, 'page_id' => 2, 'parent_id' => null, 'image_id' => null, 'position' => 2, 'target' => null, 'class' => null, 'status' => '{"en": 1, "ar": 1}', 'description' => '{"en": null, "ar": null}', 'title' => '{"en": "Contact", "ar": "اتصل بنا"}', 'website' => '{"en": null, "ar": null}', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['menu_id' => 2, 'page_id' => 2, 'parent_id' => null, 'image_id' => null, 'position' => 1, 'target' => null, 'class' => null, 'status' => '{"en": 1, "ar": 1}', 'description' => '{"en": null, "ar": null}', 'title' => '{"en": "Contact", "ar": "اتصل بنا"}', 'website' => '{"en": null, "ar": null}', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['menu_id' => 3, 'page_id' => null, 'parent_id' => null, 'image_id' => null, 'position' => 2, 'target' => '_blank', 'class' => 'btn-linkedin', 'status' => '{"en": 1, "ar": 1}', 'description' => '{"en": null, "ar": null}', 'title' => '{"en": "LinkedIn", "ar": "لينكدإن"}', 'website' => '{"en": "https://www.linkedin.com", "ar": "https://www.linkedin.com"}', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['menu_id' => 3, 'page_id' => null, 'parent_id' => null, 'image_id' => null, 'position' => 1, 'target' => '_blank', 'class' => 'btn-facebook', 'status' => '{"en": 1, "ar": 1}', 'description' => '{"en": null, "ar": null}', 'title' => '{"en": "Facebook", "ar": "فيسبوك"}', 'website' => '{"en": "https://www.facebook.com", "ar": "https://www.facebook.com"}', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['menu_id' => 3, 'page_id' => null, 'parent_id' => null, 'image_id' => null, 'position' => 4, 'target' => '_blank', 'class' => 'btn-instagram', 'status' => '{"en": 1, "ar": 1}', 'description' => '{"en": null, "ar": null}', 'title' => '{"en": "Instagram", "ar": "انستغرام"}', 'website' => '{"en": "https://www.instagram.com", "ar": "https://www.instagram.com"}', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['menu_id' => 3, 'page_id' => null, 'parent_id' => null, 'image_id' => null, 'position' => 5, 'target' => '_blank', 'class' => 'btn-youtube', 'status' => '{"en": 1, "ar": 1}', 'description' => '{"en": null, "ar": null}', 'title' => '{"en": "YouTube", "ar": "يوتيوب"}', 'website' => '{"en": "https://www.youtube.com", "ar": "https://www.youtube.com"}', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['menu_id' => 3, 'page_id' => null, 'parent_id' => null, 'image_id' => null, 'position' => 6, 'target' => '_blank', 'class' => 'btn-bluesky', 'status' => '{"en": 1, "ar": 1}', 'description' => '{"en": null, "ar": null}', 'title' => '{"en": "Bluesky", "ar": "بلو سكاي"}', 'website' => '{"en": "https://bsky.app", "ar": "https://bsky.app"}', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['menu_id' => 3, 'page_id' => null, 'parent_id' => null, 'image_id' => null, 'position' => 7, 'target' => '_blank', 'class' => 'btn-threads', 'status' => '{"en": 1, "ar": 1}', 'description' => '{"en": null, "ar": null}', 'title' => '{"en": "Threads", "ar": "ثريدز"}', 'website' => '{"en": "https://threads.com", "ar": "https://threads.com"}', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['menu_id' => 3, 'page_id' => null, 'parent_id' => null, 'image_id' => null, 'position' => 8, 'target' => '_blank', 'class' => 'btn-x', 'status' => '{"en": 1, "ar": 1}', 'description' => '{"en": null, "ar": null}', 'title' => '{"en": "X", "ar": "إكس"}', 'website' => '{"en": "https://x.com", "ar": "https://x.com"}', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['menu_id' => 4, 'page_id' => 4, 'parent_id' => null, 'image_id' => null, 'position' => 0, 'target' => null, 'class' => null, 'status' => '{"en": 1, "ar": 1}', 'description' => '{"en": null, "ar": null}', 'title' => '{"en": "Terms and conditions", "ar": "الشروط والأحكام"}', 'website' => '{"en": null, "ar": null}', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['menu_id' => 4, 'page_id' => 5, 'parent_id' => null, 'image_id' => null, 'position' => 0, 'target' => null, 'class' => null, 'status' => '{"en": 1, "ar": 1}', 'description' => '{"en": null, "ar": null}', 'title' => '{"en": "Privacy policy", "ar": "سياسة الخصوصية"}', 'website' => '{"en": null, "ar": null}', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['menu_id' => 4, 'page_id' => 6, 'parent_id' => null, 'image_id' => null, 'position' => 0, 'target' => null, 'class' => null, 'status' => '{"en": 1, "ar": 1}', 'description' => '{"en": null, "ar": null}', 'title' => '{"en": "Cookie policy", "ar": "سياسة ملفات الارتباط"}', 'website' => '{"en": null, "ar": null}', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
        ];

        DB::table('menus')->insert($menus);
        DB::table('menulinks')->insert($menulinks);
    }
}
