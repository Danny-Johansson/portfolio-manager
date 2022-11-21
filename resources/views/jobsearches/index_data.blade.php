@section('heading')
    @lang('job') @lang('searches') Index
@endsection

@section('content')
    @if(count($data) >= 1)
        {{var_dump($data)}}
    @else
        @lang('no') @lang('job') @lang('searches')
    @endif
@endsection
