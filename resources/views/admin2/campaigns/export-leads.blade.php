@extends('admin2.layout')


@section('main')

    <div class="row">
        <div class="col-sm-3">
            <div class="form-group">
                <select id="searchCampaignType" name="campaign_type" class="form-control select2" onchange="initializeDatatable()">
                    <option value="all">@lang('module_campaign.allCampaigns')</option>
                    <option value="active">@lang('module_campaign.activeCampaigns')</option>
                    <option value="completed">@lang('module_campaign.completedCampaigns')</option>
                </select>
            </div>
        </div>
    </div>

    <div class="row mt-4">
        <div class="col">
            <div class="data-table-responsive-wrapper">
                <table id="ajax-table" class="data-table nowrap w-100" style="padding: 0">
                    <thead>
                    <tr>
                        <th class="text-muted text-small text-uppercase">@lang('app.id')</th>
                        <th class="text-muted text-small text-uppercase">@lang('module_campaign.name')</th>
                        <th class="text-muted text-small text-uppercase">@lang('module_campaign.startedOn')</th>
                        <th class="text-muted text-small text-uppercase">@lang('module_campaign.totalLeads')</th>
                        <th class="text-muted text-small text-uppercase">@lang('module_campaign.remainingLeads')</th>
                        <th class="text-muted text-small text-uppercase">@lang('app.export')</th>
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
    <script src="{{ asset('assets/modules/select2/dist/js/select2.full.min.js') }}"></script>
    <script src="{{ asset('assets/modules/datatables/DataTables-1.10.16/js/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('assets/modules/datatables/Select-1.2.4/js/dataTables.select.min.js') }}"></script>
    <script src="{{ asset('assets/modules/jquery-ui/jquery-ui.min.js') }}"></script>

    <script src="{{ asset('assets/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('assets/js/responsive.bootstrap.min.js') }}"></script>
    <script>
        var table = $('#ajax-table');

        $(function() {
            initializeDatatable();
        });

        function initializeDatatable() {
            var campaignType = $('#searchCampaignType').val();
            var url = "{{ route('admin2.campaigns.get-export-leads') }}?campaign_type=" + campaignType;

            table.dataTable({
                responsive: true,
                processing: true,
                serverSide: true,
                bDestroy:true,
                searchable: false,
                info: false,
                ajax: url,
                "order": [
                    [0, "desc"]
                ],
                "fnDrawCallback": function( oSettings ) {
                    $("body").tooltip({
                        selector: '[data-toggle="tooltip"]'
                    });
                },
                language: {
                    "url": "@lang('app.datatable')"
                },
                columns: [
                    { data: 'id', name: 'campaigns.id'},
                    { data: 'name', name: 'campaigns.name'},
                    { data: 'started_on', name: 'campaigns.started_on'},
                    { data: 'total_leads', name: 'campaigns.total_leads'},
                    { data: 'remaining_leads', name: 'campaigns.remaining_leads'},
                    { data: 'export', name: 'export', sortable: false}
                ]
            });
        }

        function downloadExportLeadData(id)
        {
            location.href  = "{{ route('admin2.campaigns.download-export-leads') }}?campaign_id="+id;
        }

    </script>
@endsection
