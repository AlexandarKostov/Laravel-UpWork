<?php

namespace Database\Seeders;

use App\Models\Academy;
use App\Models\Skill;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SkillSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $skills = ['Data Analysis', 'Business Intelligence', 'Machine Learning', 'Data Visualizations', 'Deep Learning', 'Statistics', 'Python', 'Power Bi', 'NumPy', 'Keras', 'TensorFlow', 'Pandas', 'OpenCV', 'Writing and Executing Test Cases and Scenarios', 'Test Design', 'Translating Manual Test Cases Into Automation Scripts', 'Defect Reporting', 'Quality Assurance', 'Waterfall and SCRUM Methodology', 'Java', 'C#', 'Kiwi', 'Selenium Web Driver', 'Illustrator', 'Photoshop', 'InDesign', 'XD', 'LightRoom', 'Typography', 'Branding', 'Poster Design', 'Logo Design', 'Package Design', 'Digital Marketing Strategy', 'Social Media Marketing', 'Facebook & Instagram Ads', 'Google Ads', 'Copywriting', 'Content Marketing', 'Landing Pages', 'Lead Generation', 'E-mail Marketing', 'Search Engine Optimization', 'HTML', 'CSS', 'Bootstrap', 'JavaScript', 'jQuery', 'AJAX', 'PHP', 'Laravel', 'ReactJS', 'GIT', 'UX/UI', 'MySQL', 'InVision Studio', 'Figma', 'SQL', 'Data Warehouse', 'AWS Management Control', 'Big Data', 'Database Management', 'Postman', 'Apache', 'JMeter', 'Google Analytics'];
        foreach ($skills as $skill) {
            Skill::create([
                'name' => $skill
            ]);
        }
    }
}
