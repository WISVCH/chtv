@extends('types.base')

@section('extraFields')

    <!-- Text input-->
    <div class="form-group row">
        <label class="col-2 col-form-label" for="header">Header text</label>
        <div class="col-10">
            <input id="header" name="header" type="text" placeholder="My awesome countdown"
                   class="form-control input-md @if(key_exists('header', $errors)) is-invalid @endif" value="{{ $slide->getExtended()->header }}">
            <small class="form-text text-muted">Enter the title that is shown at the top of the countdown.</small>
        </div>
    </div>

    <!-- Text input-->
    <div class="form-group row">
        <label class="col-2 col-form-label" for="description_left">Description left</label>
        <div class="col-10">
            <textarea id="description_left" name="description_left" type="text" placeholder="A text positioned on the left"
                      class="form-control input-md @if(key_exists('description_left', $errors)) is-invalid @endif">{{ $slide->getExtended()->description_left }}</textarea>
        </div>
    </div>

    <!-- Text input-->
    <div class="form-group row">
        <label class="col-2 col-form-label" for="description_right">Description right</label>
        <div class="col-10">
            <textarea id="description_right" name="description_right" type="text" placeholder="A text positioned on the right"
                      class="form-control input-md @if(key_exists('description_right', $errors)) is-invalid @endif">{{ $slide->getExtended()->description_right }}</textarea>
        </div>
    </div>

    <!-- Text input-->
    <div class="form-group row">
        <label class="col-2 col-form-label" for="countdown_done">Countdown done</label>
        <div class="col-10">
            <textarea id="countdown_done" name="countdown_done" type="text" placeholder="A text shown after the countdown is done"
                      class="form-control input-md @if(key_exists('countdown_done', $errors)) is-invalid @endif">{{ $slide->getExtended()->countdown_done }}</textarea>
        </div>
    </div>

    <!-- Text input-->
    <div class="form-group row">
        <label class="col-2 col-form-label" for="countdown_type">Countdown design</label>
        <div class="col-10">
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="countdown_type" id="countdown_type1" value="1" @if($slide->getExtended()->countdown_type == 1 || !$slide->getExtended()->countdown_type) checked @endif>
                <label class="form-check-label" for="countdown_type1"><img class="thumb" src="{{ URL::asset('images/countdown_example1.png') }}"></label>
            </div>
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="countdown_type" id="countdown_type2" value="2" @if($slide->getExtended()->countdown_type == 2) checked @endif>
                <label class="form-check-label" for="countdown_type2"><img class="thumb" src="{{ URL::asset('images/countdown_example2.png') }}"></label>
            </div>
        </div>
    </div>

    <div class="form-group row">
        <label class="col-2 col-form-label" for="deadline">Deadline</label>
        <div class="input-group date col-10" id="deadline" data-target-input="nearest">
            <input type="text" name="deadline" class="form-control datetimepicker-input @if(key_exists('deadline', $errors)) is-invalid @endif" data-target="#deadline" required="required">
            <div class="input-group-append" data-target="#deadline" data-toggle="datetimepicker">
                <div class="input-group-text"><i class="fa fa-calendar"></i></div>
            </div>
        </div>
    </div>

    <!-- file input-->
    <div class="form-group row">
        <label class="col-2 col-form-label" for="title">Upload background</label>
        <div class="col-10">
            <label class="file-upload btn btn-primary">
                Browse for file ... <input type="file" name="background" id="background" accept="image/*" />
            </label>

            <div class="current">
                @if ($slide->id)
                    Current: <img class="thumb" src="{{ URL::asset('storage/uploads/'. $slide->getExtended()->background) }}">
                    @endif
            </div>
        </div>
    </div>
@endsection

@section('postScripts')
    @parent
    <script type="text/javascript">
        $(document).ready(function() {
            $('.file-upload').file_upload();
        });

        let deadline = @if($slide->getExtended()->deadline) moment('{{ $slide->getExtended()->deadline }}'); @else moment().startOf('day').format('YYYY-MM-DD HH:mm'); @endif
        $('#deadline').datetimepicker({
            defaultDate: deadline
        });
    </script>
@endsection