<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;
use App\Models\Demonstration;
use App\Models\DemonstrationType;
use App\Models\Experience;
use App\Models\ExperienceType;
use App\Models\Jobsearch;
use App\Models\JobsearchStatus;
use App\Models\Language;
use App\Models\LanguageLevel;
use App\Models\Owner;
use App\Models\Project;
use App\Models\ProjectFeature;
use App\Models\Role;
use App\Models\Skill;
use App\Models\Social;
use App\Models\Tag;
use App\Models\TagCategory;
use App\Models\User;
use App\Policies\DemonstrationPolicy;
use App\Policies\DemonstrationTypePolicy;
use App\Policies\ExperiencePolicy;
use App\Policies\ExperienceTypePolicy;
use App\Policies\JobsearchPolicy;
use App\Policies\JobsearchStatusPolicy;
use App\Policies\LanguageLevelPolicy;
use App\Policies\LanguagePolicy;
use App\Policies\OwnerPolicy;
use App\Policies\ProjectFeaturePolicy;
use App\Policies\ProjectPolicy;
use App\Policies\RolePolicy;
use App\Policies\SkillPolicy;
use App\Policies\SocialPolicy;
use App\Policies\TagCategoryPolicy;
use App\Policies\TagPolicy;
use App\Policies\UserPolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        Demonstration::class => DemonstrationPolicy::class,
        DemonstrationType::class => DemonstrationTypePolicy::class,
        Experience::class => ExperiencePolicy::class,
        ExperienceType::class => ExperienceTypePolicy::class,
        Jobsearch::class => JobsearchPolicy::class,
        JobsearchStatus::class => JobsearchStatusPolicy::class,
        Language::class => LanguagePolicy::class,
        LanguageLevel::class => LanguageLevelPolicy::class,
        Owner::class => OwnerPolicy::class,
        Project::class => ProjectPolicy::class,
        ProjectFeature::class => ProjectFeaturePolicy::class,
        Role::class => RolePolicy::class,
        Skill::class => SkillPolicy::class,
        Social::class => SocialPolicy::class,
        Tag::class => TagPolicy::class,
        TagCategory::class => TagCategoryPolicy::class,
        User::class => UserPolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        //
    }
}
