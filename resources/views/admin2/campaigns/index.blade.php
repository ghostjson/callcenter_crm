@extends('admin2.layout')

@section('main')
    @include('admin.includes.add-edit-modal')

    @if($user->ability('admin', 'campaign_create'))
        <div class="row">
            <div class="col-sm-6">
                <div class="form-group">
                    <a href="{{ route('admin.campaigns.create') }}" class="btn btn-icon icon-left btn-primary"><i
                            class="fa fa-plus"></i> @lang('module_campaign.addNewCampaign') </a>
                </div>
            </div>
        </div>
    @endif

    <div class="row mt-3">
        <div class="col-12">
            <div class="card mb-5">
                <div class="card-body d-flex justify-content-between">
                    <h3>
                        @if($campaignType == 'active') @lang('module_campaign.activeCampaigns') @else  @lang('module_campaign.completedCampaigns') @endif
                    </h3>
                    <div class="btn-group">
                        <a href="{{ route('admin.campaigns.index') }}?type=active"
                           class="btn btn-primary @if($campaignType == 'active') active @endif"
                           aria-current="page">@lang('module_campaign.activeCampaigns')</a>
                        <a href="{{ route('admin.campaigns.index') }}?type=completed"
                           class="btn btn-primary @if($campaignType == 'completed') active @endif">@lang('module_campaign.completedCampaigns')</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row mt-4">
        <div class="col-12">

            <!-- Content Start -->
            <div class="data-table-rows slim" style="padding: 0;">
                <!-- Controls Start -->
                <div class="row">
                    <!-- Search Start -->
                    <div class="col-sm-12 col-md-5 col-lg-3 col-xxl-2 mb-1">
                        <div
                            class="d-inline-block float-md-start me-1 mb-1 search-input-container w-100 shadow bg-foreground">
                            <input class="form-control datatable-search" placeholder="Search"
                                   data-datatable="#users-table"/>
                            <span class="search-magnifier-icon">
                        <i data-cs-icon="search"></i>
                      </span>
                            <span class="search-delete-icon d-none">
                        <i data-cs-icon="close"></i>
                      </span>
                        </div>
                    </div>
                    <!-- Search End -->

                    <div class="col-sm-12 col-md-7 col-lg-9 col-xxl-10 text-end mb-1">
                        <div class="d-inline-block me-0 me-sm-3 float-start float-md-none">
                            <!-- Add Button Start -->
                            <button
                                class="btn btn-icon btn-icon-only btn-foreground-alternate shadow add-datatable"
                                data-bs-delay="0"
                                data-bs-toggle="tooltip"
                                data-bs-placement="top"
                                title="Add"
                                type="button"
                            >
                                <i data-cs-icon="plus"></i>
                            </button>
                            <!-- Add Button End -->

                            <!-- Edit Button Start -->
                            <button
                                class="btn btn-icon btn-icon-only btn-foreground-alternate shadow edit-datatable disabled"
                                data-bs-delay="0"
                                data-bs-toggle="tooltip"
                                data-bs-placement="top"
                                title="Edit"
                                type="button"
                            >
                                <i data-cs-icon="edit"></i>
                            </button>
                            <!-- Edit Button End -->

                            <!-- Delete Button Start -->
                            <button
                                class="btn btn-icon btn-icon-only btn-foreground-alternate shadow disabled delete-datatable"
                                data-bs-delay="0"
                                data-bs-toggle="tooltip"
                                data-bs-placement="top"
                                title="Delete"
                                type="button"
                            >
                                <i data-cs-icon="bin"></i>
                            </button>
                            <!-- Delete Button End -->
                        </div>
                        <div class="d-inline-block">
                            <!-- Print Button Start -->
                            <button
                                class="btn btn-icon btn-icon-only btn-foreground-alternate shadow datatable-print"
                                data-bs-delay="0"
                                data-datatable="#users-table"
                                data-bs-toggle="tooltip"
                                data-bs-placement="top"
                                title="Print"
                                type="button"
                            >
                                <i data-cs-icon="print"></i>
                            </button>
                            <!-- Print Button End -->

                            <!-- Export Dropdown Start -->
                            <div class="d-inline-block datatable-export" data-datatable="#users-table">
                                <button class="btn p-0" data-bs-toggle="dropdown" type="button" data-bs-offset="0,3">
                          <span
                              class="btn btn-icon btn-icon-only btn-foreground-alternate shadow dropdown"
                              data-bs-delay="0"
                              data-bs-placement="top"
                              data-bs-toggle="tooltip"
                              title="Export"
                          >
                            <i data-cs-icon="download"></i>
                          </span>
                                </button>
                                <div class="dropdown-menu shadow dropdown-menu-end">
                                    <button class="dropdown-item export-copy" type="button">Copy</button>
                                    <button class="dropdown-item export-excel" type="button">Excel</button>
                                    <button class="dropdown-item export-cvs" type="button">Cvs</button>
                                </div>
                            </div>
                            <!-- Export Dropdown End -->

                            <!-- Length Start -->
                            <div class="dropdown-as-select d-inline-block datatable-length"
                                 data-datatable="#users-table" data-childSelector="span">
                                <button class="btn p-0 shadow" type="button" data-bs-toggle="dropdown"
                                        aria-haspopup="true" aria-expanded="false" data-bs-offset="0,3">
                          <span
                              class="btn btn-foreground-alternate dropdown-toggle"
                              data-bs-toggle="tooltip"
                              data-bs-placement="top"
                              data-bs-delay="0"
                              title="Item Count"
                          >
                            10 Items
                          </span>
                                </button>
                                <div class="dropdown-menu shadow dropdown-menu-end">
                                    <a class="dropdown-item" href="#">5 Items</a>
                                    <a class="dropdown-item active" href="#">10 Items</a>
                                    <a class="dropdown-item" href="#">20 Items</a>
                                </div>
                            </div>
                            <!-- Length End -->
                        </div>
                    </div>
                </div>
                <!-- Controls End -->

                <!-- Table start -->
                <div class="data-table-responsive-wrapper">
                    <table id="users-table" class="data-table nowrap w-100" style="padding: 0">
                        <thead>
                        <tr>
                            <th class="text-muted text-small text-uppercase">@lang('app.id')</th>
                            <th class="text-muted text-small text-uppercase">@lang('module_campaign.name')</th>
                            @if($campaignType == 'active')
                                <th class="text-muted text-small text-uppercase">@lang('module_campaign.progress')</th>
                                <th class="text-muted text-small text-uppercase">@lang('module_campaign.campaignMembers')</th>
                                <th class="text-muted text-small text-uppercase">@lang('module_campaign.startedOn')</th>
                                <th class="text-muted text-small text-uppercase">@lang('module_campaign.lastActiveMember')</th>
                            @else
                                <th class="text-muted text-small text-uppercase">@lang('module_campaign.totalLeads')</th>
                                <th class="text-muted text-small text-uppercase">@lang('module_campaign.startedOn')</th>
                                <th class="text-muted text-small text-uppercase">@lang('module_campaign.completedOn')</th>
                            @endif
                            <th class="text-muted text-small text-uppercase">@lang('app.action')</th>
                        </tr>
                        </thead>
                    </table>
                </div>
                <!-- Table ends -->

                <!-- Table End -->
            </div>
            <!-- Content End -->
        </div>
    </div>
