@extends('layouts.app')

@section('content')
    <style>
        .pagination {
            margin: 0;
        }
    </style>
    <script>
        init.push(function(){
            $(document).on('click', 'button.btn-delete', function(){
                var id = $(this).data('id');
                var dialog = $('#deleteDialog');

                dialog
                        .find('button.btn-ok')
                        .off('click')
                        .click(function() {
                            $('#deleteForm').attr('action', '{{ url('content') }}/'+id).submit();
                        });

                dialog.modal('show');
            });
        });
    </script>


    <form id="deleteForm" action="{{ url('content/delete') }}" method="post">
        {{ csrf_field() }}
        {{ method_field('DELETE') }}
    </form>

    <div class="col-sm-12 text-right">
        <a href="{{ url('content/add') }}" type="button" class="btn  btn-primary">{{ trans('page.add_new') }}</a>
    </div>
    <div class="clearfix"></div>
    <br />

    <div class="col-sm-12">
        <ul class="list-group">
            <li class="list-group-item active">
                <div class="row">
                    <div class="col-md-5">{{ trans('page.title') }}</div>
                    <div class="col-md-5">{{ trans('page.category') }}</div>
                    <div class="col-md-2 text-center">#</div>
                </div>
            </li>
            @foreach ($articles as $article)
            <li class="list-group-item">
                <div class="row">
                    <div class="col-md-5">{{ $article->getAttribute('title_'.$locale) }}</div>
                    <div class="col-md-5">{{ $article->category->getAttribute('name_'.$locale) }}</div>
                    <div class="col-md-2 text-center">
                        <a href="{{ url('/content').'/'.$article->id }}" class="btn btn-xs btn-edit btn-warning" data-id="{{ $article->id }}">{{ trans('page.edit') }}</a>
                        <button class="btn btn-xs btn-danger btn-delete" data-id="{{ $article->id }}">{{ trans('page.delete') }}</button>
                    </div>
                </div>
            </li>
            @endforeach

            @if ($articles->total()>$articles->perPage())
            <li class="list-group-item">
                {!! $articles->render() !!}
            </li>
            @endif
        </ul>
    </div>


    <div class="modal fade" tabindex="-1" id="deleteDialog" role="dialog" aria-labelledby="gridSystemModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="gridSystemModalLabel">{{ trans('page.delete') }}</h4>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">{{ trans('page.delete_message') }}</div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">{{ trans('page.confirm') }}</div>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">{{ trans('page.cancel') }}</button>
                    <button type="button" class="btn btn-danger btn-ok" data-dismiss="modal">{{ trans('page.delete') }}</button>
                </div>
            </div>
        </div>
    </div>

@endsection