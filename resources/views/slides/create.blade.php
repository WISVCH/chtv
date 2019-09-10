@extends('layouts.admin')

@section('title')
    Pick the type of slide
@endsection

@section('button')
    <a href="{{ env('APP_URL') }}admin/" class="btn btn-secondary">Back</a>
@endsection

@section('content')
    <div class="card-deck slideTypes">
        @foreach ($types as $type)
            <div class="card" data-url="add/{{ $type->getName() }}">
                <img class="card-img-top" src="{{ URL::asset('images/slides/'. $type->getName() .'.png') }}" alt="Card image cap">
                <div class="card-body">
                    <h5 class="card-title">{{ $type->getCaption() }}</h5>
                    <p class="card-text">{{ $type->getDescription() }}</p>
                    <a href="add/{{ $type->getName() }}" class="btn btn-primary">Create {{ $type->getCaption() }}</a>
                </div>
            </div>
        @endforeach
    </div>
@endsection



