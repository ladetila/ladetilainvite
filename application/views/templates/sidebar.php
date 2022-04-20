<!-- Sidebar -->

<style>
    ul {
        background: linear-gradient(to right, #423F3E 0%, #423F3E 0%);
    }
</style>

<ul class="navbar-nav sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="<?= base_url('auth'); ?>">
        <div class="sidebar-brand-icon rotate-n-15">
            <i class="fas fa-gift"></i>
        </div>
        <div class="sidebar-brand-text mx-3">Ladetila Invite</div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider">
    <!-- Query menu -->

    <!-- Lihat -->
    <li class="nav-item">
        <a class="nav-link" href="<?= base_url() ?>">
            <i class="fas fa-fw fa-chevron-circle-right"></i>
            <span>Lihat Website</span></a>
    </li>

    <hr class="sidebar-divider">

    <!-- siapkan submenu sesuai menu -->
    <?php


    $querySubMenu = "SELECT *
                  FROM user_sub_menu
                  ";
    $subMenu = $this->db->query($querySubMenu)->result_array();
    ?>
    <?php foreach ($subMenu as $sm) : ?>
        <!-- Nav Item - Dashboard -->
        <?php if ($title == $sm['title']) : ?>
            <li class="nav-item active">
            <?php else : ?>
            <li class="nav-item">
            <?php endif; ?>
            <a class="nav-link pb-0" href="<?= base_url($sm['url']); ?>">
                <i class="<?= $sm['icon']; ?>"></i>
                <span><?= $sm['title']; ?></span></a>
            </li>
        <?php endforeach; ?>

        <!-- Heading -->


        <!-- Heading -->
        <li class="nav-item">
            <a class="nav-link" href="<?= base_url('auth/logout') ?>">
                <i class="fas fa-fw fa-sign-out-alt" data-dismiss="modal"></i>
                <span>Logout</span></a>
        </li>

        <!-- Divider -->
        <hr class="sidebar-divider">

        <!-- Sidebar Toggler (Sidebar) -->
        <div class="text-center d-none d-md-inline">
            <button class="rounded-circle border-0" id="sidebarToggle"></button>
        </div>

</ul>
<!-- End of Sidebar -->