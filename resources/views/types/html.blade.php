@extends('types.base')


@section('extraFields')
    <!-- file input-->
    <div class="form-group row">
        <label class="col-2 col-form-label" for="title">Upload zipfile</label>
        <div class="col-10">
            <label class="file-upload btn btn-primary">
                Browse for file ... <input type="file" name="zipfile" id="zipfile" accept="application/zip,application/x-zip,application/x-zip-compressed" />
            </label>

            <div class="current">
                @if ($slide->id)
                    Current: <iframe class="thumb" src="{{ URL::asset('storage/uploads/html'. $slide->id ) .'/'. $slide->getExtended()->indexname }}"></iframe>
                    @endif
            </div>
        </div>
    </div>

    <!-- Text input-->
    <div class="form-group row">
        <label class="col-2 col-form-label" for="indexname">Index filename</label>
        <div class="col-10">
            <input id="indexname" name="indexname" type="text" placeholder="index.htm, index.html, index.php"
                   class="form-control input-md @if(key_exists('indexname', $errors)) is-invalid @endif" value="{{ $slide->getExtended()->indexname }}">
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