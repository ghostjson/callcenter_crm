@extends('admin2.layout')


@section('main')

    <div class="row">
        <div class="col-12">
            <div class="card mb-5">
                <div class="card-body d-flex justify-content-between">
                    <h3>
                        Active Campaigns
                    </h3>
                    <div class="btn-group">
                        <a href="{{ route('admin.callmanager.index') }}"
                           class="btn btn-primary @if($type == 'active') active @endif"
                           aria-current="page">@lang('module_campaign.activeCampaigns')</a>
                        <a href="{{ route('admin.callmanager.index') }}?type=completed"
                           class="btn btn-primary @if($type == 'completed') active @endif">@lang('module_campaign.completedCampaigns')</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row" id="campaigns_lists">
        @if($type == 'active')
            @forelse($userCampaigns as $userCampaign)
                <div class="col-12 col-md-12 col-lg-6">
                    <div class="card card-success profile-widget">
                        <div class="card-header">
                            <h4>
                                <a href="{{ route('admin.campaigns.show', [md5($userCampaign->id)]) }}"> {{ $userCampaign->name }}</a>
                            </h4>
                        </div>
                        <div class="row mt-2" style="padding-left: 10px">
                            <div class="col-4 mb-5">
                                <div class="card hover-border-primary sh-20 sw-20">
                                    <div
                                        class="h-100 d-flex flex-column justify-content-between card-body align-items-center">
                                        <div
                                            class="bg-gradient-2 sw-6 sh-6 rounded-xl d-flex justify-content-center align-items-center">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                                                 viewBox="0 0 20 20" fill="none" stroke="white" stroke-width="1.5"
                                                 stroke-linecap="round" stroke-linejoin="round"
                                                 class="cs-icon cs-icon-alarm d-inline-block text-primary">
                                                <circle cx="10" cy="10" r="7"></circle>
                                                <path
                                                    d="M16 2 18 4M4 2 2 4M7 17 6 18M13 17 14 18M8 12 9.70711 10.2929C9.89464 10.1054 10 9.851 10 9.58579V6"></path>
                                            </svg>
                                        </div>
                                        <div
                                            class="heading text-center mb-0 sh-4 d-flex align-items-center lh-1">{{ $userCampaign->remaining_leads ?? '-' }}</div>
                                        <div class="text-small text-primary">@lang('app.remaining')</div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-4 mb-5">
                                <div class="card hover-border-primary sh-20 sw-20">
                                    <div
                                        class="h-100 d-flex flex-column justify-content-between card-body align-items-center">
                                        <div
                                            class="bg-gradient-2 sw-6 sh-6 rounded-xl d-flex justify-content-center align-items-center">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                                                 viewBox="0 0 20 20" fill="none" stroke="white" stroke-width="1.5"
                                                 stroke-linecap="round" stroke-linejoin="round"
                                                 class="cs-icon cs-icon-check d-inline-block text-primary">
                                                <path
                                                    d="M16 5L7.7051 14.2166C7.32183 14.6424 6.65982 14.6598 6.2547 14.2547L3 11"></path>
                                            </svg>
                                        </div>
                                        <div
                                            class="heading text-center mb-0 sh-4 d-flex align-items-center lh-1">{{ $userCampaign->total_leads -  $userCampaign->remaining_leads }}</div>
                                        <div class="text-small text-primary">@lang('app.completed')</div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-4 mb-5">
                                <div class="card hover-border-primary sh-20 sw-20">
                                    <div
                                        class="h-100 d-flex flex-column justify-content-between card-body align-items-center">
                                        <div
                                            class="bg-gradient-2 sw-6 sh-6 rounded-xl d-flex justify-content-center align-items-center">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                                                 viewBox="0 0 20 20" fill="none" stroke="white" stroke-width="1.5"
                                                 stroke-linecap="round" stroke-linejoin="round"
                                                 class="cs-icon cs-icon-list d-inline-block text-primary">
                                                <path d="M8 3 18 3M8 10 18 10M8 17 18 17"></path>
                                                <path
                                                    d="M2 3C2 2.44772 2.44772 2 3 2V2C3.55228 2 4 2.44772 4 3V3C4 3.55228 3.55228 4 3 4V4C2.44772 4 2 3.55228 2 3V3zM2 10C2 9.44772 2.44772 9 3 9V9C3.55228 9 4 9.44772 4 10V10C4 10.5523 3.55228 11 3 11V11C2.44772 11 2 10.5523 2 10V10zM2 17C2 16.4477 2.44772 16 3 16V16C3.55228 16 4 16.4477 4 17V17C4 17.5523 3.55228 18 3 18V18C2.44772 18 2 17.5523 2 17V17z"></path>
                                            </svg>
                                        </div>
                                        <div
                                            class="heading text-center mb-0 sh-4 d-flex align-items-center lh-1">{{ $userCampaign->total_leads ?? '-' }}</div>
                                        <div class="text-small text-primary">@lang('app.total')</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-4">@lang('module_campaign.startedOn')</div>
                                <div class="col-md-8">
                                    <strong>{{ $userCampaign->started_on != NULL ? $userCampaign->started_on->format('d F, Y') : '-' }}</strong>
                                </div>
                            </div>
                            <div class="row pt-4">
                                <div class="col-md-4">@lang('module_campaign.members')</div>
                                <div class="col-md-8">
                                    @foreach($userCampaign->staffMembers as $staffMember)
                                        @if($staffMember->user->last_name)
                                            @php($shortName = ucfirst($staffMember->user->first_name[0]))
                                        @else
                                            @php($shortName = ucfirst($staffMember->user->first_name[0]).ucfirst($staffMember->user->last_name[0]))
                                        @endif
                                        {{--                                        <figure class="avatar mr-2 mb-2 avatar-sm bg-success text-white" data-initial="{{ $shortName }}" data-toggle="tooltip" title="{{ $staffMember->user->name }}"></figure>--}}
                                        <img
                                            src="https://ui-avatars.com/api/?name={{ $shortName }}&rounded=true&size=30"
                                            alt="{{ $shortName }}">
                                    @endforeach
                                </div>
                            </div>
                            <div class="row pt-4">
                                <div class="col-md-4">@lang('module_campaign.progress')</div>
                                <div class="col-md-8">
                                    @if($userCampaign->remaining_leads === 0)
                                        @lang('module_campaign.flyCampaign')
                                    @elseif($userCampaign->total_leads != null && $userCampaign->remaining_leads != null)
                                        @php($percentage = intval((($userCampaign->total_leads - $userCampaign->remaining_leads)/$userCampaign->total_leads)*100))
                                        {{--                                        <div class="progress" data-height="6" data-toggle="tooltip" title="{{ $percentage }}%">--}}
                                        {{--                                            <div class="progress-bar bg-success" data-width="{{$percentage}}%"></div>--}}

                                        {{--                                        </div>--}}
                                        <div class="progress progress-xl mb-2 mt-2" data-toggle="tooltip"
                                             title="{{ $percentage }}%">
                                            <div class="progress-bar" role="progressbar"
                                                 aria-valuenow="{{ $percentage }}" aria-valuemin="0" aria-valuemax="100"
                                                 style="width: {{ $percentage }}%;"></div>
                                        </div>
                                        <div class="pt-2">
                                            @lang('module_campaign.remainingLeads'):
                                            <strong>{{ ($userCampaign->total_leads - $userCampaign->remaining_leads).'/'.$userCampaign->total_leads }}</strong>
                                        </div>
                                    @else
                                        @lang('module_campaign.notStarted')
                                    @endif
                                </div>
                            </div>

                        </div>
                        <div class="card-footer pt-3 d-flex justify-content-around footer-border">
                            <div class="budget-price justify-content-around">
                                @if($userCampaign->remaining_leads == null && $userCampaign->total_leads == null)
                                    <a href="javascript:void(0);"
                                       onclick="takeCampaign('{{md5($userCampaign->id)}}', 'start_new')"
                                       class=" budget-price-label text-primary"><i
                                            class="fa fa-play"></i> @lang('module_campaign.startAndNewLead')</a>
                                @elseif($userCampaign->remaining_leads === 0)
                                    <a href="javascript:void(0);"
                                       onclick="takeCampaign('{{md5($userCampaign->id)}}', 'new')"
                                       class="budget-price-label text-warning"><i
                                            class="fa fa-play"></i> @lang('module_campaign.newLead')</a>
                                @elseif($userCampaign->remaining_leads == $userCampaign->total_leads)
                                    <a href="javascript:void(0);"
                                       onclick="takeCampaign('{{md5($userCampaign->id)}}', 'start')"
                                       class="budget-price-label text-info"><i
                                            class="fa fa-play"></i> @lang('app.start')</a>
                                @else
                                    <a href="javascript:void(0);"
                                       onclick="takeCampaign('{{md5($userCampaign->id)}}', 'resume')"
                                       class="budget-price-label text-success"><i
                                            class="fa fa-sync"></i> @lang('app.resume')</a>
                                @endif
                            </div>
                            <div class="budget-price justify-content-center">
                                <a href="javascript:void(0);" onclick="stopCampaign({{$userCampaign->id}})"
                                   class="budget-price-label text-danger"><i class="fa fa-stop"></i> @lang('app.stop')
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-md-12 pt-4">
                    <div class="card">
                        <div class="card-body">
                            <div class="empty-state" data-height="400">
                                <div class="empty-state-icon">
                                    <i class="fas fa-question"></i>
                                </div>
                                <h2>@lang('module_campaign.noCampaignAssigned')</h2>
                                <p class="lead">
                                    @lang('module_campaign.noCampaignAssignedMessage')
                                </p>
                                @if($user->ability('admin', 'campaign_create'))
                                    <a href="{{ route('admin.campaigns.create') }}" class="btn btn-primary mt-4"><i
                                            class="fa fa-plus"></i> @lang('module_campaign.addNewCampaign') </a>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            @endforelse
        @else
            <div class="col-md-12 pt-4">
                <div class="card">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped" id="users-table" width="100%">
                                <thead>
                                <tr>
                                    <th>@lang('app.id')</th>
                                    <th>@lang('module_campaign.name')</th>
                                    <th>@lang('module_campaign.totalLeads')</th>
                                    <th>@lang('module_campaign.startedOn')</th>
                                    <th>@lang('module_campaign.completedOn')</th>
                                    <th>@lang('app.action')</th>
                                </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                </div>

            </div>
        @endif
    </div>

