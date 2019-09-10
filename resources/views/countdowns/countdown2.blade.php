<div class="your-clock" id="countdown{{ $slide->id }}"></div>

@section('postScripts')
    @parent
    <script type="text/javascript">
        $('document').ready(function() {
            'use strict';

            let clock = $('#countdown{{ $slide->id }}').FlipClock({{ strtotime($slide->getExtended()->deadline) - time() }}, {
                clockFace: 'DailyCounter',
                countdown: true,
                showSeconds: true
            });
            console.log(clock);
        });
    </script>
@endsection