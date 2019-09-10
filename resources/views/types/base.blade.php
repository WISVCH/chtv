@extends('layouts.admin')

@section('title')
    @if($slide->id)
        Edit slide - {{ $slide->title }}
    @else
        Add new slide - {{ $slide->getCaption() }}
    @endif
@endsection

@section('button')
    @if($slide->id)
        <a href="{{ env('APP_URL') }}admin/" class="btn btn-secondary">Back</a>
    @else
        <a href="{{ env('APP_URL') }}admin/add" class="btn btn-secondary">Back</a>
    @endif
@endsection

@section('content')
    <div id="form-container">
        @if (count($errors) > 0)
            <div class="alert alert-danger">
            @foreach ($errors as $key => $error)
                <strong>{{ $key }}!</strong> {{ $error }}.<br />
            @endforeach
            </div>
        @endif
        <form class="form-horizontal" method="post" enctype="multipart/form-data">
            <fieldset>

                {{ csrf_field() }}

                <!-- Text input-->
                <div class="form-group row">
                    <label class="col-2 col-form-label" for="title">Title</label>
                    <div class="col-10">
                        <input id="title" name="title" type="text" placeholder="My slide title"
                               class="form-control input-md @if(key_exists('title', $errors)) is-invalid @endif" required="required" value="{{ $slide->title }}">
                        <small class="form-text text-muted">Enter a recognizable title for the slide.</small>
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-2 col-form-label" for="from">From</label>
                    <div class="input-group date col-10" id="from" data-target-input="nearest">
                        <input type="text" name="from" class="form-control datetimepicker-input @if(key_exists('from', $errors)) is-invalid @endif" data-target="#from" required="required">
                        <div class="input-group-append" data-target="#from" data-toggle="datetimepicker">
                            <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                        </div>
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-2 col-form-label" for="until">Until</label>
                    <div class="input-group date col-10" id="until" data-target-input="nearest">
                        <input type="text" name="until" class="form-control datetimepicker-input @if(key_exists('until', $errors)) is-invalid @endif" data-target="#until" required="required">
                        <div class="input-group-append" data-target="#until" data-toggle="datetimepicker">
                            <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                        </div>
                    </div>
                </div>

                <!-- Text input-->
                <div class="form-group row">
                    <label class="col-2 col-form-label" for="duration">Duration</label>
                    <div class="col-10">
                        <input id="duration" name="duration" type="text" placeholder="30" class="form-control input-md @if(key_exists('duration', $errors)) is-invalid @endif"
                               required="required" value="@if($slide->duration) {{ $slide->duration }} @else 30 @endif">
                        <small class="form-text text-muted">Enter in seconds how long a slide should stay on the screen.</small>
                    </div>
                </div>

                <!-- Text input-->
                <div class="form-group row">
                    <label class="col-2 col-form-label" for="minimal">Minimal time per hour</label>
                    <div class="col-10">
                        <input id="minimal" name="minimal" type="text" placeholder="0" class="form-control input-md @if(key_exists('minimal', $errors)) is-invalid @endif"
                               required="required" value="@if($slide->minimal) {{ $slide->minimal }} @else 0 @endif">
                        <small class="form-text text-muted">Enter amount of seconds that it should at least appear. (0) if it doesn't matter.</small>
                    </div>
                </div>

                <!-- Text input-->
                <div class="form-group row">
                    <label class="col-2 col-form-label" for="active">Active</label>
                    <div class="col-10">
                        <input id="active" name="active" type="checkbox" placeholder="0" class="form-control input-md" @if($slide->active == 1) checked @endif>
                    </div>
                </div>

                @yield('extraFields')

                <!-- Button -->
                <div class="form-group row">
                    <label class="col-2 col-form-label" for="save">Save</label>
                    <div class="col-10">
                        <button id="save" name="save" class="btn btn-primary">Save</button>
                    </div>
                </div>

            </fieldset>
        </form>
    </div>
@endsection

@section('postScripts')
    <script type="text/javascript">
        $(function () {
            let from = @if($slide->from) moment('{{ $slide->from }}'); @else moment().startOf('day').format('YYYY-MM-DD HH:mm'); @endif
            let until = @if($slide->until) moment('{{ $slide->until }}'); @else moment().add(14, 'days').startOf('day').format('YYYY-MM-DD HH:mm'); @endif
            $('#from').datetimepicker({
                defaultDate: from
            });
            $('#until').datetimepicker({
                defaultDate: until,
                useCurrent: false //Important! See issue #1075
            });
            $('#from').on("change.datetimepicker", function (e) {
                $('#until').datetimepicker('minDate', e.date);
            });
            $('#until').on("change.datetimepicker", function (e) {
                $('#from').datetimepicker('maxDate', e.date);
            });
        });
    </script>
@endsection



