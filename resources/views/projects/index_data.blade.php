@section('heading')
    Projects Index
@endsection

@section('content')
    @if(count($data) >= 1)
        {{var_dump($data)}}
    @else
        @lang('no') @lang('projects')
    @endif
@endsection
