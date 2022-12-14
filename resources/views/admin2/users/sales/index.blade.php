@extends('admin2.layout')

@section('main')

    <link rel="stylesheet" href="//cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css">

    @if($user->ability('admin', 'sales_member_create'))
        <div class="row">
            <div class="col-sm-6">
                <div class="form-group">
                    <a href="javascript:void(0);" onclick="addModal()" class="btn btn-icon icon-left btn-primary"><i
                            class="fa fa-plus"></i> @lang('module_user.addNewUser') </a>
                </div>
            </div>
        </div>
    @endif

    <div class="row mt-2">
        <div class="data-table-responsive-wrapper">
            <table id="users-table" class="data-table nowrap w-100" style="padding: 0">
                <thead>
                <tr>
                    <th class="text-muted text-small text-uppercase">@lang('app.id')</th>
                    <th class="text-muted text-small text-uppercase">@lang('module_user.name')</th>
                    <th class="text-muted text-small text-uppercase">@lang('module_user.email')</th>
                    <th class="text-muted text-small text-uppercase">@lang('app.createdAt')</th>
                    <th class="text-muted text-small text-uppercase">@lang('app.action')</th>
                </tr>
                </thead>
            </table>
        </div>
    </div>

@endsection

@section('modals')
    @include('admin2.partials.add-edit-modal')
@endsection

@section('scripts')
    <script src="//cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>

    <script>
        var table = $('#users-table');

        $(function () {
            table.dataTable({
                responsive: true,
                processing: true,
                serverSide: true,
                ajax: '{!! route('admin2.get-sales-users') !!}',
                aaSorting: [[0, "desc"]],
                language: {
                    "url": "@lang('app.datatable')"
                },
                "fnDrawCallback": function (oSettings) {
                    $("body").tooltip({
                        selector: '[data-toggle="tooltip"]'
                    });
                },
                columns: [
                    {data: 'id', name: 'id'},
                    {data: 'first_name', name: 'first_name'},
                    {data: 'email', name: 'email'},
                    {data: 'created_at', name: 'created_at'},
                    {data: 'action', name: 'action'}
                ]
            });

        });

        @if($user->ability('admin', 'sales_member_delete'))
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
            }).then(function (isConfirm) {
                if (isConfirm) {

                    var url = "{{ route('admin2.sales-users.destroy',':id') }}";
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

        @if($user->ability('admin', 'sales_member_create,sales_member_edit'))

        @if($user->ability('admin', 'sales_member_create'))
        function addModal() {
            $.ajaxModal('#addEditModal', '{{ route('admin2.sales-users.create') }}');
        }
        @endif

        @if($user->ability('admin', 'sales_member_edit'))
        function editModal(id) {
            var url = '{{ route('admin2.sales-users.edit', ':id') }}';
            url = url.replace(':id', id);
            $.ajaxModal('#addEditModal', url)
        }
        @endif

        function addOrEditUser(id) {

            @if($user->ability('admin', 'sales_member_edit'))
            if (typeof id != 'undefined') {
                var url = "{{route('admin2.sales-users.update',':id')}}";
                url = url.replace(':id', id);
            }
            @endif

                @if($user->ability('admin', 'sales_member_create'))
            if (typeof id == 'undefined') {
                url = "{{ route('admin2.sales-users.store') }}";
            }
            @endif

            $.easyAjax({
                type: 'POST',
                url: url,
                file: true,
                container: "#user-add-edit-form",
                messagePosition: "toastr",
                success: function (response) {
                    if (response.status == "success") {
                        $('#addEditModal').modal('hide');
                        table._fnDraw();
                    }
                }
            });
        }

        @endif

    </script>
@endsection
