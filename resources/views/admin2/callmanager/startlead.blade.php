@extends('admin2.layout')

@section('main')

    <div class="row">
        <div class="col-12">
            <ul class="nav nav-tabs" id="myTab" role="tablist">
                <li class="nav-item" role="presentation">
                    <button class="nav-link active" id="lead-details-tab" data-bs-toggle="tab"
                            data-bs-target="#lead-details" type="button" role="tab" aria-controls="lead-details"
                            aria-selected="true"> @lang('module_lead.leadDetails')</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="call-history-tab" data-bs-toggle="tab" data-bs-target="#call-history"
                            type="button" role="tab" aria-controls="call-history"
                            aria-selected="false">@lang('module_campaign.callHistory')</button>
                </li>
            </ul>
            <div class="tab-content" id="myTabContent">
                <div class="tab-pane fade show active" id="lead-details" role="tabpanel" aria-labelledby="home-tab">
                    <div class="card radius-regular" style="border-radius: 0">
                        <div class="card-body">
                            <div class="form-row d-flex">
                                <div class="col-md-3">
                                    <div class="row">
                                        <label for="reference_number" class="col-sm-12 col-form-label">
                                            <strong>@lang('app.campaign')</strong> : {{ $campaign->name }}
                                        </label>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="row">
                                        <label for="reference_number" class="col-sm-12 col-form-label">
                                            <strong>@lang('module_lead.leadNumber')</strong> : {{ $leadNumber }}
                                            /{{ $campaign->total_leads }}
                                        </label>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="row">
                                        <label for="reference_number" class="col-sm-12 col-form-label">
                                            <strong>@lang('module_lead.lastActionBy')</strong>
                                            : {{ $lead->lastActioner ? $lead->lastActioner->name : $user->name }}
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xs-12">
                                <hr >
                            </div>
                            <div class="row mt-3">
                                <div class="col-auto">
                                    <form>
                                        <div class="row g-3">
                                            @for($i=0;$i < count($leadWithData);$i += 1)
                                                <div class="col-md-6">
                                                    <label for="custom_field_{{ $i }}"
                                                           class="form-label">{{ $leadWithData[$i]['field_name'] }}</label>
                                                    @if(in_array($leadWithData[$i]['field_name'], $phoneArray))
                                                        <div class="input-group">
                                                            <input type="text" class="form-control"
                                                                   name="fields[{{$leadWithData[$i]['lead_data_id']}}]"
                                                                   id="custom_field_{{ $i }}"
                                                                   value="{{ $leadWithData[$i]['field_value'] }}">
                                                            <button class="btn btn-outline-secondary" type="button"
                                                                    onclick="callThisNumber('custom_field_{{ $i }}')"
                                                                    id="button-addon2">Call
                                                            </button>
                                                        </div>
                                                    @else
                                                        <input type="text" class="form-control"
                                                               name="fields[{{$leadWithData[$i]['lead_data_id']}}]"
                                                               id="custom_field_{{ $i }}"
                                                               value="{{ $leadWithData[$i]['field_value'] }}">
                                                    @endif
                                                </div>
                                            @endfor
                                        </div>
                                        <div class="col-xs-12">
                                            <hr >
                                        </div>
                                        <div class="row g-3 mt-3">

                                            <div class="col-md-6">
                                                <label for="inputState">@lang('module_lead.interested')</label>
                                                <select id="inputState" name="interested" class="form-control">
                                                    <option value="" selected>@lang('app.choose')</option>
                                                    <option value="interested"
                                                            @if($lead->interested == 'interested') selected @endif>@lang('module_lead.interested')</option>
                                                    <option value="not_interested"
                                                            @if($lead->interested == 'not_interested') selected @endif>@lang('module_lead.notInterested')</option>
                                                    <option value="unreachable"
                                                            @if($lead->interested == 'unreachable') selected @endif>@lang('module_lead.unreachable')</option>
                                                </select>

                                            </div>
                                            <div class="col-md-6">
                                                <label for="send_email">@lang('module_lead.sendEmail')</label>
                                                <select id="send_email" name="send_email" class="form-control"
                                                        onchange="sendEmailSelected()">
                                                    <option value="">@lang('module_lead.doNotSendEmail')</option>
                                                    @foreach($emailTemplates as $emailTemplate)
                                                        <option value="{{  $emailTemplate->id }}"
                                                                @if($emailTemplate->id == $lead->email_template_id) selected @endif>{{ $emailTemplate->name }}</option>
                                                    @endforeach
                                                    <option
                                                        value="new">@lang('module_lead.writeAndSendNewEmail')</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-xs-12">
                                            <hr >
                                        </div>
                                        <div class="row mt-3">
                                            <div class="form-group row mb-4">
                                                <label for="book_appointment" class="col-form-label text-md-right col-12 col-md-3 col-lg-3">@lang('module_lead.book_appointment')</label>
                                                <div class="col-sm-12 col-md-5">
                                                    <select id="book_appointment" name="book_appointment" class="form-control" onchange="appointmentChanged()">
                                                        <option value="0" @if($lead->appointment_booked == 0) selected @endif>@lang('app.no')</option>
                                                        <option value="1" @if($lead->appointment_booked == 1) selected @endif>@lang('app.yes')</option>
                                                    </select>
                                                </div>
                                                <div class="col-sm-12 col-md-2 pt-5" id="appointment-view-div">
                                                    @if($lead->appointment_booked == 1)
                                                        <input type="hidden" id="delete_appointment_id" name="delete_appointment_id" value="{{ $appointment->id ?? '' }}">
                                                        <a href="javascript:;" onclick="viewAppointment()">@lang('app.view')</a>
                                                    @endif
                                                </div>
                                            </div>

                                            @foreach($leadWithData1 as $leadWithData1Key => $leadWithData1Value)
                                                <div class="form-group row mb-4">
                                                    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">{{ $leadWithData1Value['field_name'] }}</label>
                                                    <div class="col-sm-12 col-md-7">
                                                        @if(strtolower($leadWithData1Value['field_name']) == 'notes' || strtolower($leadWithData1Value['field_name']) == 'note')
                                                            <textarea class="form-control" name="fields[{{$leadWithData1[$leadWithData1Key]['lead_data_id']}}]" id="custom_field1_{{ $leadWithData1Key }}">{{ $leadWithData1Value['field_value'] }}</textarea>
                                                        @else
                                                            <input type="text" class="form-control" name="fields[{{$leadWithData1[$leadWithData1Key]['lead_data_id']}}]" id="custom_field1_{{ $leadWithData1Key }}" value="{{ $leadWithData1Value['field_value'] }}">
                                                        @endif
                                                    </div>
                                                </div>
                                            @endforeach
                                            <div class="row text-center">
                                                <div class="col-md-6">
                                                    <div class="custom-control custom-checkbox">
                                                        <input type="checkbox" class="custom-control-input" id="follow_up_call" name="follow_up_call" value="1" onchange="followUpChanged()" @if($followUpCall) checked @endif>
                                                        <label class="custom-control-label" for="follow_up_call">@lang('module_lead.followUpCall')</label>


                                                        <div id="follow-up-view-div">
                                                            @if($followUpCall)
                                                                <input type="hidden" id="delete_follow_up_id" name="delete_follow_up_id" value="{{ $followUpCall->id ?? '' }}">
                                                                <a href="javascript:;" onclick="viewFollowUp()">@lang('app.view')</a>
                                                            @endif
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="row">
                                                        <label for="reference_number" class="col-sm-4 col-form-label">@lang('module_lead.referenceNumber')</label>
                                                        <div class="col-sm-7">
                                                            <input type="email" class="form-control" id="reference_number" name="reference_number" value="{{ $lead->reference_number }}">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer footer-bar">
                            <div class="row">
                                <div class="col-12 col-md-5">
                                    <div id="basicUsage" class="timer-clock">00:00:00</div>
                                </div>
                                <div class="col-sm-12 col-md-7">
                                    @if($previousLeadCount > 0)
                                        <button type="button" class="btn btn-icon icon-left btn-warning" onclick="takeLeadAction('back');return false"><i class="fas fa-arrow-left"></i> @lang('app.previous')</button>
                                    @endif
                                    <button type="button" class="btn btn-icon icon-left btn-info" onclick="saveAndExit();return false"><i class="fas fa-save"></i> @lang('module_lead.saveAndExit')</button>
                                    @if($nextLeadCount > 0)
                                        <button type="button" class="btn btn-icon icon-right btn-primary" onclick="takeLeadAction('next');return false">@lang('app.next') <i class="fas fa-arrow-right"></i></button>
                                    @endif
                                    <button type="button" class="btn btn-icon icon-right btn-danger" onclick="skipAndDelete();return false">@lang('module_lead.skip') <i class="fa fa-angle-double-right"></i></button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="tab-pane fade" id="call-history" role="tabpanel" aria-labelledby="profile-tab">
                    <div class="card radius-flat" style="border-radius: 0">
                        <div class="card-body p-0">
                            <table class="table">
                                <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">@lang('module_call_enquiry.callingAgent')</th>
                                    <th scope="col">@lang('module_call_enquiry.duration')</th>
                                    <th scope="col">@lang('module_call_enquiry.calledOn')</th>
                                </tr>
                                </thead>
                                <tbody>
                                @forelse($lead->callLogs as $callHistory)
                                    <tr class="table-bottom-border">
                                        <td>{{ $loop->remaining + 1 }}</td>
                                        <td>{!! \App\Classes\Common::getUserWidget($callHistory->user) !!}</td>
                                        <td>{{ $callHistory->time_taken > 0 ? strtolower(\App\Classes\Common::secondsToStr($callHistory->time_taken)) : '-' }}</td>
                                        <td>{{ $callHistory->created_at->format('d F, Y h:i:s a') }}</td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="3" class="text-center">
                                            @lang('messages.noCallHistoryFound')
                                        </td>
                                    </tr>
                                @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
    </div>
