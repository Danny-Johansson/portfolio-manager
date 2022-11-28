<?php

namespace Database\Seeders;

use App\Models\Permission;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $items = [
            ['name' => 'languages_index'],
            ['name' => 'languages_deleted'],
            ['name' => 'languages_create'],
            ['name' => 'languages_view'],
            ['name' => 'languages_update'],
            ['name' => 'languages_delete'],
            ['name' => 'languages_delete_force'],
            ['name' => 'languages_restore'],

            ['name' => 'languageLevels_index'],
            ['name' => 'languageLevels_deleted'],
            ['name' => 'languageLevels_create'],
            ['name' => 'languageLevels_view'],
            ['name' => 'languageLevels_update'],
            ['name' => 'languageLevels_delete'],
            ['name' => 'languageLevels_delete_force'],
            ['name' => 'languageLevels_restore'],

            ['name' => 'demonstrations_index'],
            ['name' => 'demonstrations_deleted'],
            ['name' => 'demonstrations_create'],
            ['name' => 'demonstrations_view'],
            ['name' => 'demonstrations_update'],
            ['name' => 'demonstrations_delete'],
            ['name' => 'demonstrations_delete_force'],
            ['name' => 'demonstrations_restore'],

            ['name' => 'demonstrationTypes_index'],
            ['name' => 'demonstrationTypes_deleted'],
            ['name' => 'demonstrationTypes_create'],
            ['name' => 'demonstrationTypes_view'],
            ['name' => 'demonstrationTypes_update'],
            ['name' => 'demonstrationTypes_delete'],
            ['name' => 'demonstrationTypes_delete_force'],
            ['name' => 'demonstrationTypes_restore'],

            ['name' => 'experiences_index'],
            ['name' => 'experiences_deleted'],
            ['name' => 'experiences_create'],
            ['name' => 'experiences_view'],
            ['name' => 'experiences_update'],
            ['name' => 'experiences_delete'],
            ['name' => 'experiences_delete_force'],
            ['name' => 'experiences_restore'],

            ['name' => 'experienceTypes_index'],
            ['name' => 'experienceTypes_deleted'],
            ['name' => 'experienceTypes_create'],
            ['name' => 'experienceTypes_view'],
            ['name' => 'experienceTypes_update'],
            ['name' => 'experienceTypes_delete'],
            ['name' => 'experienceTypes_delete_force'],
            ['name' => 'experienceTypes_restore'],

            ['name' => 'projects_index'],
            ['name' => 'projects_deleted'],
            ['name' => 'projects_create'],
            ['name' => 'projects_view'],
            ['name' => 'projects_update'],
            ['name' => 'projects_delete'],
            ['name' => 'projects_delete_force'],
            ['name' => 'projects_restore'],

            ['name' => 'jobsearches_index'],
            ['name' => 'jobsearches_deleted'],
            ['name' => 'jobsearches_create'],
            ['name' => 'jobsearches_view'],
            ['name' => 'jobsearches_update'],
            ['name' => 'jobsearches_delete'],
            ['name' => 'jobsearches_delete_force'],
            ['name' => 'jobsearches_restore'],

            ['name' => 'jobsearchStatuses_index'],
            ['name' => 'jobsearchStatuses_deleted'],
            ['name' => 'jobsearchStatuses_create'],
            ['name' => 'jobsearchStatuses_view'],
            ['name' => 'jobsearchStatuses_update'],
            ['name' => 'jobsearchStatuses_delete'],
            ['name' => 'jobsearchStatuses_delete_force'],
            ['name' => 'jobsearchStatuses_restore'],

            ['name' => 'jobsearchTypes_index'],
            ['name' => 'jobsearchTypes_deleted'],
            ['name' => 'jobsearchTypes_create'],
            ['name' => 'jobsearchTypes_view'],
            ['name' => 'jobsearchTypes_update'],
            ['name' => 'jobsearchTypes_delete'],
            ['name' => 'jobsearchTypes_delete_force'],
            ['name' => 'jobsearchTypes_restore'],

            ['name' => 'skills_index'],
            ['name' => 'skills_deleted'],
            ['name' => 'skills_create'],
            ['name' => 'skills_view'],
            ['name' => 'skills_update'],
            ['name' => 'skills_delete'],
            ['name' => 'skills_delete_force'],
            ['name' => 'skills_restore'],

            ['name' => 'skillLevels_index'],
            ['name' => 'skillLevels_deleted'],
            ['name' => 'skillLevels_create'],
            ['name' => 'skillLevels_view'],
            ['name' => 'skillLevels_update'],
            ['name' => 'skillLevels_delete'],
            ['name' => 'skillLevels_delete_force'],
            ['name' => 'skillLevels_restore'],

            ['name' => 'tags_index'],
            ['name' => 'tags_deleted'],
            ['name' => 'tags_create'],
            ['name' => 'tags_view'],
            ['name' => 'tags_update'],
            ['name' => 'tags_delete'],
            ['name' => 'tags_delete_force'],
            ['name' => 'tags_restore'],

            ['name' => 'tagCategories_index'],
            ['name' => 'tagCategories_deleted'],
            ['name' => 'tagCategories_create'],
            ['name' => 'tagCategories_view'],
            ['name' => 'tagCategories_update'],
            ['name' => 'tagCategories_delete'],
            ['name' => 'tagCategories_delete_force'],
            ['name' => 'tagCategories_restore'],

            ['name' => 'socials_index'],
            ['name' => 'socials_deleted'],
            ['name' => 'socials_create'],
            ['name' => 'socials_view'],
            ['name' => 'socials_update'],
            ['name' => 'socials_delete'],
            ['name' => 'socials_delete_force'],
            ['name' => 'socials_restore'],


            ['name' => 'certificates_index'],
            ['name' => 'certificates_deleted'],
            ['name' => 'certificates_create'],
            ['name' => 'certificates_view'],
            ['name' => 'certificates_update'],
            ['name' => 'certificates_delete'],
            ['name' => 'certificates_delete_force'],
            ['name' => 'certificates_restore'],

            ['name' => 'certificateIssuers_index'],
            ['name' => 'certificateIssuers_deleted'],
            ['name' => 'certificateIssuers_create'],
            ['name' => 'certificateIssuers_view'],
            ['name' => 'certificateIssuers_update'],
            ['name' => 'certificateIssuers_delete'],
            ['name' => 'certificateIssuers_delete_force'],
            ['name' => 'certificateIssuers_restore'],

            ['name' => 'roles_index'],
            ['name' => 'roles_deleted'],
            ['name' => 'roles_create'],
            ['name' => 'roles_view'],
            ['name' => 'roles_update'],
            ['name' => 'roles_delete'],
            ['name' => 'roles_delete_force'],
            ['name' => 'roles_restore'],

            ['name' => 'users_index'],
            ['name' => 'users_deleted'],
            ['name' => 'users_create'],
            ['name' => 'users_view'],
            ['name' => 'users_update'],
            ['name' => 'users_delete'],
            ['name' => 'users_delete_force'],
            ['name' => 'users_restore'],

            ['name' => 'owner_index'],
            ['name' => 'owner_update'],

        ];
        foreach ($items as $item) {
            Permission::create($item);
        }
    }
}
