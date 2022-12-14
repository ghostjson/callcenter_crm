@extends('admin2.layout')

@section('main')

    <div id="callBackStats">
        @include('admin2.callbacks.call-back-stats')
    </div>

    <div class="row">
        <div class="col-sm-4">
            <div class="form-group">
                <select id="callEnquiryCampaign" class="form-control select2" onchange="initializeDatatable()">
                    <option value="all">@lang('module_campaign.selectCampaign')</option>
                    @foreach($user->activeCampaigns() as $allCampaign)
                        <option value="{{ $allCampaign->id }}">{{ $allCampaign->name }}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="col-sm-4">
            <div class="form-group">
                <a href="javascript:;" class="btn btn-primary daterange-btn icon-left btn-icon"
                   style="">
                    <span>@lang('app.chooseDate')</span>
                </a>
            </div>
        </div>
    </div>

    <div class="row mt-4">
        <div class="data-table-responsive-wrapper">
            <table id="users-table" class="data-table nowrap w-100" style="padding: 0">
                <thead class="mt-2">
                <tr>
                    <th class="text-muted text-small text-uppercase">@lang('app.id')</th>
                    <th class="text-muted text-small text-uppercase">@lang('module_lead.referenceNumber')</th>
                    <th class="text-muted text-small text-uppercase">@lang('module_call_enquiry.contactPerson')</th>
                    <th class="text-muted text-small text-uppercase">@lang('module_user.email')</th>
                    <th class="text-muted text-small text-uppercase">@lang('app.campaign')</th>
                    <th class="text-muted text-small text-uppercase">@lang('module_call_enquiry.callbackTime')</th>
                    <th class="text-muted text-small text-uppercase">@lang('module_call_enquiry.callingAgent')</th>
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
    <script src="{{ asset('assets/modules/datatables/datatables.min.js') }}"></script>
    <script
        src="{{ asset('assets/modules/datatables/DataTables-1.10.16/js/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('assets/modules/datatables/Select-1.2.4/js/dataTables.select.min.js') }}"></script>
    <script src="{{ asset('assets/modules/select2/dist/js/select2.full.min.js') }}"></script>
    <script src="{{ asset('assets/modules/bootstrap-daterangepicker/daterangepicker.js') }}"></script>

    <script src="{{ asset('assets/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('assets/js/responsive.bootstrap.min.js') }}"></script>
    <script>
        var table = $('#users-table');
        var startDate = '';
        var endDate = '';

        // Setting initial date for daterange picker
        //$('.daterange-btn span').html(moment().startOf('month').format('MMMM D, YYYY') + ' - ' + moment().endOf('month').format('MMMM D, YYYY'));


        $('.daterange-btn').daterangepicker({
            ranges: {
                'Today': [moment(), moment()],
                'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
                'Last 7 Days': [moment().subtract(6, 'days'), moment()],
                'Last 30 Days': [moment().subtract(29, 'days'), moment()],
                'This Month': [moment().startOf('month'), moment().endOf('month')],
                'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
            },
            locale: {
                cancelLabel: '{{ __('app.clear') }}'
            }
        }, function (start, end) {
            $('.daterange-btn span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));
            startDate = start.format('Y-MM-DD');
            endDate = end.format('Y-MM-DD');
            initializeDatatable();
        });

        $('.daterange-btn').on('cancel.daterangepicker', function (ev, picker) {

            startDate = '';
            endDate = '';

            $('.daterange-btn').val('');
            $('.daterange-btn span').html('{{ __('app.chooseDate') }}');
            initializeDatatable();
        });

        $(function () {
            initializeDatatable();
        });

        function initializeDatatable(self) {
            var campaign_id = $('#callEnquiryCampaign').val();
            var fetchType = typeof self !== 'undefined' ? self : 'all';

            table.dataTable({
                responsive: true,
                processing: true,
                serverSide: true,
                bDestroy: true,
                ajax: '{!! route('admin2.get-callbacks') !!}?campaign_id=' + campaign_id + "&start_date=" + startDate + "&end_date=" + endDate + "&fetch_type=" + fetchType,
                aaSorting: [[5, "asc"]],
                language: {
                    "url": "@lang('app.datatable')"
                },
                "fnDrawCallback": function (oSettings) {
                    $("body").tooltip({
                        selector: '[data-toggle="tooltip"]'
                    });
                },
                columns: [
                    {data: 'lead_id', name: 'lead_id'},
                    {data: 'reference_number', name: 'leads.reference_number'},
                    {data: 'contact_person', name: 'contact_person', sortable: false},
                    {data: 'email', name: 'email', sortable: false},
                    {data: 'campaign_name', name: 'campaigns.name'},
                    {data: 'callback_time', name: 'callbacks.callback_time'},
                    {data: 'calling_agent', name: 'users.first_name'},
                    {data: 'action', name: 'action'}
                ]
            });
        }

        function selectDateRange(startDatePick, endDatePick) {
            $('.daterange-btn').data('daterangepicker').setStartDate(moment(startDatePick));
            $('.daterange-btn').data('daterangepicker').setEndDate(moment(endDatePick));

            $('.daterange-btn span').html(moment(startDatePick, 'YYYY-MM-DD').format('MMMM D, YYYY') + ' - ' + moment(endDatePick, 'YYYY-MM-DD').format('MMMM D, YYYY'));
            startDate = moment(startDatePick, 'YYYY-MM-DD').format('Y-MM-DD');
            endDate = moment(endDatePick, 'YYYY-MM-DD').format('Y-MM-DD');
            initializeDatatable('self');
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
            }).then(function (isConfirm) {

                if (isConfirm) {
                    var campaign_id = $('#callEnquiryCampaign').val();
                    var token = "{{ csrf_token() }}";

                    var url = "{{ route('admin2.callmanager.skip-delete', ':id') }}?delete_callback=yes&campaign_id=" + campaign_id;
                    url = url.replace(':id', id);

                    $.easyAjax({
                        type: 'POST',
                        url: url,
                        data: {'_token': token},
                        success: function (response) {
                            if (response.status == "success") {
                                $('#callBackStats').html(response.data.stats);
                                table._fnDraw();
                            }
                        }
                    });
                }

            });
        }

        function cancelCallback(id) {
            swal({
                title: "{{ trans('module_call_enquiry.cancelCallback') }}?",
                text: "{{ trans('module_call_enquiry.cancelCallbackMessage') }}",
                dangerMode: true,
                icon: 'warning',
                buttons: {
                    cancel: "{{ trans('app.no') }}",
                    confirm: {
                        text: "{{ trans('app.yes') }}",
                        value: true,
                        visible: true,
                        className: "danger"
                    }
                }
            }).then(function (isConfirm) {

                if (isConfirm) {
                    var campaign_id = $('#callEnquiryCampaign').val();
                    var token = "{{ csrf_token() }}";

                    var url = "{{ route('admin2.callmanager.cancel-callback', ':id') }}?cancel_callback=yes";
                    url = url.replace(':id', id);

                    $.easyAjax({
                        type: 'POST',
                        url: url,
                        data: {'_token': token},
                        success: function (response) {
                            if (response.status == "success") {
                                $('#callBackStats').html(response.data.stats);
                                table._fnDraw();
                            }
                        }
                    });
                }

            });
        }

        function viewLead(id) {
            var url = '{{ route('admin2.callmanager.view-lead', ':id') }}';
            url = url.replace(':id', id);
            $.ajaxModal('#addEditModal', url)
        }
    </script>
@endsection
