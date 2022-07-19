<template>
    <div class="sidebar-main sidebar-menu-one sidebar-expand-md sidebar-color">
        <div class="mobile-sidebar-header d-md-none">
            <div class="header-logo">
                <a href="index.html"><img src="/custom_folder/img/logo1.png" alt="logo"></a>
            </div>
        </div>

        <div class="sidebar-menu-content">
            <ul class="nav nav-sidebar-menu sidebar-toggle-view">
                <li class="nav-item sidebar-nav-item">
                    <a href="/teachers/dashboard" class="nav-link"><i class="flaticon-dashboard"></i><span>Dashboard</span></a>
                </li>
                <li class="nav-item sidebar-nav-item">
                    <a href="/teachers/routine" class="nav-link"><i class="flaticon-dashboard"></i><span>Routine</span></a>
                </li>
                <li class="nav-item sidebar-nav-item">
                    <a href="/teachers/class" class="nav-link"><i class="flaticon-dashboard"></i><span>Class Teacher</span></a>
                </li>
                <li class="nav-item sidebar-nav-item">
                    <a href="/teachers/class/attendance/list" class="nav-link"><i class="flaticon-dashboard"></i><span>Attendance List</span></a>
                </li>
            </ul>
        </div>
    </div>
</template>

<script>
export default {
    name: 'SidebarComponant'
}
</script>
