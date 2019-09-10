@extends('layouts.admin')

@section('title')
    Current slideshows
@endsection

@section('button')
    <a href="add" class="btn btn-secondary">Add slide</a>
@endsection

@section('content')
    <table class="datatable" style="width: 100%;">
        <thead>
        <tr>
            <th></th>
            <th>Type</th>
            <th>Title</th>
            <th>From</th>
            <th>Until</th>
            <th>Active</th>
            <th width="240"></th>
        </tr>
        </thead>

        <tbody>
        @foreach ($slides as $slide)
            <tr>
                <th class="preview"><img src="{{ env('APP_URL') }}{{ $slide->getPreview() }}"></th>
                <th>{{ $slide->type }}</th>
                <th>{{ $slide->title }}</th>
                <th>{{ $slide->from }}</th>
                <th>{{ $slide->until }}</th>
                <th class="active">{{ $slide->active }}</th>
                <th>
                    <a href="#" data-id="{{ $slide->id }}" class="btn btn-warning activate">@if($slide->active == 1) Deactivate @else Activate @endif</a>
                    <a href="{{ $slide->id }}/edit" class="btn btn-info">Edit</a>
                    <a href="#" data-id="{{ $slide->id }}" class="btn btn-danger delete">Delete</a>
                </th>
            </tr>
            @endforeach

        </tbody>
    </table>
@endsection