@endsection

@section('scripts')
    <script src="{{ asset('assets/js/easytimer/easytimer.min.js') }}"></script>
    <script src="{{ asset('assets/modules/bootstrap-daterangepicker/daterangepicker.js') }}"></script>
    <script src="{{ asset('assets/modules/bootstrap-timepicker/js/bootstrap-timepicker.min.js') }}"></script>
    <script src="{{ asset('assets/modules/summernote/summernote-bs4.js') }}"></script>
    <script>

        var timer = new easytimer.Timer();
        var timeTaken = {{ $lead->time_taken ?? 0 }};
        timer.start({
            startValues: {seconds: timeTaken}
        });
        timer.addEventListener('secondsUpdated', function (e) {
            $('#basicUsage').html(timer.getTimeValues().toString());

            var timeValue = timer.getTimeValues();
            var totalSeconds = ((timeValue.days) * 24 * 60 * 60) + ((timeValue.hours) * 60 * 60) + ((timeValue.minutes) * 60) + (timeValue.seconds);
            $('#time_taken').val(totalSeconds);
        });

        setInterval(function () {
            var url = "{{ route('admin.callmanager.save-lead', [md5($lead->id)]) }}";

            $.easyAjax({
                type: 'POST',
                url: url,
                container: "#lead-action-form",
                file: true,
                blockUI: false,
                messagePosition: 'none'
            });
        }, 5000);

        function takeLeadAction(action) {
            var url = "{{ route('admin.callmanager.lead-action', [$lead->id, ':action']) }}";
            url = url.replace(':action', action);

            $.easyAjax({
                type: 'POST',
                url: url,
                container: "#lead-action-form",
                messagePosition: "toastr",
                data: $('#lead-action-form').serialize(),
                redirect: true
            });
        }

        function saveAndExit() {
            var url = "{{ route('admin.callmanager.save-lead', [md5($lead->id)]) }}";

            $.easyAjax({
                type: 'POST',
                url: url,
                file: true,
                container: "#lead-action-form",
                messagePosition: "toastr",
                success: function (response) {
                    if (response.status == 'success') {
                        window.location.href = "{{ route('admin.callmanager.index') }}";
                    }
                }
            });
        }

        function skipAndDelete() {
            swal({
                title: "{{ trans('module_campaign.skipAndDelete') }}?",
                text: "{{ trans('module_campaign.skipAndDeleteText') }}",
                dangerMode: true,
                icon: 'warning',
                buttons: {
                    confirm: {
                        text: "{{ trans('module_campaign.skipAndDelete') }}",
                        value: 'confirm',
                        visible: true,
                        className: "success",
                    },
                    skip: {
                        text: "{{ trans('module_campaign.comeBackLater') }}",
                        value: 'skip'
                    },
                    cancel: {
                        text: "{{ trans('app.cancel') }}",
                        value: 'cancel',
                        visible: true
                    }
                },
            }).then(function (isConfirm) {

                if (isConfirm == 'confirm') {
                    var url = "{{ route('admin.callmanager.skip-delete', [md5($lead->id)]) }}";

                    $.easyAjax({
                        type: 'POST',
                        url: url,
                        container: "#lead-action-form",
                        data: $('#lead-action-form').serialize(),
                        redirect: true
                    });
                } else if (isConfirm == 'skip') {
                    var url = "{{ route('admin.callmanager.come-back', [md5($lead->id)]) }}";

                    $.easyAjax({
                        type: 'POST',
                        url: url,
                        container: "#lead-action-form",
                        data: $('#lead-action-form').serialize(),
                        redirect: true
                    });
                }

            });
        }

        // region For Appointment
        function appointmentChanged() {
            var appointmentBooked = $('#book_appointment').val();

            if (appointmentBooked == 1) {
                viewAppointment();
            } else {
                var deleteAppointmentID = $('#delete_appointment_id').val();

                deleteAppointment(deleteAppointmentID);
            }

        }

        function viewAppointment() {
            var url = '{{ route('admin.add-edit-appointments', md5($lead->id)) }}';
            $.ajaxModal('#addEditModal', url);
        }

        function addEditAppointment(id) {

            if (typeof id != 'undefined') {
                var url = "{{route('admin.appointments.update',':id')}}";
                url = url.replace(':id', id);
            }

            if (typeof id == 'undefined') {
                url = "{{ route('admin.appointments.store') }}";
            }

            $.easyAjax({
                type: 'POST',
                url: url,
                file: true,
                container: "#appointment-edit-form",
                messagePosition: "toastr",
                success: function (response) {
                    if (response.status == "success") {
                        $('#appointment-view-div').html(response.data.html);
                        $('#addEditModal').modal('hide');
                    }
                }
            });
        }

        function deleteAppointment(id) {
            swal({
                title: "{{ trans('app.areYouSure') }}",
                text: "{{ trans('module_campaign.deleteAppointmentText') }}",
                dangerMode: true,
                icon: 'warning',
                closeOnClickOutside: false,
                buttons: {
                    cancel: "{{ trans('app.no') }}",
                    confirm: {
                        text: "{{ trans('app.yesDeleteIt') }}",
                        value: true,
                        visible: true,
                        className: "danger",
                    }
                },
            }).then(function (isConfirm) {
                if (isConfirm) {

                    var url = "{{ route('admin.appointments.destroy',':id') }}";
                    url = url.replace(':id', id);

                    var token = "{{ csrf_token() }}";

                    $.easyAjax({
                        type: 'DELETE',
                        url: url,
                        data: {'_token': token},
                        success: function (response) {
                            if (response.status == "success") {
                                $('#appointment-view-div').html('');
                                $('#addEditModal').modal('hide');
                                $('#book_appointment').val(0);
                            }
                        }
                    });
                } else {
                    $('#book_appointment').val(1);
                }
            });
        };

        function cancelAppointmentModal(isBooked) {
            $('#book_appointment').val(isBooked);
            $('#addEditModal').modal('hide');
        }

        // endregion

        // region For Follow Up Call
        function followUpChanged() {

            if ($("#follow_up_call").is(':checked')) {
                viewFollowUp();
            } else {
                var deleteFollowUpID = $('#delete_follow_up_id').val();

                deleteFollowUp(deleteFollowUpID);
            }

        }

        function viewFollowUp() {
            var url = '{{ route('admin.add-edit-callback', md5($lead->id)) }}';
            $.ajaxModal('#addEditModal', url);
        }

        function addEditFollowUp(id) {

            if (typeof id != 'undefined') {
                var url = "{{route('admin.pending-callback.update',':id')}}";
                url = url.replace(':id', id);
            }

            if (typeof id == 'undefined') {
                url = "{{ route('admin.pending-callback.store') }}";
            }

            $.easyAjax({
                type: 'POST',
                url: url,
                file: true,
                container: "#follow-up-edit-form",
                messagePosition: "toastr",
                success: function (response) {
                    if (response.status == "success") {
                        $('#follow-up-view-div').html(response.data.html);
                        $('#addEditModal').modal('hide');
                    }
                }
            });
        }

        function deleteFollowUp(id) {
            swal({
                title: "{{ trans('module_call_enquiry.cancelCallback') }}?",
                text: "{{ trans('module_call_enquiry.cancelCallbackMessage') }}",
                dangerMode: true,
                icon: 'warning',
                closeOnClickOutside: false,
                buttons: {
                    cancel: "{{ trans('app.no') }}",
                    confirm: {
                        text: "{{ trans('app.yes') }}",
                        value: true,
                        visible: true,
                        className: "danger",
                    }
                },
            }).then(function (isConfirm) {
                if (isConfirm) {

                    var url = "{{ route('admin.callmanager.cancel-callback', [md5($lead->id)]) }}";

                    var token = "{{ csrf_token() }}";

                    $.easyAjax({
                        type: 'POST',
                        url: url,
                        data: {'_token': token},
                        success: function (response) {
                            if (response.status == "success") {
                                $('#follow-up-view-div').html('');
                                $('#addEditModal').modal('hide');
                                $('#follow_up_call').prop('checked', false);
                            }
                        }
                    });
                } else {
                    $('#follow_up_call').prop('checked', true);
                }
            });
        };

        function cancelFollowUpModal(isBooked) {
            $('#follow_up_call').prop('checked', isBooked);
            $('#addEditModal').modal('hide');
        }

        // endregion

        // region Send Email

        function sendEmailSelected() {
            var selectedEmailTemplate = $('#send_email').val();

            var url = '{{ route('admin.email-templates.write-edit-email', [md5($lead->id)]) }}';

            if (selectedEmailTemplate != '') {
                url = url + '/' + selectedEmailTemplate;

                $.ajaxModal('#addEditModal', url);
            }
        }

        function sendMail() {
            var url = '{{ route('admin.email-templates.send-mail', [md5($lead->id)]) }}';

            $.easyAjax({
                url: url,
                container: '#send-mail-form',
                type: "POST",
                messagePosition: "inline",
                data: $('#send-mail-form').serialize(),
                success: function (response) {
                    if (response.status == "success") {
//                    $('#addEditModal').modal('hide');
                    }
                }
            })
        }

        // endregion

        function callThisNumber(id) {
            var mobile = $('#' + id).val();
            console.log(mobile);
            callCustomer(mobile);
        }
    </script>
@endsection
