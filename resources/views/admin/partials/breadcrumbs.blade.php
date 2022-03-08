@if (count($breadcrumbs))
    <nav class="breadcrumb-container" aria-label="breadcrumb" style="float: left">
        <ol class="breadcrumb">
            @foreach ($breadcrumbs as $breadcrumb)
                @if ($breadcrumb->url && !$loop->last)
                    <li class="breadcrumb-item">
                        <a href="{{ $breadcrumb->url }}">
                            {!! ($loop->first && ($breadcrumb->title == "Home" || $breadcrumb->title == "Dashboard")) ? '<i class="ik ik-home"></i>' : $breadcrumb->title !!}
                        </a>
                    </li>
                @else
                    <li class="breadcrumb-item active">{!! $breadcrumb->title !!}</li>
                @endif
            @endforeach
        </ol>
    </nav>
@endif
