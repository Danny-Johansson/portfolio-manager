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
    public function run(): void
    {
        $this->call([
            PermissionSeeder::class,
            RoleSeeder::class,
            UserSeeder::class,
            TagCategorySeeder::class,
            TagSeeder::class,
            FeatureSeeder::class,
            ProjectSeeder::class,
            DemonstrationTypeSeeder::class,
            DemonstrationModeSeeder::class,
            DemonstrationSeeder::class,
            OwnerSeeder::class,
            SkillLevelSeeder::class,
            SkillSeeder::class,
            SocialSeeder::class,
            LanguageLevelSeeder::class,
            LanguageSeeder::class,
            ExperienceTypeSeeder::class,
            ExperienceSeeder::class,
            JobsearchTypeSeeder::class,
            JobsearchStatusSeeder::class,
            JobsearchSeeder::class,
            CertificateIssuerSeeder::class,
            CertificateSeeder::class,
        ]);
    }
}
