@extends('layouts.app')

@section('content')
    <script src="//cdn.tinymce.com/4/tinymce.min.js"></script>
    <script>
        init.push(function(){
            tinymce.init({
                selector:'textarea',
                height: 400,
                menubar: false
            });
        });
    </script>

    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-info">
                <div class="panel-heading">
                    <h3 class="panel-title">{{ $title }}</h3>
                </div>
                <div class="panel-body">
                    @if (count($errors)>0)
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ url('content').(isset($id)? '/'.$id: '') }}" method="post" class="form-horizontal">
                        {{ csrf_field() }}
                        @if (isset($id))
                        {{ method_field('PUT') }}
                        @endif
                        <div class="form-group">
                            <div class="row">
                                <label class="control-label col-sm-4">{{ trans('page.title') }} - {{ trans('page.en') }}</label>
                                <div class="col-md-8">
                                    <input class="form-control" type="text" maxlength="100" name="title-en" value="{{ $old['title-en'] ?: '' }}" />
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <label class="control-label col-sm-4">{{ trans('page.title') }} - {{ trans('page.ar') }}</label>
                                <div class="col-md-8">
                                    <input class="form-control" type="text" maxlength="100" name="title-ar" value="{{ $old['title-ar'] ?: '' }}" />
                                </div>
                            </div>
                            <hr>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <label class="control-label col-sm-4">{{ trans('page.select_category') }} </label>
                                <div class="col-md-8">
                                    <select class="form-control" name="category-id" value="{{ $old['category-id'] ?: '' }}" >
                                        @foreach ($cates as $cate)
                                        <option value="{{ $cate->id }}">{{ $cate->getAttribute('name_'.$locale) }}</option>

                                        @endforeach

                                    </select>
                                </div>
                            </div>
                            <hr>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <label class="control-label col-sm-4">{{ trans('page.keywords') }} - {{ trans('page.ar') }}</label>
                                <div class="col-md-8">
                                    <input class="form-control" type="text" maxlength="255" name="keywords" value="{{ $old['keywords'] ?: '' }}" />
                                    <span class="help-block">{{ trans('page.keywords_helper') }}</span>
                                </div>
                            </div>
                            <hr>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <label class="control-label col-sm-4">{{ trans('page.excerpt') }} - {{ trans('page.en') }}</label>
                                <div class="col-md-8">
                                    <input class="form-control" type="text" maxlength="200" name="excerpt-en" value="{{ $old['excerpt-en'] ?: '' }}" />
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <label class="control-label col-sm-4">{{ trans('page.excerpt') }} - {{ trans('page.ar') }}</label>
                                <div class="col-md-8">
                                    <input class="form-control" type="text" maxlength="200" name="excerpt-ar" value="{{ $old['excerpt-ar'] ?: '' }}" />
                                </div>
                            </div>
                            <hr>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <label class="control-label col-sm-4">{{ trans('page.body') }} - {{ trans('page.en') }}</label>
                                <div class="col-md-8">
                                    <textarea class="form-control" name="body-en" id="body-en">{{ $old['body-en'] ?: '' }}</textarea>
                                </div>
                            </div>
                            <hr>
                        </div>

                        <div class="form-group">
                            <div class="row">
                                <label class="control-label col-sm-4">{{ trans('page.body') }} - {{ trans('page.ar') }}</label>
                                <div class="col-md-8">
                                    <textarea class="form-control" name="body-ar" id="body-ar">{{ $old['body-ar'] ? $old['body-ar']: '' }}</textarea>
                                </div>
                            </div>
                            <hr>
                        </div>

                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-offset-4 col-md-8">
                                    <button class="btn btn-primary" type="submit">{{ trans('page.add_new') }}</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection