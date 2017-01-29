@extends('layouts.app')

@section('content')
    <script>
        init.push(function(){
            $(document).on('click', 'button.btn-delete', function(){
                var id = $(this).data('id');
                var dialog = $('#deleteDialog');

                dialog
                    .find('button.btn-ok')
                    .off('click')
                    .click(function() {
                        $('#deleteForm').attr('action', '{{ url('category') }}/'+id).submit();
                    });

                dialog.modal('show');
            });

            $(document).on('click', 'button.btn-edit', function(){
                var id = $(this).data('id');
                var enName = $(this).parent().parent().find('div').eq(0).text();
                var arName = $(this).parent().parent().find('div').eq(1).text();
                var dialog = $('#editDialog');

                dialog.find('#editForm'). attr('action', '{{ url('category') }}/'+id);
                dialog.find('#eNameEn').val(enName.trim());
                dialog.find('#eNameAr').val(arName.trim());

                dialog.modal('show');
            });
        });
    </script>

    <div class="row">
        <div class="col-md-offset-2 col-md-8">
            <div class="panel panel-info">
                <div class="panel-heading">
                    <h3 class="panel-title">{{ trans('page.category_manage').' - '.trans('page.'.$type) }}</h3>
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

                    <form action="{{ url('category') }}" method="post" class="form-horizontal">
                        {{ csrf_field() }}
                        <input type="hidden" name="type" value="{{ $type }}">

                        <div class="form-group">
                            <div class="row">
                                <label class="control-label col-sm-4">{{ trans('page.category') }} - {{ trans('page.en') }}</label>
                                <div class="col-md-8">
                                    <input class="form-control" type="text" maxlength="100" name="name-en" />
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <label class="control-label col-sm-4">{{ trans('page.category') }} - {{ trans('page.ar') }}</label>
                                <div class="col-md-8">
                                    <input class="form-control" type="text" maxlength="100" name="name-ar" />
                                </div>
                            </div>
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

    <div class="row">
        <div class="col-md-offset-2 col-md-8">
            <div class="panel panel-info">

                <div class="panel-body">
                    <div class="form-group form-group-lg">
                        <label class="col-sm-5 control-label">{{ trans('page.en') }}</label>
                        <label class="col-sm-5 control-label">{{ trans('page.ar') }}</label>
                        <label class="col-sm-2 control-label">#</label>
                    </div>

                @foreach ($categories as $category)
                    <div class="form-group" style="margin-top: 0; margin-bottom: 0;">
                        <div class="row">
                            <hr>
                        </div>
                        <div class="row">
                            <div class="col-md-5">
                                {{ @$category->name_en }}
                            </div>
                            <div class="col-md-5">
                                {{ @$category->name_ar }}
                            </div>
                            <div class="col-md-2">
                                <button class="btn btn-xs btn-edit btn-warning" data-id="{{ $category->id }}">{{ trans('page.edit') }}</button>
                                <button class="btn btn-xs btn-danger btn-delete" data-id="{{ $category->id }}">{{ trans('page.delete') }}</button>
                            </div>
                        </div>
                    </div>

                    @endforeach

                </div>
            </div>
        </div>
    </div>


    <form id="deleteForm" action="{{ url('category/delete') }}" method="post">
        {{ csrf_field() }}
        {{ method_field('DELETE') }}
        <input type="hidden" name="type" value="{{ $type }}" />
    </form>

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

    <div class="modal fade" tabindex="-1" id="editDialog" role="dialog" aria-labelledby="gridSystemModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="gridSystemModalLabel">{{ trans('page.delete') }}</h4>
                </div>
                <form method="post" id="editForm">
                    <div class="modal-body">
                        {{ csrf_field() }}
                        {{ method_field('PUT') }}
                        <input type="hidden" name="type" value="{{ $type }}" />
                        <div class="form-group">
                            <div class="row">
                                <label for="eNameEn" class="control-label col-sm-4">{{ trans('page.add_category') }} - {{ trans('page.en') }}</label>
                                <div class="col-md-8">
                                    <input class="form-control" type="text" maxlength="100" name="e-name-en" id="eNameEn"/>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <label for="eNameAr" class="control-label col-sm-4">{{ trans('page.add_category') }} - {{ trans('page.ar') }}</label>
                                <div class="col-md-8">
                                    <input class="form-control" type="text" maxlength="100" name="e-name-ar" id="eNameAr"/>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">{{ trans('page.cancel') }}</button>
                        <button type="submit" class="btn btn-warning">{{ trans('page.save') }}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection