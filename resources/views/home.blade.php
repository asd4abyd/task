@extends('layouts.app')

@section('content')
    <script src="{{ url('js/text-slider.js') }}" ></script>
    <script>
        init.push(function(){
            $('.slide').textSlider();
        });
    </script>
    <div class="row">
        <div class="col-md-10">
            <div class="jumbotron">

                <div class="slide">
                    @foreach($articles as $article)
                    <div class="slider-item">
                        <h1><a href="{{ url('article').'/'.$article->id }}">{{ $article->getAttribute('title_'.$locale) }}</a></h1>
                        <p class="lead">{{ $article->getAttribute('excerpt_'.$locale) }}</p>
                    </div>
                    @endforeach

                </div>

            </div>
        </div>
        <div class="col-md-2">
            <div class="dropdown theme-dropdown clearfix">
                <ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
                    <li class="active"><a href="javascript:void()">{{ trans('page.articles') . ' ' . trans('page.category')  }}</a></li>
                    <li role="separator" class="divider"></li>
                    @foreach($cates as $cate)
                    <li><a href="{{ url('blog').'/'.$cate->id }}">{{ $cate->getAttribute('name_'.$locale) }}</a></li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
@endsection

