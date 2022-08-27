@extends('admin2.layout')

@section('main')
    <div class="row" id="call-enquiry-form">
        <div class="col-md-3">
            <div class="form-group">
                <select id="callEnquiryCampaign" class="form-control select2" onchange="callEnquiryCampaignSelected()">
                    <option value="all">@lang('module_campaign.selectCampaign')</option>
                    @foreach($user->activeCampaigns() as $allCampaign)
                        <option value="{{ $allCampaign->id }}">{{ $allCampaign->name }}</option>
                    @endforeach
                </select>
            </div>
        </div>
        @if($user->ability('admin', 'campaign_view_all'))
            <div class="col-md-3">
                <div class="form-group">
                    <select id="searchTeamMemberBy" class="form-control select2" onchange="initializeDatatable()">
                        <option value="">@lang('module_lead.selectTeamMember')</option>
                        @foreach($campaignTeamMembers as $campaignTeamMember)
                            <option value="{{ $campaignTeamMember->id }}">{{ $campaignTeamMember->name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        @endif
    </div>

    <div class="row mt-4">
        <div class="col">
            <div class="data-table-responsive-wrapper">
                <table id="users-table" class="data-table nowrap w-100" style="padding: 0">
                    <thead>
                    <tr>
                        <th class="text-muted text-small text-uppercase">@lang('app.id')</th>
                        <th class="text-muted text-small text-uppercase">@lang('module_lead.referenceNumber')</th>
                        <th class="text-muted text-small text-uppercase">@lang('module_lead.leadDetails')</th>
                        <th class="text-muted text-small text-uppercase">@lang('module_lead.callDetails')</th>
                        <th class="text-muted text-small text-uppercase">@lang('app.campaign')</th>
                        <th class="text-muted text-small text-uppercase">@lang('module_call_enquiry.lastCallingAgent')</th>
                        <th class="text-muted text-small text-uppercase">@lang('app.action')</th>
                    </tr>
                    </thead>
                </table>
            </div>
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

        $(function() {
            initializeDatatable();
        });

        function initializeDatatable() {
            var campaign_id = $('#callHistoryCampaign').val();
            var url = '{!! route('admin2.get-call-history') !!}?campaign_id='+campaign_id+'&from_page=enquiry';

            @if($user->ability('admin', 'campaign_view_all'))
            var team_member_id = $('#searchTeamMemberBy').val();
            url += '&team_member_id='+team_member_id;
            @endif

            table.dataTable({
                responsive: true,
                processing: true,
                serverSide: true,
                bDestroy:true,
                ajax: url,
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
                    { data: 'lead_id', name: 'lead_id'},
                    { data: 'reference_number', name: 'leads.reference_number'},
                    { data: 'contact_person', name: 'contact_person', sortable: false},
                    { data: 'time_taken', name: 'time_taken', sortable: false},
                    { data: 'campaign_name', name: 'campaigns.name'},
                    { data: 'calling_agent', name: 'users.first_name'},
                    { data: 'action', name: 'action'}
                ]
            });
        }

        function callHistoryCampaignSelected() {
            var id = $('#callHistoryCampaign').val();

            var url = "{{ route('admin2.call-history.campaign-team-member',':id') }}";
            url = url.replace(':id', id);

            var token = "{{ csrf_token() }}";

            $.easyAjax({
                type: 'POST',
                url: url,
                data: {'_token': token},
                container: "#call-enquiry-form",
                success: function (response) {
                    if (response.status == "success") {
                        $('#searchTeamMemberBy').html(response.data.html);

                        initializeDatatable();
                    }
                }
            });
        }

        function viewLead (id) {
            var url = '{{ route('admin2.callmanager.view-lead', ':id') }}';
            url      = url.replace(':id',id);
            $.ajaxModal('#addEditModal', url)
        }
    </script>
@endsection
