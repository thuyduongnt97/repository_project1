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
            <x-nav-item route="user-role.index"> Phân quyền </x-nav-item>
        </x-nav-group>
    </ul>
    <button class="sidebar-toggler" type="button" data-coreui-toggle="unfoldable"></button>
</div>
