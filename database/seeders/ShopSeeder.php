<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ShopSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $jsonShop = [
            [
                'owner' => 'យស ឧត្តម',
                'shop_name' => 'Yours Oudom (TKN)',
                'abbreviation' => 'TKN',
                'shop_name_translate' => 'ឧត្តម (ត្រាំខ្នារ)',
                'phone' => '016 967 956',
                'telephone' => '069 990 024/ 089 990 024',
                'facebook_page' => 'ហាងបង់រំលស់ម៉ូតូ 121 ត្រាំខ្នារ'
            ], [
                'owner' => 'អ៊ុន លីកា',
                'shop_name' => 'Li Ka (KTL)',
                'abbreviation' => 'KTL',
                'shop_name_translate' => 'លីកា (កំពង់ត្រឡាច)',
                'phone' => '097 666 6338',
                'telephone' => '069 991 156/ 089 991 156',
                'facebook_page' => 'ហាងបង់រំលស់ម៉ូតូ 121 កំពង់ត្រឡាច'
            ], [
                'owner' => 'ជួន ចាន់ដារ៉ា',
                'shop_name' => 'Mean Chey',
                'abbreviation' => 'MC',
                'shop_name_translate' => 'មានជ័យ (598)',
                'phone' => '097 666 6338',
                'telephone' => '069 992 284',
                'facebook_page' => 'ហាងបង់រំលស់ម៉ូតូ 121 កំពង់ត្រឡាច'
            ], [
                'owner' => 'ជួន ចាន់ដារ៉ា',
                'shop_name' => 'Mean Leap',
                'abbreviation' => 'ML',
                'shop_name_translate' => 'មានលាភ (តាខ្មៅ)',
                'phone' => '097 666 6338',
                'telephone' => '097 666 6338 / 081 574 444',
                'facebook_page' => 'ហាងបង់រំលស់ម៉ូតូ 121 កំពង់ត្រឡាច'
            ], [
                'owner' => 'អឿន ស៊ីឡែន',
                'shop_name' => 'Ang Snuol',
                'abbreviation' => 'ASN',
                'shop_name_translate' => 'អង្គស្នួល',
                'phone' => '097 666 6338',
                'telephone' => '097 666 6338 / 081 574 444',
                'facebook_page' => 'ហាងបង់រំលស់ម៉ូតូ 121 កំពង់ត្រឡាច'
            ], [
                'owner' => 'អឿន ស៊ីឡែន',
                'shop_name' => 'Ang Snuol',
                'abbreviation' => 'ASN',
                'shop_name_translate' => 'អង្គស្នួល',
                'phone' => '070 736 070',
                'telephone' => '069 992 204/ 089 992 204',
                'facebook_page' => 'ហាងបង់រំលស់ម៉ូតូ 121 អង្គស្នួល'
            ], [
                'owner' => 'កន កណ្ណិកា',
                'shop_name' => 'Samrong Yoang',
                'abbreviation' => 'SRY',
                'shop_name_translate' => 'សំរោងយ៉ោង',
                'phone' => '016 967 956/ 070 367 949',
                'telephone' => '069 995 504/ 089 700 759',
                'facebook_page' => 'ហាងបង់រំលស់ម៉ូតូ 121 អង្គស្នួល'
            ], [
                'owner' => 'ជួន ចាន់ដារ៉ា',
                'shop_name' => 'Kien Svey',
                'abbreviation' => 'KSV',
                'shop_name_translate' =>  'កៀនស្វាយ',
                'phone' => '097 666 6338',
                'telephone' => '069 990 42/ 089 990 042',
                'facebook_page' => 'ហាងបង់រំលស់ម៉ូតូ 121 កៀនស្វាយ'
            ], [
                'owner' => '',
                'shop_name' => 'Ang Tasoam',
                'abbreviation' => 'SRY',
                'shop_name_translate' => 'ហាងលក់ម៉ូតូអង្គតាសោម',
                'phone' => ' 069 993 304 / 089 993 304 ',
                'telephone' => '',
                'facebook_page' => ''
            ], [
                'owner' => '',
                'shop_name' => 'Udong',
                'abbreviation' => 'SRY',
                'shop_name_translate' => 'ហាងលក់ម៉ូតូឧត្តុង្គ',
                'phone' => '069 997 742 / 089 203 646',
                'telephone' => '',
                'facebook_page' => ''
            ], [
                'owner' => '',
                'shop_name' => '121 Skun',
                'abbreviation' => 'SRY',
                'shop_name_translate' => 'ហាងលក់ម៉ូតូ121ស្គន់',
                'phone' => '069 99 33 14 / 089 357 997',
                'telephone' => '',
                'facebook_page' => ''
            ], [
                'owner' => '',
                'shop_name' => 'Krong Kampong Cham',
                'abbreviation' => 'SRY',
                'shop_name_translate' => 'ហាងលក់ម៉ូតូក្រុងកំពង់ចាម',
                'phone' => '098 39 23 36 / 077 53 51 68',
                'telephone' => '',
                'facebook_page' => ''
            ], [
                'owner' => '',
                'shop_name' => 'Prek Tammeak',
                'abbreviation' => 'SRY',
                'shop_name_translate' => 'ហាងលក់ម៉ូតូព្រែកតាមាក់',
                'phone' => '089 93 79 33 /069 99 00 32',
                'telephone' => '',
                'facebook_page' => ''
            ], [
                'owner' => '',
                'shop_name' => 'Keo Ly (Kor Anderk)',
                'abbreviation' => 'SRY',
                'shop_name_translate' => 'ហាងលក់ម៉ូតូកែវ លី (ករអណ្ដើក)',
                'phone' => '096 298 78 98 / 066 987 898',
                'telephone' => '',
                'facebook_page' => ''
            ], [
                'owner' => '',
                'shop_name' => 'Keo Ly (Svay Rieng)',
                'abbreviation' => 'SRY',
                'shop_name_translate' => 'ហាងលក់ម៉ូតូកែវ លី (ស្វាយរៀង)',
                'phone' => '097 34 22 225 /096 298 7898',
                'telephone' => '',
                'facebook_page' => ''
            ], [
                'owner' => '',
                'shop_name' => 'Rithiya (Svay Antor)',
                'abbreviation' => 'SRY',
                'shop_name_translate' => 'ហាងលក់ម៉ូតូរិទ្ធីយ្យា (ស្វាយអន្ទរ)',
                'phone' => ' 069 99 00 81/ 012 40 40 81 ',
                'telephone' => '',
                'facebook_page' => ''
            ], [
                'owner' => '',
                'shop_name' => 'Kanha Kampong Chhnang',
                'abbreviation' => 'SRY',
                'shop_name_translate' => 'ហាងលក់ម៉ូតូ កញ្ញាកំពង់ឆ្នាំង',
                'phone' => '087 800 219 / 068 717 300',
                'telephone' => '',
                'facebook_page' => ''
            ], [
                'owner' => '',
                'shop_name' => 'Dara Battambang',
                'abbreviation' => 'SRY',
                'shop_name_translate' => 'ហាងលក់ម៉ូតូ ដារ៉ា បាត់ដំបង',
                'phone' => ' 098 76 76 41/ 070 31 11 21 ',
                'telephone' => '',
                'facebook_page' => ''
            ], [
                'owner' => '',
                'shop_name' => 'Sopharoth',
                'abbreviation' => 'SRY',
                'shop_name_translate' => 'ហាងលក់ម៉ូតូ សុផារ័ត្ន',
                'phone' => '093 838 351 / 070 311 121',
                'telephone' => '',
                'facebook_page' => ''
            ], [
                'owner' => '',
                'shop_name' => 'Sindy Samrong',
                'abbreviation' => 'SRY',
                'shop_name_translate' => 'ហាងលក់ម៉ូតូ ស៊ីនឌី សំរោង',
                'phone' => '093 78 78 62 / 070 31 11 21',
                'telephone' => '',
                'facebook_page' => ''
            ], [
                'owner' => '',
                'shop_name' => 'Virak Anlong Veng',
                'abbreviation' => 'SRY',
                'shop_name_translate' => 'ហាងលក់ម៉ូតូ វីរៈ អន្លង់វែង',
                'phone' => '070 31 11 21 / 093 92 92 17',
                'telephone' => '',
                'facebook_page' => ''
            ], [
                'owner' => '',
                'shop_name' => 'Vathana Siem Reap Kanton',
                'abbreviation' => 'SRY',
                'shop_name_translate' => 'ហាងលក់ម៉ូតូ វឌ្ឍនា សៀមរាប កន្ទួត',
                'phone' => '070 611 177 / 066 611 177/ 017 832 121',
                'telephone' => '',
                'facebook_page' => ''
            ], [
                'owner' => '',
                'shop_name' => 'Thida Prey Kabbas',
                'abbreviation' => 'SRY',
                'shop_name_translate' => 'ហាងលក់ម៉ូតូ ធីតា ព្រៃកប្បាស',
                'phone' => '070 611 177 / 066 611 177/ 017 832 121',
                'telephone' => '',
                'facebook_page' => ''
            ], [
                'owner' => '',
                'shop_name' => 'Thida Prey Kabbas',
                'abbreviation' => 'SRY',
                'shop_name_translate' => 'ហាងលក់ម៉ូតូ ធីតា ព្រៃកប្បាស',
                'phone' => ' 070 900 210 / 067 782 456 ',
                'telephone' => '',
                'facebook_page' => ''
            ], [
                'owner' => '',
                'shop_name' => 'Udom Tramknar',
                'abbreviation' => 'SRY',
                'shop_name_translate' => 'ហាងលក់ម៉ូតូ ឧត្តម (ត្រាំខ្នារ)',
                'phone' => ' 089 99 00 24 / 069 99 00 24 ',
                'telephone' => '',
                'facebook_page' => ''
            ], [
                'owner' => '',
                'shop_name' => 'Srey Leak',
                'abbreviation' => 'SRY',
                'shop_name_translate' => 'ហាងលក់ម៉ូតូ ស្រីល័ក្ខ',
                'phone' => '070 900 214 / 078 900 214',
                'telephone' => '',
                'facebook_page' => ''
            ], [
                'owner' => '',
                'shop_name' => 'Trapeang Kraloeng',
                'abbreviation' => 'SRY',
                'shop_name_translate' => 'ហាងលក់ម៉ូតូ ត្រពាំងក្រឡឹង',
                'phone' => '069 992 254 / 089 992 254',
                'telephone' => '',
                'facebook_page' => ''
            ], [
                'owner' => '',
                'shop_name' => 'Thida Prey Chhor',
                'abbreviation' => 'SRY',
                'shop_name_translate' => 'ហាងលក់ម៉ូតូ ធីតា ព្រៃឈរ',
                'phone' => ' 077 535 168/ 068 362 336 ',
                'telephone' => '',
                'facebook_page' => ''
            ], [
                'owner' => '',
                'shop_name' => 'Spean Kampong Thmar',
                'abbreviation' => 'SRY',
                'shop_name_translate' => 'ហាងលក់ម៉ូតូ ស្ពានកំពង់ថ្ម',
                'phone' => '087 900 214 / 092 900 214',
                'telephone' => '',
                'facebook_page' => ''
            ], [
                'owner' => '',
                'shop_name' => 'Kanthea Dina Chipo',
                'abbreviation' => 'SRY',
                'shop_name_translate' => 'ហាងលក់ម៉ូតូ គន្ធា ឌីណា ជីភូ',
                'phone' => ' 010 34 22 25 / 097 755 59 45 ',
                'telephone' => '',
                'facebook_page' => ''
            ], [
                'owner' => '',
                'shop_name' => 'Kien Svay',
                'abbreviation' => 'SRY',
                'shop_name_translate' => 'ហាងលក់ម៉ូតូ កៀនស្វាយ',
                'phone' => ' 069 99 00 42 / 089 99 00 42 ',
                'telephone' => '',
                'facebook_page' => ''
            ], [
                'owner' => '',
                'shop_name' => 'Pouhi Steng Trong',
                'abbreviation' => 'SRY',
                'shop_name_translate' => 'ហាងលក់ម៉ូតូ ប៉ោហ៊ីស្ទឹងត្រង់',
                'phone' => ' 087 800 231 / 068 71 70 76',
                'telephone' => '',
                'facebook_page' => ''
            ], [
                'owner' => '',
                'shop_name' => 'Sovann Touk Meas',
                'abbreviation' => 'SRY',
                'shop_name_translate' => 'ហាងលក់ម៉ូតូ សុវណ្ណទូកមាស',
                'phone' => '087 800 154 / 068 717 400',
                'telephone' => '',
                'facebook_page' => ''
            ], [
                'owner' => '',
                'shop_name' => 'Dany Poipet',
                'abbreviation' => 'SRY',
                'shop_name_translate' => 'ហាងលក់ម៉ូតូ ដានីប៉ោយប៉ែត',
                'phone' => '098 515 181 / 070 311 121',
                'telephone' => '',
                'facebook_page' => ''
            ], [
                'owner' => '',
                'shop_name' => 'Lida Angkor',
                'abbreviation' => 'SRY',
                'shop_name_translate' => 'ហាងលក់ម៉ូតូ លីដាអង្គរ',
                'phone' => ' 093 515 181 / 070 311 121 ',
                'telephone' => '',
                'facebook_page' => ''
            ], [
                'owner' => '',
                'shop_name' => 'Virak Bavel',
                'abbreviation' => 'SRY',
                'shop_name_translate' => 'ហាងលក់ម៉ូតូ វិរៈ បវេល',
                'phone' => '070 311 121 /  031 517 22 88',
                'telephone' => '',
                'facebook_page' => ''
            ], [
                'owner' => '',
                'shop_name' => 'Kamro',
                'abbreviation' => 'SRY',
                'shop_name_translate' => 'ហាងលក់ម៉ូតូ គំរូ',
                'phone' => '070 311 121/ 031 508 33 66',
                'telephone' => '',
                'facebook_page' => ''
            ]
        ];
        foreach ($jsonShop as $item) {
            DB::table('shops')->insert([
                'owner' => $item['owner'],
                'shop_name' => $item['shop_name'],
                'abbreviation' => $item['abbreviation'],
                'shop_name_translate' => $item['shop_name_translate'],
                'phone' => $item['phone'],
                'telephone' => $item['telephone'],
                'facebook_page' => $item['facebook_page']
            ]);
        }
    }
}
