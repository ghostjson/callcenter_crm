<div id="nav" class="nav-container d-flex">
    <div class="nav-content d-flex">
        <!-- Logo Start -->
        <div class="logo position-relative">
            <a href="/">
                <!-- Logo can be added directly -->
                <img src="{{ $settings->logo_url }}" width="100px" style="min-height: 0" alt="logo" />

                <!-- Or added via css to provide different ones for different color themes -->
{{--                <div class="img"></div>--}}
            </a>
        </div>
        <!-- Logo End -->

{{--        <!-- Language Switch Start -->--}}
{{--        <div class="language-switch-container">--}}
{{--            <button class="btn btn-empty language-button dropdown-toggle" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">EN</button>--}}
{{--            <div class="dropdown-menu">--}}
{{--                <a href="#" class="dropdown-item">DE</a>--}}
{{--                <a href="#" class="dropdown-item active">EN</a>--}}
{{--                <a href="#" class="dropdown-item">ES</a>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--        <!-- Language Switch End -->--}}

        <!-- User Menu Start -->
        <div class="user-container d-flex">
            <a href="{{ route('admin.settings.profile.index') }}" class="d-flex user position-relative">
                <img class="profile" alt="profile" src="{{ $user->image_url }}" />
                <div class="name">{{ $user->first_name }}</div>
            </a>
{{--            <div class="dropdown-menu dropdown-menu-end user-menu wide">--}}
{{--                <div class="row mb-3 ms-0 me-0">--}}
{{--                    <div class="col-12 ps-1 mb-2">--}}
{{--                        <div class="text-extra-small text-primary">ACCOUNT</div>--}}
{{--                    </div>--}}
{{--                    <div class="col-6 ps-1 pe-1">--}}
{{--                        <ul class="list-unstyled">--}}
{{--                            <li>--}}
{{--                                <a href="#">User Info</a>--}}
{{--                            </li>--}}
{{--                            <li>--}}
{{--                                <a href="#">Preferences</a>--}}
{{--                            </li>--}}
{{--                            <li>--}}
{{--                                <a href="#">Calendar</a>--}}
{{--                            </li>--}}
{{--                        </ul>--}}
{{--                    </div>--}}
{{--                    <div class="col-6 pe-1 ps-1">--}}
{{--                        <ul class="list-unstyled">--}}
{{--                            <li>--}}
{{--                                <a href="#">Security</a>--}}
{{--                            </li>--}}
{{--                            <li>--}}
{{--                                <a href="#">Billing</a>--}}
{{--                            </li>--}}
{{--                        </ul>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--                <div class="row mb-1 ms-0 me-0">--}}
{{--                    <div class="col-12 p-1 mb-2 pt-2">--}}
{{--                        <div class="text-extra-small text-primary">APPLICATION</div>--}}
{{--                    </div>--}}
{{--                    <div class="col-6 ps-1 pe-1">--}}
{{--                        <ul class="list-unstyled">--}}
{{--                            <li>--}}
{{--                                <a href="#">Themes</a>--}}
{{--                            </li>--}}
{{--                            <li>--}}
{{--                                <a href="#">Language</a>--}}
{{--                            </li>--}}
{{--                        </ul>--}}
{{--                    </div>--}}
{{--                    <div class="col-6 pe-1 ps-1">--}}
{{--                        <ul class="list-unstyled">--}}
{{--                            <li>--}}
{{--                                <a href="#">Devices</a>--}}
{{--                            </li>--}}
{{--                            <li>--}}
{{--                                <a href="#">Storage</a>--}}
{{--                            </li>--}}
{{--                        </ul>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--                <div class="row mb-1 ms-0 me-0">--}}
{{--                    <div class="col-12 p-1 mb-3 pt-3">--}}
{{--                        <div class="separator-light"></div>--}}
{{--                    </div>--}}
{{--                    <div class="col-6 ps-1 pe-1">--}}
{{--                        <ul class="list-unstyled">--}}
{{--                            <li>--}}
{{--                                <a href="#">--}}
{{--                                    <i data-cs-icon="help" class="me-2" data-cs-size="17"></i>--}}
{{--                                    <span class="align-middle">Help</span>--}}
{{--                                </a>--}}
{{--                            </li>--}}
{{--                            <li>--}}
{{--                                <a href="#">--}}
{{--                                    <i data-cs-icon="document-full" class="me-2" data-cs-size="17"></i>--}}
{{--                                    <span class="align-middle">Docs</span>--}}
{{--                                </a>--}}
{{--                            </li>--}}
{{--                        </ul>--}}
{{--                    </div>--}}
{{--                    <div class="col-6 pe-1 ps-1">--}}
{{--                        <ul class="list-unstyled">--}}
{{--                            <li>--}}
{{--                                <a href="#">--}}
{{--                                    <i data-cs-icon="gear" class="me-2" data-cs-size="17"></i>--}}
{{--                                    <span class="align-middle">Settings</span>--}}
{{--                                </a>--}}
{{--                            </li>--}}
{{--                            <li>--}}
{{--                                <a href="#">--}}
{{--                                    <i data-cs-icon="logout" class="me-2" data-cs-size="17"></i>--}}
{{--                                    <span class="align-middle">Logout</span>--}}
{{--                                </a>--}}
{{--                            </li>--}}
{{--                        </ul>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
        </div>
        <!-- User Menu End -->

        <!-- Icons Menu Start -->
        <ul class="list-unstyled list-inline text-center menu-icons">
{{--            <li class="list-inline-item">--}}
{{--                <a href="#" data-bs-toggle="modal" data-bs-target="#searchPagesModal">--}}
{{--                    <i data-cs-icon="search" data-cs-size="18"></i>--}}
{{--                </a>--}}
{{--            </li>--}}
            <li class="list-inline-item">
                <a href="#" id="pinButton" class="pin-button">
                    <i data-cs-icon="lock-on" class="unpin" data-cs-size="18"></i>
                    <i data-cs-icon="lock-off" class="pin" data-cs-size="18"></i>
                </a>
            </li>
            <li class="list-inline-item">
                <a href="#" id="colorButton">
                    <i data-cs-icon="light-on" class="light" data-cs-size="18"></i>
                    <i data-cs-icon="light-off" class="dark" data-cs-size="18"></i>
                </a>
            </li>
{{--            <li class="list-inline-item">--}}
{{--                <a href="#" data-bs-toggle="dropdown" data-bs-target="#notifications" aria-haspopup="true" aria-expanded="false" class="notification-button">--}}
{{--                    <div class="position-relative d-inline-flex">--}}
{{--                        <i data-cs-icon="bell" data-cs-size="18"></i>--}}
{{--                        <span class="position-absolute notification-dot rounded-xl"></span>--}}
{{--                    </div>--}}
{{--                </a>--}}
{{--                <div class="dropdown-menu dropdown-menu-end wide notification-dropdown scroll-out" id="notifications">--}}
{{--                    <div class="scroll">--}}
{{--                        <ul class="list-unstyled border-last-none">--}}
{{--                            <li class="mb-3 pb-3 border-bottom border-separator-light d-flex">--}}
{{--                                <img src="img/profile/profile-1.jpg" class="me-3 sw-4 sh-4 rounded-xl align-self-center" alt="..." />--}}
{{--                                <div class="align-self-center">--}}
{{--                                    <a href="#">Joisse Kaycee just sent a new comment!</a>--}}
{{--                                </div>--}}
{{--                            </li>--}}
{{--                            <li class="mb-3 pb-3 border-bottom border-separator-light d-flex">--}}
{{--                                <img src="img/profile/profile-2.jpg" class="me-3 sw-4 sh-4 rounded-xl align-self-center" alt="..." />--}}
{{--                                <div class="align-self-center">--}}
{{--                                    <a href="#">New order received! It is total $147,20.</a>--}}
{{--                                </div>--}}
{{--                            </li>--}}
{{--                            <li class="mb-3 pb-3 border-bottom border-separator-light d-flex">--}}
{{--                                <img src="img/profile/profile-3.jpg" class="me-3 sw-4 sh-4 rounded-xl align-self-center" alt="..." />--}}
{{--                                <div class="align-self-center">--}}
{{--                                    <a href="#">3 items just added to wish list by a user!</a>--}}
{{--                                </div>--}}
{{--                            </li>--}}
{{--                            <li class="pb-3 pb-3 border-bottom border-separator-light d-flex">--}}
{{--                                <img src="img/profile/profile-6.jpg" class="me-3 sw-4 sh-4 rounded-xl align-self-center" alt="..." />--}}
{{--                                <div class="align-self-center">--}}
{{--                                    <a href="#">Kirby Peters just sent a new message!</a>--}}
{{--                                </div>--}}
{{--                            </li>--}}
{{--                        </ul>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </li>--}}
        </ul>
        <!-- Icons Menu End -->

        <!-- Menu Start -->
        <div class="menu-container flex-grow-1">
            <ul id="menu" class="menu">
                <li>
                    <a href="{{ route('admin.dashboard.index') }}">
                        <i data-cs-icon="home" class="icon" data-cs-size="18"></i>
                        <span class="label">@lang('menu.dashboard')</span>
                    </a>
                </li>
                <li>
                    <a href="#lead-management" data-href="Dashboards.html">
                        <i data-cs-icon="chart-2" class="icon" data-cs-size="18"></i>
                        <span class="label">@lang('menu.leadManagement')</span>
                    </a>
                    <ul id="lead-management">
                        <li>
                            <a href="{{ route('admin.callmanager.index') }}">
                                <span class="label">@lang('menu.callManager')</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('admin.campaigns.index') }}">
                                <span class="label">@lang('menu.campaigns')</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('admin.call-enquiry.index') }}">
                                <span class="label">@lang('menu.callEnquiry')</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('admin.call-history.index') }}">
                                <span class="label">@lang('menu.callHistory')</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('admin.campaigns.import-leads') }}">
                                <span class="label">@lang('menu.importLeads')</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('admin.campaigns.export-leads') }}">
                                <span class="label">@lang('menu.exportLeads')</span>
                            </a>
                        </li>
                    </ul>
                </li>
                <li>
                    <a href="#dashboards" data-href="Dashboards.html">
                        <i data-cs-icon="email" class="icon" data-cs-size="18"></i>
                        <span class="label">@lang('menu.appointments')</span>
                    </a>
                    <ul id="dashboards">
                        <li>
                            <a href="{{ route('admin.pending-callback.index') }}">
                                <span class="label">@lang('menu.pendingCallbacks')</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('admin.appointments.index') }}">
                                <span class="label">@lang('menu.appointmentCalendar')</span>
                            </a>
                        </li>
                    </ul>
                </li>
                <li>
                    <a href="#user-management" data-href="Dashboards.html">
                        <i data-cs-icon="user" class="icon" data-cs-size="18"></i>
                        <span class="label">@lang('menu.userManagement')</span>
                    </a>
                    <ul id="user-management">
                        <li>
                            <a href="{{ route('admin.users.index') }}">
                                <span class="label">@lang('menu.staffMembers')</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('admin.sales-users.index') }}">
                                <span class="label">@lang('menu.salesMembers')</span>
                            </a>
                        </li>
                    </ul>
                </li>
                <li>
                    <a href="#nav-settings" data-href="Dashboards.html">
                        <i data-cs-icon="gear" class="icon" data-cs-size="18"></i>
                        <span class="label">@lang('menu.settings')</span>
                    </a>
                    <ul id="nav-settings">
                        <li>
                            <a href="{{ route('admin.email-templates.index') }}">
                                <span class="label">@lang('menu.emailTemplates')</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('admin.forms.index') }}">
                                <span class="label">@lang('menu.formBuilder')</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('admin.settings.company.index') }}">
                                <span class="label">@lang('menu.settings')</span>
                            </a>
                        </li>
                    </ul>
                </li>

            </ul>
        </div>
        <!-- Menu End -->

        <!-- Mobile Buttons Start -->
        <div class="mobile-buttons-container">
            <!-- Scrollspy Mobile Button Start -->
            <a href="#" id="scrollSpyButton" class="spy-button" data-bs-toggle="dropdown">
                <i data-cs-icon="menu-dropdown"></i>
            </a>
            <!-- Scrollspy Mobile Button End -->

            <!-- Scrollspy Mobile Dropdown Start -->
            <div class="dropdown-menu dropdown-menu-end" id="scrollSpyDropdown"></div>
            <!-- Scrollspy Mobile Dropdown End -->

            <!-- Menu Button Start -->
            <a href="#" id="mobileMenuButton" class="menu-button">
                <i data-cs-icon="menu"></i>
            </a>
            <!-- Menu Button End -->
        </div>
        <!-- Mobile Buttons End -->
    </div>
    <div class="nav-shadow"></div>
</div>
