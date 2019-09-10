<div class="countdown-main" style="background-image: url({{ URL::asset('storage/uploads/'. $slide->getExtended()->background) }})">
    <div class="overlay" style="background-color: rgba(0, 0, 0, 0.5)"></div>
    <div class="header">
        {{ $slide->getExtended()->header }}
    </div>

    <div class="description description-left">{{ $slide->getExtended()->description_left }}</div>
    <div class="description description-right">{{ $slide->getExtended()->description_right }}</div>
    <div class="countdown-done" @if(strtotime($slide->getExtended()->deadline) > time()) style="display: none;" @endif>{{ $slide->getExtended()->countdown_done }}</div>

    <div class="countdown-block">
        @include('countdowns.countdown'. $slide->getExtended()->countdown_type)
    </div>
</div>