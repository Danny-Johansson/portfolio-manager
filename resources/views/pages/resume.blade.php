@php use Carbon\Carbon; @endphp
@extends('layouts.app')

@section('content')
    @include('partials.page_elements.data.heading',['type' => 'navigation','data' => 'resume','level' => 1, 'textcenter' => true])
    <section class="row" id="personal_information">
        @include('partials.page_elements.data.heading',['type' => 'resume','data' => 'Personal Information','level' => 2, 'textcenter' => true])
        <div class="col-4">
            <section id="name">
                @include('partials.page_elements.data.inline_label',['type' => 'inputs', 'data' => 'name'])
                <span>
                    @if(isset($owner->first_name))
                        {{$owner->first_name}}
                    @endif @if(isset($owner->initials))
                        {{$owner->initials}}
                    @endif @if(isset($owner->last_name))
                        {{$owner->last_name}}
                    @endif
                </span>
            </section>
            @if(isset($owner->birthday))
                <section id="birthday">
                    <span class="fw-bold text-capitalize">@lang('inputs.birthday') : </span>
                    <span>{{date('d.m.Y',strtotime($owner->birthday))}}</span>
                    <span
                        id="age"> - {{Carbon::parse($owner->birthday)->diff(Carbon::now())->format('%y')}} @lang('resume.years') @lang('resume.old')
                    </span>
                </section>
            @endif
            <section id="address">
                <span class="fw-bold text-capitalize">
                    @if(isset($owner->street_name))
                        @lang('inputs.address')
                    @else
                        @lang('inputs.city')
                    @endif
                    :
                </span>
                <span>
                    @if(isset($owner->street_name))
                        {{$owner->street_name}}
                    @endif @if(isset($owner->street_number))
                        {{$owner->street_number}}
                    @endif
                    @if(isset($owner->city))
                        @if(isset($owner->street_name))
                            ,
                        @endif
                        @if(isset($owner->zip))
                            {{$owner->zip}}
                        @endif
                        @if(isset($owner->city))
                            {{$owner->city}}
                        @endif
                    @endif
                </span>
            </section>
            @if(isset($owner->country))
                <section id="country">
                    @include('partials.page_elements.data.inline_label',['type' => 'inputs', 'data' => 'country'])
                    @include('partials.page_elements.data.inline_data',['type' => 'countries', 'data' => $owner->country])
                </section>
            @endif
            @if(isset($owner->email))
                <section id="email">
                    @include('partials.page_elements.data.inline_label',['type' => 'inputs', 'data' => 'email'])
                    <span>
                        <a href="mailto:@if(config('system.demo_mode')){{config('system.email')}}@elseif(isset($owner->email)){{$owner->email}}@endif">
                            @if(config('system.demo_mode')){{config('system.email')}}@elseif(isset($owner->email)){{$owner->email}}@endif
                        </a>
                    </span>
                </section>
            @endif
            @if(isset($owner->phone))
                <section id="phone">
                    @include('partials.page_elements.data.inline_label',['type' => 'inputs', 'data' => 'phone'])
                    <span>
                        @if(config('system.demo_mode')){{config('system.phone')}}@elseif(isset($owner->phone)){{$owner->phone}}@endif
                    </span>
                </section>
            @endif
        </div>

        @if(count($socials) >= 1)
            <div class="col">
                <section id="socials">
                    @foreach($socials as $social)
                        @if(!config('system.demo_mode'))
                            <img src="{{$social->logo}}" class="align-bottom" style="max-height:1.5em;" alt="{{$social->name}}">
                        @endif
                        <span class="fw-bold text-capitalize text-center">
                            @if(config('system.demo_mode')){{config('app.url')}}@else{{$social->name}}@endif
                            :
                        </span>
                        <a href="@if(config('system.demo_mode')){{config('app.url')}}@else{{$social->link}}@endif">
                            @if(config('system.demo_mode')){{config('app.url')}}@else{{$social->name}}@endif
                        </a>
                    @endforeach
                </section>
            </div>
        @endif

        <div class="col-1">
            @if(isset($owner->image) AND !empty($owner->image))
                <img
                    src="{{$owner->image}}"
                    alt="@if(isset($owner->first_name)){{$owner->first_name}}@endif @if(isset($owner->initials)) {{$owner->initials}} @endif @if(isset($owner->last_name)){{$owner->last_name}}@endif"
                    class="float-end"
                >
            @endif
        </div>
    </section>

    @if(count($educations) >= 1 OR count($works) >= 1 OR count($volunteers) >= 1 OR count($other_experiences) >= 1)
        <section class="row mt-4" id="experience">
            <h2 class="text-capitalize text-center">@lang('experiences.experience')</h2>
            @if(count($educations) >= 1)
                <section class="row" id="education">
                    @include('partials.page_elements.data.heading',['type' => 'resume','data' => 'education','level' => 3])
                    <table id="education_table" class="table table-striped ">
                        <thead>
                            <tr class="fw-bold text-capitalize">
                                @include('partials.page_elements.data.label',['type' => 'inputs','data' => 'start_date','col' => '1'])
                                @include('partials.page_elements.data.label',['type' => 'inputs','data' => 'end_date','col' => '1'])
                                @include('partials.page_elements.data.label',['type' => 'inputs','data' => 'name','col' => 'auto'])
                                @include('partials.page_elements.data.label',['type' => 'inputs','data' => 'location','col' => 'auto'])
                                @include('partials.page_elements.data.label',['type' => 'inputs','data' => 'note','col' => 'auto'])
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($educations as $education)
                                <tr class="fw-bold text-capitalize">
                                    @include('partials.page_elements.data.date',['format' => 'M Y','data' => $education->start_date,'col' => '1'])
                                    @include('partials.page_elements.data.date',['format' => 'M Y','data' => $education->end_date,'col' => '1'])
                                    @include('partials.page_elements.data.data',['type' => 'experiences','data' => $education->name,'col' => 'auto'])
                                    @include('partials.page_elements.data.data',['type' => 'experiences','data' => $education->location,'col' => 'auto'])
                                    @include('partials.page_elements.data.data',['type' => 'experiences','data' => $education->note,'col' => 'auto','multiline' => true])
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </section>
            @endif

            @if(count($works) >= 1)
                <section class="row" id="work">
                    @include('partials.page_elements.data.heading',['type' => 'resume','data' => 'work','level' => 3])
                    <table id="work_table" class="table table-striped ">
                        <thead>
                            <tr class="fw-bold text-capitalize">
                                @include('partials.page_elements.data.label',['type' => 'inputs','data' => 'start_date','col' => '1'])
                                @include('partials.page_elements.data.label',['type' => 'inputs','data' => 'end_date','col' => '1'])
                                @include('partials.page_elements.data.label',['type' => 'inputs','data' => 'name','col' => 'auto'])
                                @include('partials.page_elements.data.label',['type' => 'inputs','data' => 'location','col' => 'auto'])
                                @include('partials.page_elements.data.label',['type' => 'inputs','data' => 'note','col' => 'auto'])
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($works as $work)
                                <tr>
                                    @include('partials.page_elements.data.date',['format' => 'M Y','data' => $work->start_date,'col' => '1'])
                                    @include('partials.page_elements.data.date',['format' => 'M Y','data' => $work->end_date,'col' => '1'])
                                    @include('partials.page_elements.data.data',['type' => 'experiences','data' => $work->name,'col' => 'auto'])
                                    @include('partials.page_elements.data.data',['type' => 'experiences','data' => $work->location,'col' => 'auto'])
                                    @include('partials.page_elements.data.data',['type' => 'experiences','data' => $work->note,'col' => 'auto','multiline' => true])
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </section>
            @endif

            @if(count($volunteers) >= 1)
                <section class="row" id="volunteer_work">
                    @include('partials.page_elements.data.heading',['type' => 'resume','data' => 'volunteer','level' => 3])
                    <table id="volunteer_table" class="table table-striped ">
                        <thead>
                            <tr class="fw-bold text-capitalize">
                                @include('partials.page_elements.data.label',['type' => 'inputs','data' => 'start_date','col' => '1'])
                                @include('partials.page_elements.data.label',['type' => 'inputs','data' => 'end_date','col' => '1'])
                                @include('partials.page_elements.data.label',['type' => 'inputs','data' => 'name','col' => 'auto'])
                                @include('partials.page_elements.data.label',['type' => 'inputs','data' => 'location','col' => 'auto'])
                                @include('partials.page_elements.data.label',['type' => 'inputs','data' => 'note','col' => 'auto'])
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($volunteers as $volunteer)
                                <tr>
                                    @include('partials.page_elements.data.date',['format' => 'M Y','data' => $volunteer->start_date,'col' => '1'])
                                    @include('partials.page_elements.data.date',['format' => 'M Y','data' => $volunteer->end_date,'col' => '1'])
                                    @include('partials.page_elements.data.data',['type' => 'experiences','data' => $volunteer->name,'col' => 'auto'])
                                    @include('partials.page_elements.data.data',['type' => 'experiences','data' => $volunteer->location,'col' => 'auto'])
                                    @include('partials.page_elements.data.data',['type' => 'experiences','data' => $volunteer->note,'col' => 'auto','multiline' => true])
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </section>
            @endif

            @if(count($other_experiences) >= 1)
                <section class="row" id="other_experience">
                    @include('partials.page_elements.data.heading',['type' => 'resume','data' => 'other','level' => 3])
                    <table id="education_table" class="table table-striped ">
                        <thead>
                            <tr class="fw-bold text-capitalize">
                                @include('partials.page_elements.data.label',['type' => 'inputs','data' => 'start_date','col' => '1'])
                                @include('partials.page_elements.data.label',['type' => 'inputs','data' => 'end_date','col' => '1'])
                                @include('partials.page_elements.data.label',['type' => 'inputs','data' => 'name','col' => 'auto'])
                                @include('partials.page_elements.data.label',['type' => 'inputs','data' => 'location','col' => 'auto'])
                                @include('partials.page_elements.data.label',['type' => 'inputs','data' => 'note','col' => 'auto'])
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($other_experiences as $other_experience)
                                <tr>
                                    @include('partials.page_elements.data.date',['format' => 'M Y','data' => $other_experience->start_date,'col' => '1'])
                                    @include('partials.page_elements.data.date',['format' => 'M Y','data' => $other_experience->end_date,'col' => '1'])
                                    @include('partials.page_elements.data.data',['type' => 'experiences','data' => $other_experience->name,'col' => 'auto'])
                                    @include('partials.page_elements.data.data',['type' => 'experiences','data' => $other_experience->location,'col' => 'auto'])
                                    @include('partials.page_elements.data.data',['type' => 'experiences','data' => $other_experience->note,'col' => 'auto','multiline' => true])
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </section>
            @endif
        </section>
    @endif

    @if(count($languages) >= 1)
        <section class="row d-flex mt-4 container justify-content-center px-auto" id="languages">
            @include('partials.page_elements.data.heading',['type' => 'languages','data' => 'plural','level' => 2, 'textcenter' => true])
            <table id="languages_table" class="table table-striped ">
                <thead>
                    <tr class="fw-bold text-capitalize">
                        @include('partials.page_elements.data.label',['type' => 'languages','data' => 'singular','col' => 'auto'])
                        @include('partials.page_elements.data.label',['type' => 'languages','data' => 'read','col' => 'auto'])
                        @include('partials.page_elements.data.label',['type' => 'languages','data' => 'write','col' => 'auto'])
                        @include('partials.page_elements.data.label',['type' => 'languages','data' => 'speak','col' => 'auto'])
                        @include('partials.page_elements.data.label',['type' => 'languages','data' => 'understand','col' => 'auto'])
                    </tr>
                </thead>
                <tbody>
                    @foreach($languages as $language)
                        <tr>
                            @include('partials.page_elements.data.data',['type' => 'languages','data' => $language->name,'col' => 'auto'])
                            @include('partials.page_elements.data.data',['type' => 'languageLevels','data' => $language->read_rel->name,'col' => 'auto'])
                            @include('partials.page_elements.data.data',['type' => 'languageLevels','data' => $language->write_rel->name,'col' => 'auto'])
                            @include('partials.page_elements.data.data',['type' => 'languageLevels','data' => $language->speak_rel->name,'col' => 'auto'])
                            @include('partials.page_elements.data.data',['type' => 'languageLevels','data' => $language->understand_rel->name,'col' => 'auto'])
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </section>
    @endif

    @if(count($skills) >= 1)
        <section class="row mt-4" id="skills">
            @include('partials.page_elements.data.heading',['type' => 'skills','data' => 'plural','level' => 2, 'textcenter' => true])
            <table id="languages_table" class="table table-striped ">
                <thead>
                    <tr class="fw-bold text-capitalize">
                        @include('partials.page_elements.data.label',['type' => 'inputs','data' => 'name','col' => 'auto'])
                        @include('partials.page_elements.data.label',['type' => 'skillLevels','data' => 'singular','col' => 'auto'])
                    </tr>
                </thead>
                <tbody>
                    @foreach($skills as $skill)
                        <tr>
                            @include('partials.page_elements.data.data',['type' => 'skills','data' => $skill->name,'col' => 'auto'])
                            @include('partials.page_elements.data.data',['type' => 'skillLevels','data' => $skill->level->name,'col' => 'auto'])
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </section>
    @endif

    @if(count($certificates) >= 1)
        <section class="row mt-4" id="certificates">
            @include('partials.page_elements.data.heading',['type' => 'certificates','data' => 'plural','level' => 2, 'textcenter' => true])
            <table id="certificates_table" class="table table-striped ">
                <thead>
                    <tr class="fw-bold text-capitalize">
                        @include('partials.page_elements.data.label',['type' => 'inputs','data' => 'name','col' => 'auto'])
                        @include('partials.page_elements.data.label',['type' => 'certificateIssuers','data' => 'singular','col' => 'auto'])
                        @include('partials.page_elements.data.label',['type' => 'inputs','data' => 'earn_date','col' => 'auto'])
                        @include('partials.page_elements.data.label',['type' => 'inputs','data' => 'expire_date','col' => 'auto'])
                        @include('partials.page_elements.data.label',['type' => 'inputs','data' => 'file','col' => 'auto'])
                        @include('partials.page_elements.data.label',['type' => 'inputs','data' => 'note','col' => 'auto'])
                    </tr>
                </thead>
                <tbody>
                    @foreach($certificates as $certificate)
                        <tr>
                            @include('partials.page_elements.data.data',['type' => 'certificates','data' => $certificate->name,'col' => 'auto'])
                            @include('partials.page_elements.data.data',['type' => 'certificateIssuers','data' => $certificate->issuer->name,'col' => 'auto'])
                            @include('partials.page_elements.data.date',['format' => 'M Y','data' => $certificate->earn_date,'col' => '1'])
                            @include('partials.page_elements.data.date',['format' => 'M Y','data' => $certificate->expire_date,'col' => '1'])
                            @include('partials.page_elements.data.link',['data' => $certificate->file,'label' => 'file','col' => 'auto'])
                            @include('partials.page_elements.data.data',['type' => 'certificates','data' => $certificate->note,'col' => 'auto','multiline' => true])
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </section>
    @endif

    @if($owner->license)
        <section class="row mt-4" id="other">
            @include('partials.page_elements.data.heading',['type' => 'resume','data' => 'other','level' => 2, 'textcenter' => true])
            <span id="license_label" class="fw-bold text-capitalize col-auto">
                @lang('inputs.license') :
            </span>
            <span id="license" class="text-capitalize col">
                @if($owner->license)
                    @lang('system.true')
                @else
                    @lang('system.false')
                @endif
            </span>
        </section>
    @endif
@endsection