@endsection


@section('scripts')
    <script src="{{ asset('assets/modules/datatables/datatables.min.js') }}"></script>
    <script src="{{ asset('assets/modules/datatables/DataTables-1.10.16/js/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('assets/modules/datatables/Select-1.2.4/js/dataTables.select.min.js') }}"></script>
    <script src="{{ asset('assets/modules/jquery-ui/jquery-ui.min.js') }}"></script>
    <script src="{{ asset('assets/modules/bootstrap-fileinput/bootstrap-fileinput.js') }}"></script>

    <script src="{{ asset('assets/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('assets/js/responsive.bootstrap.min.js') }}"></script>
    <script>
        var table = $('#users-table');

        $(function () {
            table.dataTable({
                responsive: true,
                processing: true,
                serverSide: true,
                info: false,
                scrollX: true,
                buttons: ['copy', 'excel', 'csv', 'print'],
                ajax: '{!! route('admin.get-campaigns') !!}?campaign_type={{ $campaignType }}',
                aaSorting: [[0, "desc"]],
                sDom: '<"row"<"col-sm-12"<"table-container"t>r>><"row"<"col-12"p>>',
                language: {
                    "url": "@lang('app.datatable')"
                },
                "fnDrawCallback": function (oSettings) {
                    $("body").tooltip({
                        selector: '[data-toggle="tooltip"]'
                    });

                    $('[data-height]').each(function () {
                        $(this).css({
                            height: $(this).data('height')
                        });
                    });

                    $('[data-width]').each(function () {
                        $(this).css({
                            width: $(this).data('width')
                        });
                    });
                },
                columns: [
                    {data: 'id', name: 'campaigns.id'},
                    {data: 'name', name: 'campaigns.name'},
                        @if($campaignType == 'active')
                    {
                        data: 'progress', name: 'progress', sortable: false
                    },
                    {data: 'members', name: 'members', sortable: false},
                    {data: 'started_on', name: 'campaigns.started_on'},
                    {data: 'last_active_member', name: 'last_active_member', sortable: false, searchable: false},
                        @else
                    {
                        data: 'total_leads', name: 'campaigns.total_leads'
                    },
                    {data: 'started_on', name: 'campaigns.started_on'},
                    {data: 'completed_on', name: 'campaigns.completed_on'},
                        @endif
                    {
                        data: 'action', name: 'action'
                    }
                ]
            });

        });

        function deleteCampaignModal(id) {
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

                    var url = "{{ route('admin.campaigns.destroy',':id') }}";
                    url = url.replace(':id', id);

                    var token = "{{ csrf_token() }}";

                    $.easyAjax({
                        type: 'DELETE',
                        url: url,
                        data: {'_token': token},
                        success: function (response) {
                            if (response.status == "success") {
                                table._fnDraw();
                            }
                        }
                    });
                }
            });
        };

        @if($user->ability('admin', 'campaign_edit'))
        function editCampaignModal(id) {
            var url = '{{ route('admin.campaigns.edit', ':id') }}';
            url = url.replace(':id', id);
            $.ajaxModal('#addEditModal', url)
        }

        function editCampaign(id) {

            var url = "{{route('admin.campaigns.update',':id')}}";
            url = url.replace(':id', id);

            $.easyAjax({
                type: 'POST',
                url: url,
                container: "#campaigns-edit-form",
                data: $('#campaigns-edit-form').serialize(),
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

        @if($user->ability('admin', 'campaign_view_all') || $campaignDetails->created_by == $user->id)
        function addLeadModal(id) {
            var url = "{{ route('admin.campaigns.lead.create', [':id']) }}";
            url = url.replace(':id', id);

            $.ajaxModal('#addEditModal', url);
        }

        function addNewLead(id) {
            var url = "{{ route('admin.campaigns.lead.store', [':id']) }}";
            url = url.replace(':id', id);

            $.easyAjax({
                type: 'POST',
                url: url,
                file: true,
                container: "#lead-add-edit-form",
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
