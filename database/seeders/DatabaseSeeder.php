<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
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
        $this->call([
            PermissionSeeder::class,
            RoleSeeder::class,
            UserSeeder::class,
            ProjectFeatureSeeder::class,
            ProjectSeeder::class,
            DemonstrationTypeSeeder::class,
            DemonstrationSeeder::class,
            OwnerSeeder::class,
            SkillSeeder::class,
            SocialSeeder::class,
            LanguageLevelSeeder::class,
            LanguageSeeder::class,
            TagCategorySeeder::class,
            TagSeeder::class,
            ExperienceTypeSeeder::class,
            ExperienceSeeder::class,
        ]);
    }
}
