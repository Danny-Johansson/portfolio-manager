<?php

namespace App\Http\Controllers;

use App\Models\Certificate;
use App\Models\Experience;
use App\Models\ExperienceType;
use App\Models\Language;
use App\Models\Owner;
use App\Models\Skill;
use App\Models\Social;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;

class PageController extends Controller
{
    public function root(): Factory|View|Application
    {
        $owner = Owner::first();

        return view('pages.about')
            ->with('owner',$owner)
        ;
    }

    public function home(): Factory|View|Application
    {
        return view('pages.home');
    }

    public function about(): Factory|View|Application
    {
        $owner = Owner::first();

        return view('pages.about')
            ->with('owner',$owner)
        ;
    }

    public function resume(): Factory|View|Application
    {
        $owner = Owner::first();


        $educations = Experience::where('experience_type_id','=',ExperienceType::where('name','=','Education')->first()->id)
            ->orderBy('start_date','DESC')
            ->orderBy('end_date','DESC')
            ->get();
        $works = Experience::where('experience_type_id','=',ExperienceType::where('name','=','Work Experience ')->first()->id)
            ->orderBy('start_date','DESC')
            ->orderBy('end_date','DESC')
            ->get();
        $volunteers = Experience::where('experience_type_id','=',ExperienceType::where('name','=','Volunteer Work')->first()->id)
            ->orderBy('start_date','DESC')
            ->orderBy('end_date','DESC')
            ->get();
        $other_experiences = Experience::where('experience_type_id','=',ExperienceType::where('name','=','Other')->first()->id)
            ->orderBy('start_date','DESC')
            ->orderBy('end_date','DESC')
            ->get();
        $languages = Language::orderBy('name','ASC')->get();
        $skills = Skill::orderBy('name','ASC')->get();
        $socials = Social::orderBy('name','ASC')->get();
        $certificates = Certificate::orderBy('earn_date','DESC')
            ->orderBy('name','ASC')
            ->get()
        ;

        return view('pages.resume')
            ->with('owner',$owner)
            ->with('educations',$educations)
            ->with('works',$works)
            ->with('volunteers',$volunteers)
            ->with('other_experiences',$other_experiences)
            ->with('languages',$languages)
            ->with('skills',$skills)
            ->with('socials',$socials)
            ->with('certificates',$certificates)
        ;
    }
}
