@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <h2>{{ $article->getAttribute('title_'.$locale) }}</h2>
            <hr>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="bs-callout bs-callout-warning" id="callout-btn-group-tooltips">
                <p>{!! $article->getAttribute('body_'.$locale)  !!}</p>
            </div>
        </div>
    </div>
@endsection