@extends('types.base')


@section('extraFields')
    <!-- file input-->
    <div class="form-group row">
        <label class="col-2 col-form-label" for="title">Upload video</label>
        <div class="col-10">
            <label class="file-upload btn btn-primary">
                Browse for video ... <input type="file" name="video" id="video" accept="video/*" />
            </label>

            {{--<div class="current">--}}
                {{--@if ($slide->id)--}}
                    {{--Current: <img class="thumb" src="{{ URL::asset('storage/uploads/'. $slide->getExtended()->filename) }}">--}}
                    {{--@endif--}}
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
    </script>
@endsection