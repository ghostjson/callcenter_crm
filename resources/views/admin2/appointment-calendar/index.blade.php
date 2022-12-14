@extends('admin2.layout')

@section('main')

    <div class="row">
        <div class="col-sm-4">
            <div class="form-group">
                <select id="search_campaign" class="form-control select2" onchange="searchAppointment()">
                    <option value="">@lang('module_campaign.selectCampaign')</option>
                    @foreach($user->activeCampaigns() as $allCampaign)
                        <option value="{{ $allCampaign->id }}">{{ $allCampaign->name }}</option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="col-sm-4">
            <div class="form-group">
                <select id="search_sales_member" class="form-control select2" onchange="searchAppointment()">
                    <option value="">@lang('module_campaign.selectSalesMember')</option>
                    @foreach($allSalesMembers as $allSalesMember)
                        <option value="{{ $allSalesMember->id }}">{{ trim($allSalesMember->first_name . ' ' . $allSalesMember->last_name) }}</option>
                    @endforeach
                </select>
            </div>
        </div>
    </div>

    <div class="row mt-4">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div id="calendar"></div>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('modals')
    @include('admin2.partials.add-edit-modal')
@endsection

@section('scripts')

    <script>

        $(document).ready(function (){
            const calendarElement = $('#calendar')
            const calendar = new FullCalendar.Calendar(calendarElement, {
                initialView: 'dayGridMonth'
            })

            calendar.render()
        })

    {{--$("#bookingEvents").fullCalendar({--}}
    {{--    height: 'auto',--}}
    {{--    header: {--}}
    {{--        left: 'prev,next',--}}
    {{--        center: 'title',--}}
    {{--        right: 'month,agendaWeek,agendaDay'--}}
    {{--    },--}}
    {{--    events: {--}}
    {{--        url: "{{ route('admin2.get-appointments') }}",--}}
    {{--        method: 'POST',--}}
    {{--        data: function() {--}}
    {{--            return {--}}
    {{--                _token: '{{ csrf_token() }}',--}}
    {{--                campaign_id: $('#search_campaign').val(),--}}
    {{--                salesman_id: $('#search_sales_member').val()--}}
    {{--            };--}}
    {{--        }--}}
    {{--    },--}}
    {{--    eventClick: function(calEvent, jsEvent, view) {--}}

    {{--        var id = calEvent.appointment_id;--}}
    {{--        var url = '{{ route('admin2.appointments.edit', ':id') }}';--}}
    {{--        url      = url.replace(':id',id);--}}
    {{--        $.ajaxModal('#addEditModal', url);--}}
    {{--    }--}}

    {{--});--}}

    {{--function searchAppointment() {--}}
    {{--    $('#bookingEvents').fullCalendar('refetchEvents');--}}
    {{--}--}}

    {{--function editAppointment(id) {--}}

    {{--    var url  ="{{route('admin2.appointments.update',':id')}}";--}}
    {{--    url      = url.replace(':id',id);--}}

    {{--    $.easyAjax({--}}
    {{--        type: 'POST',--}}
    {{--        url: url,--}}
    {{--        file: true,--}}
    {{--        container: "#appointment-edit-form",--}}
    {{--        messagePosition: "toastr",--}}
    {{--        success: function(response) {--}}
    {{--            if (response.status == "success") {--}}
    {{--                $('#addEditModal').modal('hide');--}}
    {{--                searchAppointment();--}}
    {{--            }--}}
    {{--        }--}}
    {{--    });--}}
    {{--}--}}

    {{--function deleteAppointment(id) {--}}
    {{--    swal({--}}
    {{--        title: "{{ trans('app.areYouSure') }}",--}}
    {{--        text: "{{ trans('module_campaign.deleteAppointmentText') }}",--}}
    {{--        dangerMode: true,--}}
    {{--        icon: 'warning',--}}
    {{--        buttons: {--}}
    {{--            cancel: "{{ trans('app.no') }}",--}}
    {{--            confirm: {--}}
    {{--                text: "{{ trans('app.yesDeleteIt') }}",--}}
    {{--                value: true,--}}
    {{--                visible: true,--}}
    {{--                className: "danger",--}}
    {{--            }--}}
    {{--        },--}}
    {{--    }).then(function(isConfirm) {--}}
    {{--        if (isConfirm) {--}}

    {{--            var url = "{{ route('admin2.appointments.destroy',':id') }}";--}}
    {{--            url = url.replace(':id', id);--}}

    {{--            var token = "{{ csrf_token() }}";--}}

    {{--            $.easyAjax({--}}
    {{--                type: 'DELETE',--}}
    {{--                url: url,--}}
    {{--                data: {'_token': token},--}}
    {{--                success: function (response) {--}}
    {{--                    if (response.status == "success") {--}}
    {{--                        swal("@lang('app.deleted')!", response.message, "success");--}}
    {{--                        $('#addEditModal').modal('hide');--}}
    {{--                        searchAppointment();--}}
    {{--                    }--}}
    {{--                }--}}
    {{--            });--}}
    {{--        }--}}
    {{--    });--}}
    {{--};--}}
</script>
@endsection
