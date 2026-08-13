<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class TranslationSeeder extends Seeder
{
    public function run(): void
    {
        $translations = [
            ['id' => 1, 'translation' => '{"en":"More","ar":"المزيد"}', 'key' => 'More', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['id' => 2, 'translation' => '{"en":"Skip to content","ar":"تخطي إلى المحتوى"}', 'key' => 'Skip to content', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['id' => 3, 'translation' => '{"en":"English","ar":"الإنجليزية"}', 'key' => 'languages.en', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['id' => 4, 'translation' => '{"en":"Arabic","ar":"العربية"}', 'key' => 'languages.ar', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['id' => 5, 'translation' => '{"en":"Search","ar":"بحث"}', 'key' => 'Search', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['id' => 6, 'translation' => '{"en":"Thank you","ar":"شكرًا لك"}', 'key' => 'message when contact form is sent', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['id' => 7, 'translation' => '{"en":"Thank you","ar":"شكرًا لك"}', 'key' => 'event registration message', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['id' => 8, 'translation' => '{"en":"Add to calendar","ar":"أضف إلى التقويم"}', 'key' => 'Add to calendar', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['id' => 9, 'translation' => '{"en":"All news","ar":"كل الأخبار"}', 'key' => 'All news', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['id' => 10, 'translation' => '{"en":"All events","ar":"كل الفعاليات"}', 'key' => 'All events', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['id' => 11, 'translation' => '{"en":"Partners","ar":"الشركاء"}', 'key' => 'Partners', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['id' => 12, 'translation' => '{"en":"Latest news","ar":"آخر الأخبار"}', 'key' => 'Latest news', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['id' => 13, 'translation' => '{"en":"Upcoming events","ar":"الفعاليات القادمة"}', 'key' => 'Upcoming events', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['id' => 14, 'translation' => '{"en":"Error :code","ar":"خطأ :code"}', 'key' => 'Error :code', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['id' => 15, 'translation' => '{"en":"Sorry, you are not authorized to view this page.","ar":"عذرًا، لست مخولًا لعرض هذه الصفحة."}', 'key' => 'Sorry, you are not authorized to view this page.', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['id' => 16, 'translation' => '{"en":"Go to our homepage?","ar":"هل تريد الانتقال إلى صفحتنا الرئيسية؟"}', 'key' => 'Go to our homepage?', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['id' => 17, 'translation' => '{"en":"Sorry, this page was not found.","ar":"عذرًا، لم يتم العثور على هذه الصفحة."}', 'key' => 'Sorry, this page was not found.', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['id' => 18, 'translation' => '{"en":"Sorry, a server error occurred.","ar":"عذرًا، حدث خطأ في الخادم."}', 'key' => 'Sorry, a server error occurred', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['id' => 19, 'translation' => '{"en":"Open navigation","ar":"فتح التنقل"}', 'key' => 'Open navigation', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['id' => 20, 'translation' => '{"en":"Please correct the errors below.","ar":"يرجى تصحيح الأخطاء أدناه."}', 'key' => 'message on form error', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
        ];

        DB::table('translations')->insert($translations);
    }
}
