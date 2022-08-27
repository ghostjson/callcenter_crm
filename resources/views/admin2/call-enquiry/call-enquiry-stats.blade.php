@if(isset($yourCampaigns))
    <div class="col-lg-3 col-md-6 col-sm-6 col-12">
        <div class="card hover-border-primary">
            <div class="h-100 row g-0 card-body align-items-center" style="padding: 1em">
                <div class="col-auto">
                    <div class="bg-gradient-2 sw-6 sh-6 rounded-xl d-flex justify-content-center align-items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20" fill="none"
                             stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"
                             class="cs-icon cs-icon-mushrooms text-white">
                            <path
                                d="M3 9.03141C3 5.48815 4.49999 3 10 3C15.5 3 17 5.48815 17 9.0314C16.5 13.0745 13.5 9.63702 10 9.63702C6.49999 9.63702 3.5 13.0745 3 9.03141Z"></path>
                            <path
                                d="M7 14.4444C7 11.9898 8.875 10 10 10C11.125 10 13 11.9898 13 14.4444C13 16.899 12.7083 18 10 18C7.29166 18 7 16.899 7 14.4444Z"></path>
                        </svg>
                    </div>
                </div>
                <div class="col">
                    <div
                        class="heading mb-0 sh-8 d-flex align-items-center lh-1-25 ps-3">@lang('module_call_enquiry.yourCampaigns')</div>
                </div>
                <div class="col-auto ps-3">
                    <div class="text-primary">{{ $yourCampaigns }}</div>
                </div>
            </div>
        </div>
    </div>
@endif

@if(isset($campaignMemberCount))
    <div class="col-lg-3 col-md-6 col-sm-6 col-12">
        <div class="card hover-border-primary">
            <div class="h-100 row g-0 card-body align-items-center" style="padding: 1em">
                <div class="col-auto">
                    <div class="bg-gradient-2 sw-6 sh-6 rounded-xl d-flex justify-content-center align-items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20" fill="none"
                             stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"
                             class="cs-icon cs-icon-mushrooms text-white">
                            <path
                                d="M3 9.03141C3 5.48815 4.49999 3 10 3C15.5 3 17 5.48815 17 9.0314C16.5 13.0745 13.5 9.63702 10 9.63702C6.49999 9.63702 3.5 13.0745 3 9.03141Z"></path>
                            <path
                                d="M7 14.4444C7 11.9898 8.875 10 10 10C11.125 10 13 11.9898 13 14.4444C13 16.899 12.7083 18 10 18C7.29166 18 7 16.899 7 14.4444Z"></path>
                        </svg>
                    </div>
                </div>
                <div class="col">
                    <div
                        class="heading mb-0 sh-8 d-flex align-items-center lh-1-25 ps-3">@lang('module_campaign.campaignMembers')</div>
                </div>
                <div class="col-auto ps-3">
                    <div class="text-primary">{{ $campaignMemberCount }}</div>
                </div>
            </div>
        </div>
    </div>
@endif

<div class="col-lg-3 col-md-6 col-sm-6 col-12">
    <div class="card hover-border-primary">
        <div class="h-100 row g-0 card-body align-items-center" style="padding: 1em">
            <div class="col-auto">
                <div class="bg-gradient-2 sw-6 sh-6 rounded-xl d-flex justify-content-center align-items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20" fill="none"
                         stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"
                         class="cs-icon cs-icon-mushrooms text-white">
                        <path
                            d="M3 9.03141C3 5.48815 4.49999 3 10 3C15.5 3 17 5.48815 17 9.0314C16.5 13.0745 13.5 9.63702 10 9.63702C6.49999 9.63702 3.5 13.0745 3 9.03141Z"></path>
                        <path
                            d="M7 14.4444C7 11.9898 8.875 10 10 10C11.125 10 13 11.9898 13 14.4444C13 16.899 12.7083 18 10 18C7.29166 18 7 16.899 7 14.4444Z"></path>
                    </svg>
                </div>
            </div>
            <div class="col">
                <div
                    class="heading mb-0 sh-8 d-flex align-items-center lh-1-25 ps-3">@lang('module_call_enquiry.totalLeads')</div>
            </div>
            <div class="col-auto ps-3">
                <div class="text-primary">{{ $totalLeads }}</div>
            </div>
        </div>
    </div>
</div>
<div class="col-lg-3 col-md-6 col-sm-6 col-12">
    <div class="card hover-border-primary">
        <div class="h-100 row g-0 card-body align-items-center" style="padding: 1em">
            <div class="col-auto">
                <div class="bg-gradient-2 sw-6 sh-6 rounded-xl d-flex justify-content-center align-items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20" fill="none"
                         stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"
                         class="cs-icon cs-icon-mushrooms text-white">
                        <path
                            d="M3 9.03141C3 5.48815 4.49999 3 10 3C15.5 3 17 5.48815 17 9.0314C16.5 13.0745 13.5 9.63702 10 9.63702C6.49999 9.63702 3.5 13.0745 3 9.03141Z"></path>
                        <path
                            d="M7 14.4444C7 11.9898 8.875 10 10 10C11.125 10 13 11.9898 13 14.4444C13 16.899 12.7083 18 10 18C7.29166 18 7 16.899 7 14.4444Z"></path>
                    </svg>
                </div>
            </div>
            <div class="col">
                <div
                    class="heading mb-0 sh-8 d-flex align-items-center lh-1-25 ps-3">@lang('module_call_enquiry.callMade')</div>
            </div>
            <div class="col-auto ps-3">
                <div class="text-primary">{{ $yourLeads }}</div>
            </div>
        </div>
    </div>
</div>
<div class="col-lg-3 col-md-6 col-sm-6 col-12">
    <div class="card hover-border-primary">
        <div class="h-100 row g-0 card-body align-items-center" style="padding: 1em">
            <div class="col-auto">
                <div class="bg-gradient-2 sw-6 sh-6 rounded-xl d-flex justify-content-center align-items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20" fill="none"
                         stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"
                         class="cs-icon cs-icon-mushrooms text-white">
                        <path
                            d="M3 9.03141C3 5.48815 4.49999 3 10 3C15.5 3 17 5.48815 17 9.0314C16.5 13.0745 13.5 9.63702 10 9.63702C6.49999 9.63702 3.5 13.0745 3 9.03141Z"></path>
                        <path
                            d="M7 14.4444C7 11.9898 8.875 10 10 10C11.125 10 13 11.9898 13 14.4444C13 16.899 12.7083 18 10 18C7.29166 18 7 16.899 7 14.4444Z"></path>
                    </svg>
                </div>
            </div>
            <div class="col">
                <div
                    class="heading mb-0 sh-8 d-flex align-items-center lh-1-25 ps-3">@lang('module_call_enquiry.totalDuration')</div>
            </div>
            <div class="col-auto ps-3">
                <div
                    class="text-primary">{{ $totalTimes > 0 ? \App\Classes\Common::secondsToStr($totalTimes) : '-' }}</div>
            </div>
        </div>
    </div>
</div>
