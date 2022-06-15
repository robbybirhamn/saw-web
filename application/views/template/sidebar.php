<?php
$controller = $this->uri->segment(1) ?? "";
$method = $this->uri->segment(2) ?? "";
?>
<!-- Sidebar -->
<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

<!-- Sidebar - Brand -->
<a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
    <div class="sidebar-brand-icon">
        <!-- <img src="<?= base_url('assets/img/logobig.png') ?>" width="80%" alt=""> -->
    </div>
    <!-- <div class="sidebar-brand-text mx-3">LOIS</div> -->
</a>

<!-- Divider -->
<!-- <hr class="sidebar-divider my-0"> -->

<!-- Nav Item - Dashboard -->
<li class="nav-item">
    <a class="nav-link" href="<?= base_url() ?>">
        <i class="fas fa-fw fa-tachometer-alt"></i>
        <span>Dashboard</span></a>
</li>

<!-- Divider -->
<hr class="sidebar-divider d-none d-md-block">

<li class="nav-item <?= ($controller == "module" AND $method == "vendor") ? "active" : "" ?>">
    <a class="nav-link" href="<?= base_url('module/vendor') ?>">
    <i class="fas fa-fw fa-circle"></i>
    <span>Data Vendor</span></a>
</li>

<li class="nav-item <?= ($controller == "module") ? "packet" : "" ?>">
    <a class="nav-link" href="<?= base_url('module/packet') ?>">
    <i class="fas fa-fw fa-circle"></i>
    <span>Data Paket</span></a>
</li>

<li class="nav-item <?= ($controller == "module") ? "banner" : "" ?>">
    <a class="nav-link" href="<?= base_url('module/banner') ?>">
    <i class="fas fa-fw fa-circle"></i>
    <span>Data Banner</span></a>
</li>

<!-- Sidebar Toggler (Sidebar) -->
<div class="text-center d-none d-md-inline">
    <button class="rounded-circle border-0" id="sidebarToggle"></button>
</div>

</ul>
<!-- End of Sidebar -->