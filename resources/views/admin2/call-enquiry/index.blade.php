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
        <div class="col-md-3">
            <div class="form-group">
                <select id="searchFieldBy" class="form-control select2">
                    <option value="">@lang('module_call_enquiry.searchBy')</option>
                </select>
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                <input type="text" id="searchFieldValue" class="form-control" placeholder="@lang('module_campaign.enterSearchTerm')">
            </div>
        </div>
        <div class="col-md-2">
            <div class="form-group">
                <a href="javascript:void(0);" onclick="initializeDatatable()" class="btn btn-icon btn-block icon-left btn-primary"><i class="fa fa-search"></i> @lang('app.search') </a>
            </div>
        </div>
    </div>

    <div class="row mt-4" id="campaignStats">
        @include('admin2.call-enquiry.call-enquiry-stats')
    </div>


<div class="row mt-4">
    <div class="col">
        <div class="data-table-responsive-wrapper">
            <table id="users-table" class="data-table nowrap w-100" style="padding: 0">
                <thead>
                <tr>
                    <th class="text-muted text-small text-uppercase">@lang('app.id')</th>
                    <th class="text-muted text-small text-uppercase">@lang('module_lead.referenceNumber')</th>
                    <th class="text-muted text-small text-uppercase">@lang('module_call_enquiry.contactPerson')</th>
                    <th class="text-muted text-small text-uppercase">@lang('module_user.email'))</th>
                    <th class="text-muted text-small text-uppercase">@lang('app.campaign')</th>
                    <th class="text-muted text-small text-uppercase">@lang('module_call_enquiry.callingAgent')</th>
                    <th class="text-muted text-small text-uppercase">@lang('app.action')</th>
                </tr>
                </thead>
            </table>
        </div>
    </div>
</div>
@endsection



@section('modals')
    @include('admin.includes.add-edit-modal')
@endsection

@section('scripts')
    <script src="{{ asset('assets/modules/datatables/datatables.min.js') }}"></script>
    <script src="{{ asset('assets/modules/datatables/DataTables-1.10.16/js/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('assets/modules/datatables/Select-1.2.4/js/dataTables.select.min.js') }}"></script>
    <script src="{{ asset('assets/modules/select2/dist/js/select2.full.min.js') }}"></script>

    <script src="{{ asset('assets/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('assets/js/responsive.bootstrap.min.js') }}"></script>
    <script>
        var table = $('#users-table');

        $(function() {
            initializeDatatable();
        });

        function initializeDatatable() {
            var campaign_id = $('#callEnquiryCampaign').val();
            var form_field_id = $('#searchFieldBy').val();
            var form_field_value = $('#searchFieldValue').val();

            table.dataTable({
                responsive: true,
                processing: true,
                serverSide: true,
                bDestroy:true,
                searching: false,
                info: false,
                ajax: '{!! route('admin.get-call-enquiry') !!}?campaign_id='+campaign_id+'&form_field_id='+form_field_id+'&form_field_value='+form_field_value+'&from_page=enquiry',
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
                    { data: 'email', name: 'email', sortable: false},
                    { data: 'campaign_name', name: 'campaigns.name'},
                    { data: 'calling_agent', name: 'users.first_name'},
                    { data: 'action', name: 'action'}
                ]
            });
        }

        function callEnquiryCampaignSelected() {
            var id = $('#callEnquiryCampaign').val();

            var url = "{{ route('admin.call-enquiry.campaign-form-field',':id') }}";
            url = url.replace(':id', id);

            var token = "{{ csrf_token() }}";

            $.easyAjax({
                type: 'POST',
                url: url,
                data: {'_token': token},
                container: "#call-enquiry-form",
                success: function (response) {
                    if (response.status == "success") {
                        console.log(response.data.stats)
                        $('#searchFieldBy').html(response.data.html);
                        $('#campaignStats').html(response.data.stats);
                        $('#searchFieldValue').val('');

                        initializeDatatable();
                    }
                }
            });
        }

        function deleteLead(id) {
            swal({
                title: "{{ trans('module_call_enquiry.deleteLead') }}?",
                text: "{{ trans('module_call_enquiry.deleteTextMessage') }}",
                dangerMode: true,
                icon: 'warning',
                buttons: {
                    cancel: "{{ trans('app.noCancelIt') }}",
                    confirm: {
                        text: "{{ trans('app.yesDeleteIt') }}",
                        value: true,
                        visible: true,
                        className: "danger"
                    }
                }
            }).then(function(isConfirm) {

                if (isConfirm)
                {
                    var campaign_id = $('#callEnquiryCampaign').val();
                    var token = "{{ csrf_token() }}";

                    var url = "{{ route('admin.callmanager.skip-delete', ':id') }}?delete=yes&campaign_id="+campaign_id;
                    url = url.replace(':id', id);

                    $.easyAjax({
                        type: 'POST',
                        url: url,
                        data: {'_token': token},
                        success: function (response) {
                            if (response.status == "success") {
                                $('#campaignStats').html(response.data.stats);
                                table._fnDraw();
                            }
                        }
                    });
                }

            });
        }

        function viewLead (id) {
            var url = '{{ route('admin.callmanager.view-lead', ':id') }}';
            url      = url.replace(':id',id);
            $.ajaxModal('#addEditModal', url)
        }
    </script>
@endsection
