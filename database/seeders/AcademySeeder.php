<?php

namespace Database\Seeders;

use App\Models\Academy;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AcademySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $academies = [
            'BackEnd Development' => 'BackEnd Developer',
            'FrontEnd Development' => 'Frond End Developer',
            'Marketing' => 'Marketer',
            'Data Science' => 'Data Scientist',
            'Design' => 'Designer',
            'QA' => 'QA Tester',
            'UI/UX'=> 'UI/UX Designer',
        ];
        foreach ($academies as $key=>$value) {
            Academy::create([
                'name' => $key,
                'display_name'=>$value
            ]);

        }
    }
}
