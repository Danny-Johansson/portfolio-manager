<?php

namespace App\Providers;

use App\Policies\CertificateIssuerPolicy;
use App\Policies\CerificatePolicy;
use App\Policies\DemonstrationModePolicy;
use App\Policies\DemonstrationPolicy;
use App\Policies\DemonstrationTypePolicy;
use App\Policies\ExperiencePolicy;
use App\Policies\ExperienceTypePolicy;
use App\Policies\FeaturePolicy;
use App\Policies\JobsearchPolicy;
use App\Policies\JobsearchStatusPolicy;
use App\Policies\JobsearchTypePolicy;
use App\Policies\LanguageLevelPolicy;
use App\Policies\LanguagePolicy;
use App\Policies\OwnerPolicy;
use App\Policies\ProjectPolicy;
use App\Policies\RolePolicy;
use App\Policies\SkillLevelPolicy;
use App\Policies\SkillPolicy;
use App\Policies\SocialPolicy;
use App\Policies\TagCategoryPolicy;
use App\Policies\TagPolicy;
use App\Policies\UserPolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [

    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot(): void
    {
        $this->registerPolicies();

        /*
         * System Related
         */

        // Users
        Gate::define('users_index', [UserPolicy::class,'index']);
        Gate::define('users_deleted', [UserPolicy::class,'deleted']);
        Gate::define('users_create', [UserPolicy::class,'create']);
        Gate::define('users_update', [UserPolicy::class,'update']);
        Gate::define('users_delete', [UserPolicy::class,'delete']);
        Gate::define('users_deleteForce', [UserPolicy::class,'delete_force']);
        Gate::define('users_restore', [UserPolicy::class,'restore']);

        // Roles
        Gate::define('roles_index', [RolePolicy::class,'index']);
        Gate::define('roles_deleted', [RolePolicy::class,'deleted']);
        Gate::define('roles_create', [RolePolicy::class,'create']);
        Gate::define('roles_update', [RolePolicy::class,'update']);
        Gate::define('roles_delete', [RolePolicy::class,'delete']);
        Gate::define('roles_deleteForce', [RolePolicy::class,'delete_force']);
        Gate::define('roles_restore', [RolePolicy::class,'restore']);

        /*
         * Portfolio Related
         */

        // Tag Categories
        Gate::define('tagCategories_index', [TagCategoryPolicy::class,'index']);
        Gate::define('tagCategories_deleted', [TagCategoryPolicy::class,'deleted']);
        Gate::define('tagCategories_create', [TagCategoryPolicy::class,'create']);
        Gate::define('tagCategories_update', [TagCategoryPolicy::class,'update']);
        Gate::define('tagCategories_delete', [TagCategoryPolicy::class,'delete']);
        Gate::define('tagCategories_deleteForce', [TagCategoryPolicy::class,'delete_force']);
        Gate::define('tagCategories_restore', [TagCategoryPolicy::class,'restore']);

        // Tags
        Gate::define('tags_index', [TagPolicy::class,'index']);
        Gate::define('tags_deleted', [TagPolicy::class,'deleted']);
        Gate::define('tags_create', [TagPolicy::class,'create']);
        Gate::define('tags_update', [TagPolicy::class,'update']);
        Gate::define('tags_delete', [TagPolicy::class,'delete']);
        Gate::define('tags_deleteForce', [TagPolicy::class,'delete_force']);
        Gate::define('tags_restore', [TagPolicy::class,'restore']);

        // Projects
        Gate::define('projects_index', [ProjectPolicy::class,'index']);
        Gate::define('projects_deleted', [ProjectPolicy::class,'deleted']);
        Gate::define('projects_create', [ProjectPolicy::class,'create']);
        Gate::define('projects_update', [ProjectPolicy::class,'update']);
        Gate::define('projects_delete', [ProjectPolicy::class,'delete']);
        Gate::define('projects_deleteForce', [ProjectPolicy::class,'delete_force']);
        Gate::define('projects_restore', [ProjectPolicy::class,'restore']);

        // Demonstration Modes
        Gate::define('demonstrationModes_index', [DemonstrationModePolicy::class,'index']);
        Gate::define('demonstrationModes_deleted', [DemonstrationModePolicy::class,'deleted']);
        Gate::define('demonstrationModes_create', [DemonstrationModePolicy::class,'create']);
        Gate::define('demonstrationModes_update', [DemonstrationModePolicy::class,'update']);
        Gate::define('demonstrationModes_delete', [DemonstrationModePolicy::class,'delete']);
        Gate::define('demonstrationModes_deleteForce', [DemonstrationModePolicy::class,'delete_force']);
        Gate::define('demonstrationModes_restore', [DemonstrationModePolicy::class,'restore']);

        // Demonstration Types
        Gate::define('demonstrationTypes_index', [DemonstrationTypePolicy::class,'index']);
        Gate::define('demonstrationTypes_deleted', [DemonstrationTypePolicy::class,'deleted']);
        Gate::define('demonstrationTypes_create', [DemonstrationTypePolicy::class,'create']);
        Gate::define('demonstrationTypes_update', [DemonstrationTypePolicy::class,'update']);
        Gate::define('demonstrationTypes_delete', [DemonstrationTypePolicy::class,'delete']);
        Gate::define('demonstrationTypes_deleteForce', [DemonstrationTypePolicy::class,'delete_force']);
        Gate::define('demonstrationTypes_restore', [DemonstrationTypePolicy::class,'restore']);

        // Demonstrations
        Gate::define('demonstrations_index', [DemonstrationPolicy::class,'index']);
        Gate::define('demonstrations_deleted', [DemonstrationPolicy::class,'deleted']);
        Gate::define('demonstrations_create', [DemonstrationPolicy::class,'create']);
        Gate::define('demonstrations_update', [DemonstrationPolicy::class,'update']);
        Gate::define('demonstrations_delete', [DemonstrationPolicy::class,'delete']);
        Gate::define('demonstrations_deleteForce', [DemonstrationPolicy::class,'delete_force']);
        Gate::define('demonstrations_restore', [DemonstrationPolicy::class,'restore']);

        // Features
        Gate::define('features_index', [FeaturePolicy::class,'index']);
        Gate::define('features_deleted', [FeaturePolicy::class,'deleted']);
        Gate::define('features_create', [FeaturePolicy::class,'create']);
        Gate::define('features_update', [FeaturePolicy::class,'update']);
        Gate::define('features_delete', [FeaturePolicy::class,'delete']);
        Gate::define('features_deleteForce', [FeaturePolicy::class,'delete_force']);
        Gate::define('features_restore', [FeaturePolicy::class,'restore']);

        /*
         * Resume Related
         */

        // Owner
        Gate::define('owner_index', [OwnerPolicy::class,'index']);
        Gate::define('owner_update', [OwnerPolicy::class,'update']);

        // Skill Levels
        Gate::define('skillLevels_index', [SkillLevelPolicy::class,'index']);
        Gate::define('skillLevels_deleted', [SkillLevelPolicy::class,'deleted']);
        Gate::define('skillLevels_create', [SkillLevelPolicy::class,'create']);
        Gate::define('skillLevels_update', [SkillLevelPolicy::class,'update']);
        Gate::define('skillLevels_delete', [SkillLevelPolicy::class,'delete']);
        Gate::define('skillLevels_deleteForce', [SkillLevelPolicy::class,'delete_force']);
        Gate::define('skillLevels_restore', [SkillLevelPolicy::class,'restore']);

        // Skills
        Gate::define('skills_index', [SkillPolicy::class,'index']);
        Gate::define('skills_deleted', [SkillPolicy::class,'deleted']);
        Gate::define('skills_create', [SkillPolicy::class,'create']);
        Gate::define('skills_update', [SkillPolicy::class,'update']);
        Gate::define('skills_delete', [SkillPolicy::class,'delete']);
        Gate::define('skills_deleteForce', [SkillPolicy::class,'delete_force']);
        Gate::define('skills_restore', [SkillPolicy::class,'restore']);

        // Socials
        Gate::define('socials_index', [SocialPolicy::class,'index']);
        Gate::define('socials_deleted', [SocialPolicy::class,'deleted']);
        Gate::define('socials_create', [SocialPolicy::class,'create']);
        Gate::define('socials_update', [SocialPolicy::class,'update']);
        Gate::define('socials_delete', [SocialPolicy::class,'delete']);
        Gate::define('socials_deleteForce', [SocialPolicy::class,'delete_force']);
        Gate::define('socials_restore', [SocialPolicy::class,'restore']);

        // Language Levels
        Gate::define('languageLevels_index', [LanguageLevelPolicy::class,'index']);
        Gate::define('languageLevels_deleted', [LanguageLevelPolicy::class,'deleted']);
        Gate::define('languageLevels_create', [LanguageLevelPolicy::class,'create']);
        Gate::define('languageLevels_update', [LanguageLevelPolicy::class,'update']);
        Gate::define('languageLevels_delete', [LanguageLevelPolicy::class,'delete']);
        Gate::define('languageLevels_deleteForce', [LanguageLevelPolicy::class,'delete_force']);
        Gate::define('languageLevels_restore', [LanguageLevelPolicy::class,'restore']);

        // Languages
        Gate::define('languages_index', [LanguagePolicy::class,'index']);
        Gate::define('languages_deleted', [LanguagePolicy::class,'deleted']);
        Gate::define('languages_create', [LanguagePolicy::class,'create']);
        Gate::define('languages_update', [LanguagePolicy::class,'update']);
        Gate::define('languages_delete', [LanguagePolicy::class,'delete']);
        Gate::define('languages_deleteForce', [LanguagePolicy::class,'delete_force']);
        Gate::define('languages_restore', [LanguagePolicy::class,'restore']);

        // Experience Types
        Gate::define('experienceTypes_index', [ExperienceTypePolicy::class,'index']);
        Gate::define('experienceTypes_deleted', [ExperienceTypePolicy::class,'deleted']);
        Gate::define('experienceTypes_create', [ExperienceTypePolicy::class,'create']);
        Gate::define('experienceTypes_update', [ExperienceTypePolicy::class,'update']);
        Gate::define('experienceTypes_delete', [ExperienceTypePolicy::class,'delete']);
        Gate::define('experienceTypes_deleteForce', [ExperienceTypePolicy::class,'delete_force']);
        Gate::define('experienceTypes_restore', [ExperienceTypePolicy::class,'restore']);

        // Experiences
        Gate::define('experiences_index', [ExperiencePolicy::class,'index']);
        Gate::define('experiences_deleted', [ExperiencePolicy::class,'deleted']);
        Gate::define('experiences_create', [ExperiencePolicy::class,'create']);
        Gate::define('experiences_update', [ExperiencePolicy::class,'update']);
        Gate::define('experiences_delete', [ExperiencePolicy::class,'delete']);
        Gate::define('experiences_deleteForce', [ExperiencePolicy::class,'delete_force']);
        Gate::define('experiences_restore', [ExperiencePolicy::class,'restore']);


        // Certificate Issuers
        Gate::define('certificateIssuers_index', [CertificateIssuerPolicy::class,'index']);
        Gate::define('certificateIssuers_deleted', [CertificateIssuerPolicy::class,'deleted']);
        Gate::define('certificateIssuers_create', [CertificateIssuerPolicy::class,'create']);
        Gate::define('certificateIssuers_update', [CertificateIssuerPolicy::class,'update']);
        Gate::define('certificateIssuers_delete', [CertificateIssuerPolicy::class,'delete']);
        Gate::define('certificateIssuers_deleteForce', [CertificateIssuerPolicy::class,'delete_force']);
        Gate::define('certificateIssuers_restore', [CertificateIssuerPolicy::class,'restore']);

        // Certificates
        Gate::define('certificates_index', [CerificatePolicy::class,'index']);
        Gate::define('certificates_deleted', [CerificatePolicy::class,'deleted']);
        Gate::define('certificates_create', [CerificatePolicy::class,'create']);
        Gate::define('certificates_update', [CerificatePolicy::class,'update']);
        Gate::define('certificates_delete', [CerificatePolicy::class,'delete']);
        Gate::define('certificates_deleteForce', [CerificatePolicy::class,'delete_force']);
        Gate::define('certificates_restore', [CerificatePolicy::class,'restore']);

        /*
         * Job Search Related
         */

        // Job Search Types
        Gate::define('jobsearchTypes_index', [JobsearchTypePolicy::class,'index']);
        Gate::define('jobsearchTypes_deleted', [JobsearchTypePolicy::class,'deleted']);
        Gate::define('jobsearchTypes_create', [JobsearchTypePolicy::class,'create']);
        Gate::define('jobsearchTypes_update', [JobsearchTypePolicy::class,'update']);
        Gate::define('jobsearchTypes_delete', [JobsearchTypePolicy::class,'delete']);
        Gate::define('jobsearchTypes_deleteForce', [JobsearchTypePolicy::class,'delete_force']);
        Gate::define('jobsearchTypes_restore', [JobsearchTypePolicy::class,'restore']);

        // Job Search Statuses
        Gate::define('jobsearchStatuses_index', [JobsearchStatusPolicy::class,'index']);
        Gate::define('jobsearchStatuses_deleted', [JobsearchStatusPolicy::class,'deleted']);
        Gate::define('jobsearchStatuses_create', [JobsearchStatusPolicy::class,'create']);
        Gate::define('jobsearchStatuses_update', [JobsearchStatusPolicy::class,'update']);
        Gate::define('jobsearchStatuses_delete', [JobsearchStatusPolicy::class,'delete']);
        Gate::define('jobsearchStatuses_deleteForce', [JobsearchStatusPolicy::class,'delete_force']);
        Gate::define('jobsearchStatuses_restore', [JobsearchStatusPolicy::class,'restore']);

        // Job Searches
        Gate::define('jobsearches_index', [JobsearchPolicy::class,'index']);
        Gate::define('jobsearches_deleted', [JobsearchPolicy::class,'deleted']);
        Gate::define('jobsearches_create', [JobsearchPolicy::class,'create']);
        Gate::define('jobsearches_update', [JobsearchPolicy::class,'update']);
        Gate::define('jobsearches_delete', [JobsearchPolicy::class,'delete']);
        Gate::define('jobsearches_deleteForce', [JobsearchPolicy::class,'delete_force']);
        Gate::define('jobsearches_restore', [JobsearchPolicy::class,'restore']);
    }
}
