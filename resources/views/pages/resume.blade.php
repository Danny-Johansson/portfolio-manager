@extends('layouts.app')


@section('content')
    <h1 class="text-center text-capitalize mb-4">
        @lang('resume')
    </h1>
    <section class="row" id="personal_information">
        <h2 class="text-center mb-4">@lang('Personal Information')</h2>
        <div class="col-4">
            <section id="name">
                <span class="fw-bold text-capitalize">@lang('name') : </span>
                <span>
                    @if(isset($owner->first_name)){{$owner->first_name}}@endif @if(isset($owner->initials)) {{$owner->initials}} @endif @if(isset($owner->last_name)){{$owner->last_name}}@endif
                </span>
            </section>
            @if(isset($owner->birthday))
                <section id="birthday">
                    <span class="fw-bold text-capitalize">@lang('birthday') : </span>
                    <span>{{date('d.m.Y',strtotime($owner->birthday))}}</span>
                    <span id="age"> - {{\Carbon\Carbon::parse($owner->birthday)->diff(\Carbon\Carbon::now())->format('%y')}} @lang('years') @lang('old')</span>
                </section>
            @endif
            <section id="address">
                <span class="fw-bold text-capitalize">
                    @if(isset($owner->street_name))
                        @lang('address')
                    @else
                        @lang('city')
                    @endif
                    :
                </span>
                <span>
                    @if(isset($owner->street_name)){{$owner->street_name}}@endif @if(isset($owner->street_number)){{$owner->street_number}}@endif
                    @if(isset($owner->city))
                        @if(isset($owner->street_name)),@endif
                        @if(isset($owner->zip)){{$owner->zip}}@endif @if(isset($owner->city)){{$owner->city}}@endif
                    @endif
                </span>
            </section>
            @if(isset($owner->country))
                <section id="country">
                    <span class="fw-bold text-capitalize">@lang('country') : </span>
                    <span>
                         @lang($owner->country)
                    </span>

                </section>
            @endif
            @if(isset($owner->email))
                <section id="email">
                    <span class="fw-bold text-capitalize">@lang('email') : </span>
                    <span>
                        <a href="mailto:{{$owner->email}}">{{$owner->email}}</a>
                    </span>
                </section>
            @endif
            @if(isset($owner->phone))
                <section id="phone">
                    <span class="fw-bold text-capitalize">@lang('phone') : </span>
                    <span>
                        {{$owner->phone}}
                    </span>
                </section>
            @endif
        </div>
        @if(count($socials) >= 1)
            <div class="col">
                <section id="socials">
                    @foreach($socials as $social)
                        <img src="{{$social->logo}}" class="align-bottom" style="max-height:1.5em;">
                        <span class="fw-bold text-capitalize text-center">{{$social->name}} : </span>
                        <a href="{{$social->link}}">
                            {{$social->link}}
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
            <h2 class="text-capitalize text-center">@lang('experience')</h2>
            @if(count($educations) >= 1)
                <section class="row" id="education">
                    <h3 class="text-capitalize">@lang('education')</h3>
                    <table id="education_table" class="table table-striped ">
                        <thead>
                        <tr>
                            <th class="col-1 fw-bold text-capitalize">@lang('start_date')</th>
                            <th class="col-1 fw-bold text-capitalize">@lang('end_date')</th>
                            <th class="fw-bold text-capitalize">@lang('name')</th>
                            <th class="fw-bold text-capitalize">@lang('location')</th>
                            <th class="fw-bold text-capitalize">@lang('note')</th>
                        </tr>
                        </thead>
                        <tbody>
                            @foreach($educations as $education)
                                <tr>
                                    <td class="col-1">
                                        {{date('M Y',strtotime($education->start_date))}}
                                    </td>
                                    <td class="col-1">
                                        {{date('M Y',strtotime($education->end_date))}}
                                    </td>
                                    <td>
                                        @lang($education->name)
                                    </td>
                                    <td>
                                        @lang($education->location)
                                    </td>

                                    <td>
                                        @lang($education->note)
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </section>
            @endif

            @if(count($works) >= 1)
                <section class="row" id="work">
                    <h3 class="text-capitalize">@lang('work')</h3>
                    <table id="work_table" class="table table-striped ">
                        <thead>
                        <tr>
                            <th class="col-1 fw-bold text-capitalize">@lang('start_date')</th>
                            <th class="col-1 fw-bold text-capitalize">@lang('end_date')</th>
                            <th class="fw-bold text-capitalize">@lang('title')</th>
                            <th class="fw-bold text-capitalize">@lang('location')</th>
                            <th class="fw-bold text-capitalize">@lang('note')</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($works as $work)
                            <tr>
                                <td class="col-1">
                                    {{date('M Y',strtotime($work->start_date))}}
                                </td>
                                <td class="col-1">
                                    {{date('M Y',strtotime($work->end_date))}}
                                </td>
                                <td>
                                    @lang($work->name)
                                </td>
                                <td>
                                    @lang($work->location)
                                </td>

                                <td>
                                    @lang($work->note)
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </section>
            @endif

            @if(count($volunteers) >= 1)
                <section class="row" id="volunteer_work">
                    <h3 class="text-capitalize">@lang('volunteer')</h3>
                    <table id="volunteer_table" class="table table-striped ">
                        <thead>
                        <tr>
                            <th class="col-1 fw-bold text-capitalize">@lang('start_date')</th>
                            <th class="col-1 fw-bold text-capitalize">@lang('end_date')</th>
                            <th class="fw-bold text-capitalize">@lang('name')</th>
                            <th class="fw-bold text-capitalize">@lang('location')</th>
                            <th class="fw-bold text-capitalize">@lang('note')</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($volunteers as $volunteer)
                            <tr>
                                <td class="col-1">
                                    {{date('M Y',strtotime($volunteer->start_date))}}
                                </td>
                                <td class="col-1">
                                    {{date('M Y',strtotime($volunteer->end_date))}}
                                </td>
                                <td>
                                    @lang($volunteer->name)
                                </td>
                                <td>
                                    @lang($volunteer->location)
                                </td>

                                <td>
                                    @lang($volunteer->note)
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </section>
            @endif

            @if(count($other_experiences) >= 1)
                <section class="row" id="other_experience">
                    <h3 class="text-capitalize">@lang('other')</h3>

                    <table id="education_table" class="table table-striped ">
                        <thead>
                        <tr>
                            <th class="col-1 fw-bold text-capitalize">@lang('start_date')</th>
                            <th class="col-1 fw-bold text-capitalize">@lang('end_date')</th>
                            <th class="fw-bold text-capitalize">@lang('title')</th>
                            <th class="fw-bold text-capitalize">@lang('location')</th>
                            <th class="fw-bold text-capitalize">@lang('note')</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($other_experiences as $other_experience)
                            <tr>
                                <td class="col-1">
                                    {{date('M Y',strtotime($other_experience->start_date))}}
                                </td>
                                <td class="col-1">
                                    {{date('M Y',strtotime($other_experience->end_date))}}
                                </td>
                                <td>
                                    @lang($other_experience->name)
                                </td>
                                <td>
                                    @lang($other_experience->location)
                                </td>
                                <td>
                                    @lang($other_experience->note)
                                </td>
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
            <h2 class="text-capitalize text-center mb-4">@lang('languages')</h2>
            <table id="languages_table" class="table table-striped ">
                <thead>
                    <tr>
                        <th class="fw-bold text-capitalize">@lang('language')</th>
                        <th class="fw-bold text-capitalize">@lang('read')</th>
                        <th class="fw-bold text-capitalize">@lang('write')</th>
                        <th class="fw-bold text-capitalize">@lang('speak')</th>
                        <th class="fw-bold text-capitalize">@lang('understand')</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($languages as $language)
                        <tr>
                            <td>
                                @lang($language->name)
                            </td>
                            <td>
                                @lang($language->read_rel->name)
                            </td>
                            <td>
                                @lang($language->write_rel->name)
                            </td>
                            <td>
                                @lang($language->speak_rel->name)
                            </td>
                            <td>
                                @lang($language->understand_rel->name)
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </section>
    @endif

    @if(count($skills) >= 1)
        <section class="row mt-4" id="skills">
            <h2 class="text-capitalize text-center">@lang('skills')</h2>

            <table id="languages_table" class="table table-striped ">
                <thead>
                <tr>
                    <th class="fw-bold text-capitalize">@lang('name')</th>
                    <th class="fw-bold text-capitalize">@lang('skillLevel')</th>
                </tr>
                </thead>
                <tbody>
                @foreach($skills as $skill)
                    <tr>
                        <td>
                            @lang($skill->name)
                        </td>
                        <td>
                            @lang($skill->level->name)
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </section>
    @endif

    @if(count($certificates) >= 1)
        <section class="row mt-4" id="certificates">
            <h2 class="text-capitalize text-center">@lang('certificates')</h2>

            <table id="certificates_table" class="table table-striped ">
                <thead>
                <tr class="fw-bold text-capitalize">
                    <th>@lang('name')</th>
                    <th>@lang('certificateIssuer')</th>
                    <th>@lang('earn_date')</th>
                    <th>@lang('expire_date')</th>
                    <th>@lang('file')</th>
                    <th>@lang('note')</th>
                </tr>
                </thead>
                <tbody>
                @foreach($certificates as $certificate)
                    <tr>
                        <td class="col-auto align-middle">
                            {{$certificate->name}}
                        </td>
                        <td class="col-auto align-middle">
                            {{$certificate->issuer->name}}
                        </td>
                        <td class="col-auto align-middle">
                            {{date('M Y',strtotime($certificate->earn_date))}}
                        </td>
                        <td class="col-auto align-middle">
                            {{date('M Y',strtotime($certificate->expire_date))}}
                        </td>
                        <td class="col-auto align-middle">
                            <a href="{{$certificate->file}}" target="_blank" class="btn btn-outline-success">@lang('file')</a>
                        </td>
                        <td class="col-auto align-middle">
                            {{$certificate->note}}
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </section>
    @endif

    @if($owner->license)
        <section class="row mt-4" id="other">
            <h2 class="text-capitalize text-center">@lang('other')</h2>
            <span id="license_label" class="fw-bold text-capitalize col-auto">
                @lang('license') :
            </span>
            <span id="license" class="text-capitalize col">
                @if($owner->license)
                    @lang('true')
                @else
                    @lang('false')
                @endif
            </span>
        </section>
    @endif
@endsection
