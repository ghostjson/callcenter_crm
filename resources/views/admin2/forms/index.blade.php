@extends('admin2.layout')

@section('main')

    @if($user->ability('admin', 'form_create'))
    <div class="row">
        <div class="col-sm-6">
            <div class="form-group">
                <a href="{{ route('admin2.forms.create') }}" class="btn btn-icon icon-left btn-primary"><i class="fa fa-plus"></i> @lang('module_form.addNewForm') </a>
            </div>
        </div>
    </div>
    @endif

    <div class="row mt-4">
        <div class="col-12">
            <div class="data-table-responsive-wrapper">
                <table id="users-table" class="data-table nowrap w-100" style="padding: 0">
                    <thead>
                    <tr>
                        <th class="text-muted text-small text-uppercase">@lang('app.id')</th>
                        <th class="text-muted text-small text-uppercase">@lang('module_form.formName')</th>
                        <th class="text-muted text-small text-uppercase">@lang('module_form.fields')</th>
                        <th class="text-muted text-small text-uppercase">@lang('app.createdBy')</th>
                        <th class="text-muted text-small text-uppercase">@lang('app.createdAt')</th>
                        <th class="text-muted text-small text-uppercase">@lang('app.action')</th>
                    </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>

@endsection

@section('modals')
    @include('admin2.partials.add-edit-modal')
@endsection

@section('scripts')
<script src="{{ asset('assets/modules/datatables/datatables.min.js') }}"></script>
<script src="{{ asset('assets/modules/datatables/DataTables-1.10.16/js/dataTables.bootstrap4.min.js') }}"></script>
<script src="{{ asset('assets/modules/datatables/Select-1.2.4/js/dataTables.select.min.js') }}"></script>
<script src="{{ asset('assets/modules/jquery-ui/jquery-ui.min.js') }}"></script>

<script src="{{ asset('assets/js/dataTables.responsive.min.js') }}"></script>
<script src="{{ asset('assets/js/responsive.bootstrap.min.js') }}"></script>
<script>
    var table = $('#users-table');

    $(function() {
        table.dataTable({
            responsive: true,
            processing: true,
            serverSide: true,
            ajax: '{!! route('admin2.get-forms') !!}',
            aaSorting: [[0, "desc"]],
            language: {
                "url": "@lang('app.datatable')"
            },
            "fnDrawCallback": function( oSettings ) {
                $("body").tooltip({
                    selector: '[data-toggle="tooltip"]'
                });
            },
            columns: [
                { data: 'id', name: 'forms.id'},
                { data: 'form_name', name: 'forms.form_name'},
                { data: 'fields', name: 'forms.field_name'},
                { data: 'creator', name: 'creator.first_name'},
                { data: 'created_at', name: 'forms.created_at'},
                { data: 'action', name: 'action'}
            ]
        });

    });

    @if($user->ability('admin', 'form_delete'))
    function deleteModal(id) {
            swal({
                title: "{{ trans('app.areYouSure') }}",
                text: "{{ trans('app.areYouSure') }}",
                dangerMode: true,
                icon: 'warning',
                buttons: {
                    cancel: "{{ trans('app.noCancelIt') }}",
                    confirm: {
                        text: "{{ trans('app.yesDeleteIt') }}",
                        value: true,
                        visible: true,
                        className: "danger",
                    }
                },
            }).then(function(isConfirm) {
                if (isConfirm) {

                    var url = "{{ route('admin2.forms.destroy',':id') }}";
                    url = url.replace(':id', id);

                    var token = "{{ csrf_token() }}";

                    $.easyAjax({
                        type: 'DELETE',
                        url: url,
                        data: {'_token': token},
                        success: function (response) {
                            if (response.status == "success") {
                                swal("@lang('app.deleted')!", response.message, "success");
                                table._fnDraw();
                            }
                        }
                    });
                }
            });
        };
    @endif
</script>
@endsection
