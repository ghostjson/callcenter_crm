@extends('admin2.layout')

@section('main')
    <div class="row">
        <div class="col-12">
            <div class="mb-5">
                <div class="row g-2">

                    <div class="col-12 col-sm-4 col-lg-4">
                        <div class="card sh-11 hover-scale-up cursor-pointer">
                            <div class="h-100 row g-0 card-body align-items-center py-3">
                                <div class="col-auto pe-3">
                                    <div
                                        class="bg-gradient-2 sh-5 sw-5 rounded-xl d-flex justify-content-center align-items-center">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="white"
                                             class="bi bi-briefcase" viewBox="0 0 16 16">
                                            <path
                                                d="M6.5 1A1.5 1.5 0 0 0 5 2.5V3H1.5A1.5 1.5 0 0 0 0 4.5v8A1.5 1.5 0 0 0 1.5 14h13a1.5 1.5 0 0 0 1.5-1.5v-8A1.5 1.5 0 0 0 14.5 3H11v-.5A1.5 1.5 0 0 0 9.5 1h-3zm0 1h3a.5.5 0 0 1 .5.5V3H6v-.5a.5.5 0 0 1 .5-.5zm1.886 6.914L15 7.151V12.5a.5.5 0 0 1-.5.5h-13a.5.5 0 0 1-.5-.5V7.15l6.614 1.764a1.5 1.5 0 0 0 .772 0zM1.5 4h13a.5.5 0 0 1 .5.5v1.616L8.129 7.948a.5.5 0 0 1-.258 0L1 6.116V4.5a.5.5 0 0 1 .5-.5z"/>
                                        </svg>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="row gx-2 d-flex align-content-center">
                                        <div class="col-12 col-xl d-flex">
                                            <div
                                                class="p mb-0 d-flex align-items-center lh-1-25">@lang('module_call_enquiry.yourCampaigns')</div>
                                        </div>
                                        <div class="col-12 col-xl-auto">
                                            <div class="cta-2 text-primary">{{ $yourCampaigns }}</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-12 col-sm-4 col-lg-4">
                        <div class="card sh-11 hover-scale-up cursor-pointer">
                            <div class="h-100 row g-0 card-body align-items-center py-3">
                                <div class="col-auto pe-3">
                                    <div
                                        class="bg-gradient-2 sh-5 sw-5 rounded-xl d-flex justify-content-center align-items-center">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="white"
                                             class="bi bi-phone" viewBox="0 0 16 16">
                                            <path
                                                d="M11 1a1 1 0 0 1 1 1v12a1 1 0 0 1-1 1H5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1h6zM5 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2H5z"/>
                                            <path d="M8 14a1 1 0 1 0 0-2 1 1 0 0 0 0 2z"/>
                                        </svg>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="row gx-2 d-flex align-content-center">
                                        <div class="col-12 col-xl d-flex">
                                            <div
                                                class="p mb-0 d-flex align-items-center lh-1-25">@lang('module_call_enquiry.callMade')</div>
                                        </div>
                                        <div class="col-12 col-xl-auto">
                                            <div class="cta-2 text-primary">{{ $yourLeads }}</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-12 col-sm-4 col-lg-4">
                        <div class="card sh-11 hover-scale-up cursor-pointer">
                            <div class="h-100 row g-0 card-body align-items-center py-3">
                                <div class="col-auto pe-3">
                                    <div
                                        class="bg-gradient-2 sh-5 sw-5 rounded-xl d-flex justify-content-center align-items-center">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="white"
                                             class="bi bi-alarm" viewBox="0 0 16 16">
                                            <path
                                                d="M8.5 5.5a.5.5 0 0 0-1 0v3.362l-1.429 2.38a.5.5 0 1 0 .858.515l1.5-2.5A.5.5 0 0 0 8.5 9V5.5z"/>
                                            <path
                                                d="M6.5 0a.5.5 0 0 0 0 1H7v1.07a7.001 7.001 0 0 0-3.273 12.474l-.602.602a.5.5 0 0 0 .707.708l.746-.746A6.97 6.97 0 0 0 8 16a6.97 6.97 0 0 0 3.422-.892l.746.746a.5.5 0 0 0 .707-.708l-.601-.602A7.001 7.001 0 0 0 9 2.07V1h.5a.5.5 0 0 0 0-1h-3zm1.038 3.018a6.093 6.093 0 0 1 .924 0 6 6 0 1 1-.924 0zM0 3.5c0 .753.333 1.429.86 1.887A8.035 8.035 0 0 1 4.387 1.86 2.5 2.5 0 0 0 0 3.5zM13.5 1c-.753 0-1.429.333-1.887.86a8.035 8.035 0 0 1 3.527 3.527A2.5 2.5 0 0 0 13.5 1z"/>
                                        </svg>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="row gx-2 d-flex align-content-center">
                                        <div class="col-12 col-xl d-flex">
                                            <div
                                                class="p mb-0 d-flex align-items-center lh-1-25">@lang('module_call_enquiry.totalDuration')</div>
                                        </div>
                                        <div class="col-12 col-xl-auto">
                                            <div
                                                class="cta-2 text-primary">{{ $totalTimes > 0 ? \App\Classes\Common::secondsToStr($totalTimes): '-' }}</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12 mb-5">
            <section class="scroll-section" id="checkboxes">
                <div class="d-flex justify-content-between">
                    <h2 class="small-title">@lang('module_campaign.bookedApointment')</h2>
                    <div class="btn-group check-all-container mt-n1">
                        <a href="{{ route('admin.appointments.index') }}"
                           class="btn btn-sm btn-outline-primary dropdown-toggle dropdown-toggle-split"
                        >@lang('app.viewAll')</a>
                    </div>
                </div>
                <div class="card mb-2 bg-transparent no-shadow d-none d-md-block sh-3">
                    <div class="card-body pt-0 pb-0 h-100">
                        <div class="row g-0 h-100 align-content-center">
                            <div class="col-12 col-md-3 d-flex align-items-center mb-2 mb-md-0 text-muted text-small">
                                @lang('app.campaign')
                            </div>
                            <div
                                class="col-6 col-md-2 d-flex align-items-center text-alternate text-medium justify-content-end text-muted text-small">
                                @lang('module_campaign.salesMember')
                            </div>
                            <div
                                class="col-6 col-md-2 d-flex align-items-center justify-content-end text-alternate text-medium justify-content-end text-muted text-small">
                                @lang('module_campaign.appointmentTime')
                            </div>
                            <div
                                class="col-6 col-md-2 d-flex align-items-center text-alternate text-medium justify-content-end text-muted text-small">
                                @lang('app.action')
                            </div>
                        </div>
                    </div>
                </div>
                <div class="scroll-out">
                    <div
                        class="scroll-by-count os-host os-theme-dark os-host-overflow os-host-overflow-y os-host-resize-disabled os-host-scrollbar-horizontal-hidden os-host-transition"
                        data-count="5" id="checkboxTable" style="height: 288px; margin-bottom: -8px;">
                        <div class="os-resize-observer-host observed">
                            <div class="os-resize-observer" style="left: 0px; right: auto;"></div>
                        </div>
                        <div class="os-size-auto-observer observed" style="height: calc(100% + 1px); float: left;">
                            <div class="os-resize-observer"></div>
                        </div>
                        <div class="os-content-glue" style="margin: 0px -15px;"></div>
                        <div class="os-padding">
                            <div class="os-viewport os-viewport-native-scrollbars-invisible"
                                 style="overflow-y: scroll;">
                                <div class="os-content" style="padding: 0px 15px; height: 100%; width: 100%;">

                                    @foreach($bookedAppointments as $bookedAppointment)
                                        <div class="card mb-2 sh-19 sh-md-8">
                                            <div class="card-body pt-0 pb-0 h-100">
                                                <div class="row g-0 h-100 align-content-center">
                                                    <div
                                                        class="col-11 col-md-3 d-flex flex-column justify-content-center mb-1 mb-md-0 order-1 order-md-1">
                                                        <div
                                                            class="text-muted text-small d-md-none">@lang('app.campaign')</div>
                                                        <a href="{{ route('admin.campaigns.show', md5($bookedAppointment->campaign_id)) }}"
                                                           class="text-truncate">{{ $bookedAppointment->campaign_name }}</a>
                                                    </div>
                                                    <div
                                                        class="col-6 col-md-2 d-flex flex-column justify-content-center align-items-md-end mb-1 mb-md-0 order-3 order-md-2">
                                                        <div
                                                            class="text-muted text-small d-md-none">@lang('module_campaign.salesMember')</div>
                                                        <div
                                                            class="text-alternate">{{ trim($bookedAppointment->first_name .' ' . $bookedAppointment->last_name) }}
                                                        </div>
                                                    </div>
                                                    <div
                                                        class="col-6 col-md-2 d-flex flex-column justify-content-center align-items-md-end mb-1 mb-md-0 order-4 order-md-3">
                                                        <div
                                                            class="text-muted text-small d-md-none">@lang('module_campaign.appointmentTime')</div>
                                                        <div
                                                            class="text-alternate">{{ $bookedAppointment->appointment_time->timezone($user->timezone)->format($user->date_format .' ' . $user->time_format) }}
                                                        </div>
                                                    </div>
                                                    <div
                                                        class="col-6 col-md-2 d-flex flex-column justify-content-center align-items-md-end mb-1 mb-md-0 order-4 order-md-3">
                                                        <div
                                                            class="text-muted text-small d-md-none">@lang('app.campaign')</div>
                                                        <a href="{{ route('admin.callmanager.lead', [md5($bookedAppointment->lead_id)]) }}">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="16"
                                                                 height="16" fill="currentColor" class="bi bi-play-fill"
                                                                 viewBox="0 0 16 16">
                                                                <path
                                                                    d="m11.596 8.697-6.363 3.692c-.54.313-1.233-.066-1.233-.697V4.308c0-.63.692-1.01 1.233-.696l6.363 3.692a.802.802 0 0 1 0 1.393z"/>
                                                            </svg>
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                        <div
                            class="os-scrollbar os-scrollbar-horizontal os-scrollbar-unusable os-scrollbar-auto-hidden">
                            <div class="os-scrollbar-track os-scrollbar-track-off">
                                <div class="os-scrollbar-handle"
                                     style="width: 100%; transform: translate(0px, 0px);"></div>
                            </div>
                        </div>
                        <div class="os-scrollbar os-scrollbar-vertical os-scrollbar-auto-hidden"
                             style="height: calc(100% - 8px);">
                            <div class="os-scrollbar-track os-scrollbar-track-off">
                                <div class="os-scrollbar-handle"
                                     style="height: 81.8182%; transform: translate(0px, 0px);"></div>
                            </div>
                        </div>
                        <div class="os-scrollbar-corner"></div>
                    </div>
                </div>
            </section>
        </div>

    </div>

@endsection
