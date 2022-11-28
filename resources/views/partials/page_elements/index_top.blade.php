<div class="row mb-4">
    <div class="@can(request()->segment(1).'_create') col-11  @else col-12 @endcan">
        @include('partials.page_elements.search_bar')
    </div>
    @can(request()->segment(1).'_create')
        @if(!isset($no_create))
            <div class="col-1">
                @include('partials.page_elements.create')
            </div>
        @endif
    @endcan
</div>
@if(!isset($no_deleted))
    <div class="row mb-4">
        @can(request()->segment(1).'_deleted')
            @include('partials.page_elements.deleted_selector')
        @endcan
    </div>
@endif



