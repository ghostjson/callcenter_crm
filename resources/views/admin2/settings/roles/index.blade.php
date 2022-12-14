@extends('admin2.layout')

@section('main')

    @include('admin2.partials.update_info')

    <div class="row">
        <div class="col-md-3">
            @include('admin2.partials.setting_sidebar')
        </div>
        <div class="col-md-9">
            <div class="row">
                <div class="col-sm-6">
                    <div class="form-group">
                        <a href="javascript:void(0);" onclick="addModal()" class="btn btn-icon icon-left btn-primary"><i class="fa fa-plus"></i> @lang('module_settings.addNewRole') </a>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="data-table-responsive-wrapper">
                            <table id="data-table" class="data-table nowrap w-100" style="padding: 0">
                                <thead>
                                <tr>
                                    <th class="text-muted text-small text-uppercase">@lang('app.id')</th>
                                    <th class="text-muted text-small text-uppercase">@lang('app.name')</th>
                                    <th class="text-muted text-small text-uppercase">@lang('app.description')</th>
                                    <th class="text-muted text-small text-uppercase">@lang('app.createdAt')</th>
                                    <th class="text-muted text-small text-uppercase">@lang('app.action')</th>
                                </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                </div>
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
    <script src="{{ asset('assets/modules/bootstrap-fileinput/bootstrap-fileinput.js') }}"></script>

    <script src="https://cdn.datatables.net/responsive/2.1.1/js/dataTables.responsive.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.1.1/js/responsive.bootstrap.min.js"></script>
<script>
    var table = $('#data-table');

    $(function() {
        table.dataTable({
            responsive: true,
            processing: true,
            serverSide: true,
            "order": [
                [0, "desc"]
            ],
            ajax: '{!! route('admin2.get-roles') !!}',
            language: {
                "url": "@lang('app.datatable')"
            },
            "fnDrawCallback": function( oSettings ) {
                $("body").tooltip({
                    selector: '[data-toggle="tooltip"]'
                });
            },
            columns: [
                { data: 'id', name: 'id' },
                { data: 'display_name', name: 'display_name' },
                { data: 'description', name: 'description' },
                { data: 'created_at', name: 'created_at' },
                { data: 'action', name: 'action', width: '13%' }
            ]
        });

        $('body').on('click', '.sa-params', function(){
            var id = $(this).data('user-id');
            swal({
                title: "@lang('app.areYouSure')",
                text: "@lang('app.areYouSureText')",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: "#DD6B55",
                confirmButtonText: "@lang('app.yesDeleteIt')",
                cancelButtonText: "@lang('app.noCancelIt')",
                closeOnConfirm: true,
                closeOnCancel: true
            }, function(isConfirm){
                if (isConfirm) {

                    var url = "{{ route('admin2.settings.roles.destroy',':id') }}";
                    url = url.replace(':id', id);

                    var token = "{{ csrf_token() }}";

                    $.easyAjax({
                        type: 'DELETE',
                        url: url,
                        data: {'_token': token},
                        success: function (response) {
                            if (response.status == "success") {
                                $.unblockUI();
                                swal("@lang('app.deleted')!", response.message, "success");
                                table._fnDraw();
                            }
                        }
                    });
                }
            });
        });
    });

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

                var url = "{{ route('admin2.settings.roles.destroy',':id') }}";
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


    function addModal () {
        $.ajaxModal('#addEditModal','{{ route('admin2.settings.roles.create') }}');
    }

    function editModal (id) {
        var url = '{{ route('admin2.settings.roles.edit', ':id') }}';
        url      = url.replace(':id',id);
        $.ajaxModal('#addEditModal', url)
    }

    function addOrEditRole(id) {

        var displayName = $('#display_name').val();
        var name = $('#name').val();
        var description = $('#description').val();

        var permissions = [];
        $('.permissions:checked').each(function()
        {
            permissions.push($(this).attr('permissionID'));
        });


        if(typeof id != 'undefined'){
            var url  ="{{route('admin2.settings.roles.update',':id')}}";
            url      = url.replace(':id',id);
            var requestType = 'PUT';
        }

        if (typeof id == 'undefined'){
            var url = "{{ route('admin2.settings.roles.store') }}";
            var requestType = 'POST';
        }

        $.easyAjax({
            url: url,
            container: '#role-add-edit-form',
            type: requestType,
            data: {"_token": "{{ csrf_token() }}","display_name": displayName,"name":name,"description":description, "permissions":permissions},
            messagePosition: "toastr",
            success: function(response) {
                if (response.status == "success") {
                    $('#addEditModal').modal('hide');
                    table._fnDraw();
                }
            }
        });
    }

</script>
@endsection
