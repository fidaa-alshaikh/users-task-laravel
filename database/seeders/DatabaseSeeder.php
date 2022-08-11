<?php

namespace Database\Seeders;

use App\Models\City;
use App\Models\State;
use App\Models\Country;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        //COUNTRIES
        $countries = array(
            array('id' => 1, 'name' => "Saudi Arabia"),
            // array('id' => 2, 'name' => "Bahrain"),
            // array('id' => 3,'name' => "United Arab Emirates"),
            // array('id' => 4, 'name' => "Kuwait"),
            // array('id' => 5,'name' => "Oman",),
            // array('id' => 6, 'name' => "Qatar"),

        );
        Country::insert($countries);

        //STATES

        $states = array(
            //Saudi Arabia states
            array('id' => 1, 'name' => "Makkah", 'country_id' => 1),
            array('id' => 2, 'name' => "Ar Riyad", 'country_id' => 1),
            array('id' => 3, 'name' => "Hail", 'country_id' => 1),
            array('id' => 4, 'name' => "Al Hudud Ash Shamaliyah", 'country_id' => 1),
            array('id' => 5, 'name' => "Jazan", 'country_id' => 1),
            array('id' => 6, 'name' => "Ash Sharqiyah", 'country_id' => 1),
            array('id' => 7, 'name' => "Al Madinah", 'country_id' => 1),
            array('id' => 8, 'name' => "Qasim", 'country_id' => 1),
            array('id' => 9, 'name' => "Al Bahah", 'country_id' => 1),
            array('id' => 10, 'name' => "Tabuk", 'country_id' => 1),
            array('id' => 11, 'name' => "Jawf", 'country_id' => 1),
            array('id' => 12, 'name' => "Asir", 'country_id' => 1),
            array('id' => 13, 'name' => "Najran", 'country_id' => 1),
            // //Bahrain states
            // array('name' => "'Isa",'country_id' => 17),
            // array('name' => "Badiyah",'country_id' => 17),
            // array('name' => "Hidd",'country_id' => 17),
            // array('name' => "Jidd Hafs",'country_id' => 17),
            // array('name' => "Mahama",'country_id' => 17),
            // array('name' => "Manama",'country_id' => 17),
            // array('name' => "Sitrah",'country_id' => 17),
            // array('name' => "al-Manamah",'country_id' => 17),
            // array('name' => "al-Muharraq",'country_id' => 17),
            // array('name' => "ar-Rifa'a",'country_id' => 17),

            // //UAE states
            // array('name' => "Abu Zabi",'country_id' => 229),
            // array('name' => "Ajman",'country_id' => 229),
            // array('name' => "Dubai",'country_id' => 229),
            // array('name' => "Ras al-Khaymah",'country_id' => 229),
            // array('name' => "Sharjah",'country_id' => 229),
            // array('name' => "Sharjha",'country_id' => 229),
            // array('name' => "Umm al Qaywayn",'country_id' => 229),
            // array('name' => "al-Fujayrah",'country_id' => 229),
            // array('name' => "ash-Shariqah",'country_id' => 229),

            // //Kuwait states
            // array('name' => "Al Asimah",'country_id' => 117),
            // array('name' => "Hawalli",'country_id' => 117),
            // array('name' => "Mishref",'country_id' => 117),
            // array('name' => "Qadesiya",'country_id' => 117),
            // array('name' => "Safat",'country_id' => 117),
            // array('name' => "Salmiya",'country_id' => 117),
            // array('name' => "al-Ahmadi",'country_id' => 117),
            // array('name' => "al-Farwaniyah",'country_id' => 117),
            // array('name' => "al-Jahra",'country_id' => 117),
            // array('name' => "al-Kuwayt",'country_id' => 117),

            // //Oman states
            // array('name' => "Al Buraimi",'country_id' => 165),
            // array('name' => "Dhufar",'country_id' => 165),
            // array('name' => "Masqat",'country_id' => 165),
            // array('name' => "Musandam",'country_id' => 165),
            // array('name' => "Rusayl",'country_id' => 165),
            // array('name' => "Wadi Kabir",'country_id' => 165),
            // array('name' => "ad-Dakhiliyah",'country_id' => 165),
            // array('name' => "adh-Dhahirah",'country_id' => 165),
            // array('name' => "al-Batinah",'country_id' => 165),
            // array('name' => "ash-Sharqiyah",'country_id' => 165),

            // //Qatar states
            // array('name' => "Doha",'country_id' => 178),
            // array('name' => "Jarian-al-Batnah",'country_id' => 178),
            // array('name' => "Umm Salal",'country_id' => 178),
            // array('name' => "ad-Dawhah",'country_id' => 178),
            // array('name' => "al-Ghuwayriyah",'country_id' => 178),
            // array('name' => "al-Jumayliyah",'country_id' => 178),
            // array('name' => "al-Khawr",'country_id' => 178),
            // array('name' => "al-Wakrah",'country_id' => 178),
            // array('name' => "ar-Rayyan",'country_id' => 178),
            // array('name' => "ash-Shamal",'country_id' => 178),

        );
        State::insert($states);

        //CITIES
        $cities = array(
            array('id' => 1, 'name' => "Mecca", 'state_id' => 1),
            array('id' => 2, 'name' => "Jeddah", 'state_id' => 1),
            array('id' => 3, 'name' => "Al Taif", 'state_id' => 1),
            array('id' => 4, 'name' => "Riyadh", 'state_id' => 2),
            array('id' => 5, 'name' => "Al Hillah", 'state_id' => 2),
            array('id' => 6, 'name' => "Al Kharj", 'state_id' => 2),
            array('id' => 7, 'name' => "Hail", 'state_id' => 3),
            array('id' => 8, 'name' => "Arar", 'state_id' => 4),
            array('id' => 9, 'name' => "Jazan", 'state_id' => 5),
            array('id' => 10, 'name' => "Al Dammam", 'state_id' => 6),
            array('id' => 11, 'name' => "Al Hufuf", 'state_id' => 6),
            array('id' => 12, 'name' => "Al Qatif", 'state_id' => 6),
            array('id' => 13, 'name' => "Al Mubarraz", 'state_id' => 6),
            array('id' => 14, 'name' => "Medina", 'state_id' => 7),
            array('id' => 15, 'name' => "Yanbu", 'state_id' => 7),
            array('id' => 16, 'name' => "Buraydah", 'state_id' => 8),
            array('id' => 17, 'name' => "Al Bahah", 'state_id' => 9),
            array('id' => 18, 'name' => "Tabuk", 'state_id' => 10),
            array('id' => 19, 'name' => "Sakaka", 'state_id' => 11),
            array('id' => 20, 'name' => "Khamis Mushayt", 'state_id' => 12),
            array('id' => 21, 'name' => "Abha", 'state_id' => 12),
            array('id' => 22, 'name' => "Najran", 'state_id' => 13),

        );
        City::insert($cities);


    }
}
