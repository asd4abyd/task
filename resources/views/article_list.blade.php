@extends('layouts.app')

@section('content')
    <style>
        .pagination {
            margin: 0;
        }

        ul.article-list li {
            padding: 0px 15px;
        }

        ul.article-list li:hover {
            background-color: rgba(46, 109, 164, 0.77);
            color: rgb(205, 207, 216);
            cursor: pointer;
        }

        ul.article-list a{
            text-decoration: none;
            color: inherit;
        }
    </style>

    <div class="col-sm-12">
        <ul class="list-group article-list">
            @foreach ($articles as $article)
            <li class="list-group-item">
                <a href="{{ url('article').'/'.$article->id }}">
                    <div class="row">
                        <div class="col-md-10"><h4>{{ $article->getAttribute('title_'.$locale) }}</h4></div>
                        <div class="col-md-2"><h4>{{ $article->category->getAttribute('name_'.$locale) }}</h4></div>
                        <div class="col-md-offset-1 col-md-11"><p>{!! $article->getAttribute('excerpt_'.$locale)  !!}</p></div>
                    </div>
                </a>
            </li>
            @endforeach

            @if ($articles->total()>$articles->perPage())
            <li class="list-group-item">
                {!! $articles->render() !!}
            </li>
            @endif
        </ul>
    </div>
@endsection