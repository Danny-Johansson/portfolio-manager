@php use Carbon\Carbon; @endphp

@include('partials.page_elements.data.date',['format' => 'd M Y','data' => $object->apply_date, 'col' => '1'])
@include('partials.page_elements.data.data',['type' => 'jobsearchTypes','data' => $object->type->name, 'col' => 'auto'])
@include('partials.page_elements.data.data',['type' => 'jobsearches','data' => $object->title, 'col' => 'auto'])
@include('partials.page_elements.data.data',['type' => 'jobsearches','data' => $object->company, 'col' => 'auto'])
@include('partials.page_elements.data.data',['type' => 'jobsearches','data' => $object->address, 'col' => 'auto'])
@include('partials.page_elements.data.data',['type' => 'jobsearches','data' => $object->person, 'col' => 'auto'])

@if(config('system.demo_mode'))
    @include('partials.page_elements.data.data',['type' => 'jobsearches','data' => config('system.email'), 'col' => 'auto'])
@else
    @include('partials.page_elements.data.data',['type' => 'jobsearches','data' => $object->email, 'col' => 'auto'])
@endif

@if(config('system.demo_mode'))
    @include('partials.page_elements.data.data',['type' => 'jobsearches','data' => config('system.phone'), 'col' => 'auto'])
@else
    @include('partials.page_elements.data.data',['type' => 'jobsearches','data' => $object->phone, 'col' => 'auto'])
@endif

@if(config('system.demo_mode'))
    @include('partials.page_elements.data.link',['data' => config('system.url'),'label' => 'link', 'col' => 'auto'])
@else
    @include('partials.page_elements.data.link',['data' => $object->article,'label' => 'link','col' => 'auto'])
@endif

@if(config('system.demo_mode'))
    @include('partials.page_elements.data.link',['data' => config('system.url'),'label' => 'link', 'col' => 'auto'])
@else
    @include('partials.page_elements.data.link',['data' => $object->website,'label' => 'link','col' => 'auto'])
@endif

<td class="col-auto  @if($object->status->name =="Applied" && Carbon::parse($object->apply_date)->diff(Carbon::now())->format('%d') >= config('follow_up_spacing')) bg-warning @endif">
    @lang($object->status->name)
    @if($object->status->name =="Applied" && Carbon::parse($object->apply_date)->diff(Carbon::now())->format('%d') >= config('follow_up_spacing'))
        <br>
        @lang('Follow Up')!
    @endif
</td>
