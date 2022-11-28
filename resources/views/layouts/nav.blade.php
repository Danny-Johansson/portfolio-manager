<nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
    <div class="container">
        <a class="navbar-brand ms-4" href="{{ url('/') }}">
            {{ config('app.name', 'Portfolio Management System') }}
        </a>
        <button class="navbar-toggler me-2" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse px-4" id="navbarSupportedContent">
            <!-- Left Side Of Navbar -->
            <ul class="navbar-nav me-auto">
                <li class="nav-item">
                    <a class="nav-link text-capitalize" href="{{ route('about') }}">@lang('about') {{config('system.first_name')}}</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link text-capitalize" href="{{ route('resume') }}">@lang('resume')</a>
                </li>
                <!--
                <li class="nav-item">
                    <a class="nav-link text-capitalize" href="{{ route('projects.index') }}">@lang('projects')</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link text-capitalize" href="{{ route('demonstrations.index') }}">CSS @lang('demonstrations')</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link text-capitalize" href="{{ route('jobsearches.index') }}">@lang('jobsearch')</a>
                </li>
                -->
            </ul>

            <!-- Right Side Of Navbar -->
            <ul class="navbar-nav ms-auto">
                @guest
                    @if (Route::has('login'))
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                        </li>
                    @endif
                @else
                    <li class="nav-item dropdown">
                        <a id="navbarDropdown" class="nav-link dropdown-toggle text-capitalize" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                            @lang('administration')
                        </a>
                        <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">

                            <h6 class="dropdown-header text-capitalize">@lang('system')</h6>

                            <a class="dropdown-item text-capitalize" href="{{ route('roles.index') }}">
                                @lang('roles')
                            </a>

                            <a class="dropdown-item text-capitalize" href="{{ route('users.index') }}">
                                @lang('users')
                            </a>

                            <div class="dropdown-divider"></div>

                            <h6 class="dropdown-header text-capitalize">@lang('portfolio') @lang('related')</h6>

                            <a class="dropdown-item text-capitalize" href="{{ route('tagCategories.index') }}">
                                @lang('tagCategories')
                            </a>

                            <a class="dropdown-item text-capitalize" href="{{ route('tags.index') }}">
                                @lang('tags')
                            </a>

                            <a class="dropdown-item text-capitalize" href="{{ route('demonstrationTypes.index') }}">
                                @lang('demonstrationTypes')
                            </a>

                            <div class="dropdown-divider"></div>

                            <h6 class="dropdown-header text-capitalize">@lang('resume') @lang('related')</h6>

                            <a class="dropdown-item text-capitalize" href="{{ route('owner.index') }}">
                                @lang('owner')
                            </a>

                            <a class="dropdown-item text-capitalize" href="{{ route('socials.index') }}">
                                @lang('socials')
                            </a>

                            <a class="dropdown-item text-capitalize" href="{{ route('skillLevels.index') }}">
                                @lang('skillLevels')
                            </a>

                            <a class="dropdown-item text-capitalize" href="{{ route('skills.index') }}">
                                @lang('skills')
                            </a>

                            <a class="dropdown-item text-capitalize" href="{{ route('languageLevels.index') }}">
                                @lang('languageLevels')
                            </a>

                            <a class="dropdown-item text-capitalize" href="{{ route('languages.index') }}">
                                @lang('languages')
                            </a>

                            <a class="dropdown-item text-capitalize" href="{{ route('experienceTypes.index') }}">
                                @lang('experienceTypes')
                            </a>

                            <a class="dropdown-item text-capitalize" href="{{ route('experiences.index') }}">
                                @lang('experiences')
                            </a>

                            <a class="dropdown-item text-capitalize" href="{{ route('certificateIssuers.index') }}">
                                @lang('certificateIssuers')
                            </a>

                            <a class="dropdown-item text-capitalize" href="{{ route('certificates.index') }}">
                                @lang('certificates')
                            </a>

                            <div class="dropdown-divider"></div>

                            <h6 class="dropdown-header text-capitalize">@lang('jobsearch') @lang('related')</h6>

                            <a class="dropdown-item text-capitalize" href="{{ route('jobsearchTypes.index') }}">
                                @lang('jobsearchTypes')
                            </a>

                            <a class="dropdown-item text-capitalize" href="{{ route('jobsearchStatuses.index') }}">
                                @lang('jobsearchStatuses')
                            </a>
                        </div>
                    </li>
                    <li class="nav-item dropdown">
                        <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                            {{ Auth::user()->name }}
                        </a>

                        <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="{{ route('logout') }}"
                               onclick="event.preventDefault();
                                document.getElementById('logout-form').submit();">
                                @lang('Logout')
                            </a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                        </div>
                    </li>
                @endguest
            </ul>
        </div>
    </div>
</nav>