@endsection


@section('scripts')
    <script>
    @if($type == 'active')

    function takeCampaign(id, action) {
        var actionText = "{{ trans('module_campaign.startCampaignLead') }}";

        if(action === 'new')
        {
            actionText = "{!! trans('module_campaign.newCampaignLeadCreate') !!}";
        } else if(action === 'start_new'){
            actionText = "{!! trans('module_campaign.startAndCreateLead') !!}";
        } else if(action === 'resume'){
            actionText = "{!! trans('module_campaign.resumeCampaignLead') !!}";
        }

        swal({
            title: "{{ trans('app.areYouSure') }}",
            text: actionText,
            dangerMode: true,
            icon: 'warning',
            buttons: {
                cancel: "{{ trans('app.no') }}",
                confirm: {
                    text: "{{ trans('app.yes') }}",
                    value: true,
                    visible: true,
                    className: "danger",
                }
            },
        }).then(function(isConfirm) {
            if (isConfirm) {

                var url = "{{ route('admin.callmanager.take-action', ':id') }}";
                url = url.replace(':id', id);

                var token = "{{ csrf_token() }}";

                $.easyAjax({
                    type: 'POST',
                    url: url,
                    data: {'_token': token},
                    container: "#campaigns_lists"
                });
            }
        });
    };

    function stopCampaign(id) {
        swal({
            title: "{{ trans('app.areYouSure') }}",
            text: "{{ trans('module_campaign.stopCampaignMessage') }}",
            dangerMode: true,
            icon: 'warning',
            buttons: {
                cancel: "{{ trans('app.no') }}",
                confirm: {
                    text: "{{ trans('app.yes') }}",
                    value: true,
                    visible: true,
                    className: "danger",
                }
            },
        }).then(function(isConfirm) {
            if (isConfirm) {

                var url = "{{ route('admin.callmanager.stop', ':id') }}";
                url = url.replace(':id', id);

                var token = "{{ csrf_token() }}";

                $.easyAjax({
                    type: 'POST',
                    url: url,
                    data: {'_token': token},
                    container: "#campaigns_lists",
                });
            }
        });
    };

    @else

    var table = $('#users-table');

    $(function() {
        table.dataTable({
            responsive: true,
            processing: true,
            serverSide: true,
            ajax: '{!! route('admin.get-call-manager') !!}',
            aaSorting: [[0, "desc"]],
            language: {
                "url": "@lang('app.datatable')"
            },
            "fnDrawCallback": function( oSettings ) {
                $("body").tooltip({
                    selector: '[data-toggle="tooltip"]'
                });

                $('[data-height]').each(function() {
                    $(this).css({
                        height: $(this).data('height')
                    });
                });

                $('[data-width]').each(function() {
                    $(this).css({
                        width: $(this).data('width')
                    });
                });
            },
            columns: [
                { data: 'id', name: 'campaigns.id'},
                { data: 'name', name: 'campaigns.name'},
                { data: 'total_leads', name: 'campaigns.total_leads'},
                { data: 'started_on', name: 'campaigns.started_on'},
                { data: 'completed_on', name: 'campaigns.completed_on'},
                { data: 'action', name: 'action'}
            ]
        });

    });

    @endif
</script>
@endsection
