<div class="sidebar sidebar-dark sidebar-fixed" id="sidebar">
    <div class="sidebar-brand d-none d-md-flex">
        <svg class="sidebar-brand-full" width="118" height="46" alt="CoreUI Logo">
            <use xlink:href="{{ asset('img_admin/brand/coreui.svg#full') }}"></use>
        </svg>
        <svg class="sidebar-brand-narrow" width="46" height="46" alt="CoreUI Logo">
            <use xlink:href="{{ asset('img_admin/brand/coreui.svg#singnet') }}"></use>
        </svg>
    </div>
    <ul class="sidebar-nav" data-coreui="navigation" data-simplebar="">
        <x-nav-item route="home"> 
            <svg class="nav-icon">
                <use xlink:href="{{ asset('img_admin/svg/free.svg#cil-speedometer') }}"></use>
            </svg>
            Dashboard
            <span class="badge badge-sm bg-info ms-auto">NEW</span>
        </x-nav-item>
        <li class="nav-title">Setting</li>
        <x-nav-group title="Quản lý Tool" iconLink="img_admin/svg/free.svg#cil-puzzle">
            <x-nav-item route="home"> User </x-nav-item>
            <x-nav-item route="role.index"> Role </x-nav-item>
            <x-nav-item route="permission.index"> Permission </x-nav-item>
            <x-nav-item route="role-permission.index"> Role-Permission </x-nav-item>
            <x-nav-item route="home"> Phân quyền </x-nav-item>
        </x-nav-group>
        <li class="nav-group">
            <a class="nav-link nav-group-toggle" href="#">
                <svg class="nav-icon">
                    <use xlink:href="{{ asset('img_admin/svg/free.svg#cil-puzzle') }}"></use>
                </svg> Base
            </a>
            <ul class="nav-group-items">
                <li class="nav-item">
                    <a class="nav-link" href="base/accordion.html"><span class="nav-icon"></span>
                        Accordion
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="base/breadcrumb.html"><span class="nav-icon"></span>
                        Breadcrumb
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="base/cards.html"><span class="nav-icon"></span>
                        Cards
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="base/carousel.html"><span class="nav-icon"></span>
                        Carousel
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="base/collapse.html"><span class="nav-icon"></span>
                        Collapse
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="base/list-group.html"><span class="nav-icon"></span> List
                        group</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="base/navs-tabs.html"><span class="nav-icon"></span> Navs
                        &amp; Tabs
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="base/pagination.html"><span class="nav-icon"></span>
                        Pagination
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="base/placeholders.html"><span class="nav-icon"></span>
                        Placeholders
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="base/popovers.html"><span class="nav-icon"></span>
                        Popovers
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="base/progress.html"><span class="nav-icon"></span>
                        Progress
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="base/scrollspy.html"><span class="nav-icon"></span>
                        Scrollspy
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="base/spinners.html"><span class="nav-icon"></span>
                        Spinners
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="base/tables.html"><span class="nav-icon"></span>
                        Tables
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="base/tooltips.html"><span class="nav-icon"></span>
                        Tooltips
                    </a>
                </li>
            </ul>
        </li>
        <li class="nav-group"><a class="nav-link nav-group-toggle" href="#">
                <svg class="nav-icon">
                    <use xlink:href="{{ asset('img_admin/svg/free.svg#cil-cursor') }}"></use>
                </svg> Buttons</a>
            <ul class="nav-group-items">
                <li class="nav-item">
                    <a class="nav-link" href="buttons/buttons.html"><span class="nav-icon"></span> Buttons</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="buttons/button-group.html"><span class="nav-icon"></span> Buttons
                        Group</a>
                </li>
                <li class="nav-item"><a class="nav-link" href="buttons/dropdowns.html"><span
                            class="nav-icon"></span> Dropdowns</a></li>
            </ul>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="charts.html">
                <svg class="nav-icon">
                    <use xlink:href="{{ asset('img_admin/svg/free.svg#cil-chart-pie') }}"></use>
                </svg> Charts
            </a>
        </li>
        <li class="nav-group">
            <a class="nav-link nav-group-toggle" href="#">
                <svg class="nav-icon">
                    <use xlink:href="{{ asset('img_admin/svg/free.svg#cil-notes') }}"></use>
                </svg> Forms
            </a>
            <ul class="nav-group-items">
                <x-nav-item route="home"> Form Controll </x-nav-item>
                <x-nav-item route="home"> Form Controll </x-nav-item>
                <x-nav-item route="home"> Form Controll </x-nav-item>
                <x-nav-item route="home"> Form Controll </x-nav-item>
                <x-nav-item route="home"> Form Controll </x-nav-item>
            </ul>
        </li>
        <li class="nav-group">
            <a class="nav-link nav-group-toggle" href="#">
                <svg class="nav-icon">
                    <use xlink:href="{{ asset('img_admin/svg/free.svg#cil-star') }}"></use>
                </svg> Icons
            </a>
            <ul class="nav-group-items">
                <li class="nav-item">
                    <a class="nav-link" href="icons/coreui-icons-free.html"> CoreUI Icons<span
                            class="badge badge-sm bg-success ms-auto">Free</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="icons/coreui-icons-brand.html"> CoreUI Icons - Brand</a>
                </li>
                <li class="nav-item"><a class="nav-link" href="icons/coreui-icons-flag.html"> CoreUI Icons - Flag</a>
                </li>
            </ul>
        </li>
        <li class="nav-group"><a class="nav-link nav-group-toggle" href="#">
                <svg class="nav-icon">
                    <use xlink:href="{{ asset('img_admin/svg/free.svg#cil-bell') }}"></use>
                </svg> Notifications</a>
            <ul class="nav-group-items">
                <li class="nav-item"><a class="nav-link" href="notifications/alerts.html"><span
                            class="nav-icon"></span> Alerts</a></li>
                <li class="nav-item"><a class="nav-link" href="notifications/badge.html"><span
                            class="nav-icon"></span> Badge</a></li>
                <li class="nav-item"><a class="nav-link" href="notifications/modals.html"><span
                            class="nav-icon"></span> Modals</a></li>
                <li class="nav-item"><a class="nav-link" href="notifications/toasts.html"><span
                            class="nav-icon"></span> Toasts</a></li>
            </ul>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="widgets.html">
                <svg class="nav-icon">
                    <use xlink:href="{{ asset('img_admin/svg/free.svg#cil-calculator') }}"></use>
                </svg> Widgets<span class="badge badge-sm bg-info ms-auto">NEW</span>
            </a>
        </li>
        <li class="nav-divider"></li>
        <li class="nav-title">Extras</li>
        <li class="nav-group">
            <a class="nav-link nav-group-toggle" href="#">
                <svg class="nav-icon">
                    <use xlink:href="{{ asset('img_admin/svg/free.svg#cil-star') }}"></use>
                </svg> Pages
            </a>
            <ul class="nav-group-items">
                <li class="nav-item">
                    <a class="nav-link" href="login.html" target="_top">
                        <svg class="nav-icon">
                            <use xlink:href="{{ asset('img_admin/svg/free.svg#cil-account-logout') }}"></use>
                        </svg> Login
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="register.html" target="_top">
                        <svg class="nav-icon">
                            <use xlink:href="{{ asset('img_admin/svg/free.svg#cil-account-logout') }}"></use>
                        </svg> Register
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="404.html" target="_top">
                        <svg class="nav-icon">
                            <use xlink:href="{{ asset('img_admin/svg/free.svg#cil-bug') }}"></use>
                        </svg> Error 404
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="500.html" target="_top">
                        <svg class="nav-icon">
                            <use xlink:href="{{ asset('img_admin/svg/free.svg#cil-bug') }}"></use>
                        </svg> Error 500
                    </a>
                </li>
            </ul>
        </li>
        <li class="nav-item mt-auto">
            <a class="nav-link" href="https://coreui.io/docs/templates/installation/" target="_blank">
                <svg class="nav-icon">
                    <use xlink:href="{{ asset('img_admin/svg/free.svg#cil-description') }}"></use>
                </svg> Docs
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link nav-link-danger" href="https://coreui.io/pro/" target="_top">
                <svg class="nav-icon">
                    <use xlink:href="{{ asset('img_admin/svg/free.svg#cil-layers') }}"></use>
                </svg> Try CoreUI
                <div class="fw-semibold">PRO</div>
            </a>
        </li>
    </ul>
    <button class="sidebar-toggler" type="button" data-coreui-toggle="unfoldable"></button>
</div>
