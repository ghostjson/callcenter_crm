@if($unactionedPendingCallbacks > 0)
    <div class="row">
        <div class="col-12">
            <div class="alert alert-danger" role="alert">
                <h4 class="alert-heading">@lang('app.actionRequired')</h4>
                <p>
                    {{ $unactionedPendingCallbacks }} @lang('module_call_enquiry.unactionedCallBackMessage')
                </p>
                <hr>
                <p class="mb-0"><a href="javascript:void(0);" onclick="selectDateRange('{{ $lastCallBackDate }}', '{{ $todayDatePicker }}')" class="btn btn-warning btn-xl mb-1"><i class="fa fa-check"></i> @lang('app.clickHereToView')</a></p>
            </div>
        </div>
    </div>
@endif

@if($todayPendingCallbacks > 0)
    <div class="row">
        <div class="col-12">
            <div class="alert alert-warning" role="alert">
                <h4 class="alert-heading">@lang('app.warning')</h4>
                <p>
                    {{ $todayPendingCallbacks }} @lang('module_call_enquiry.todayPendingCallBackMessage')
                </p>
                <hr>
                <p class="mb-0"><a href="javascript:void(0);" onclick="selectDateRange('{{ $todayDate }}', '{{ $todayDate }}')" class="btn btn-outline-white btn-lg btn-icon icon-left"><i class="fa fa-check"></i> @lang('app.clickHereToView')</a></p>
            </div>
        </div>
    </div>
@endif
