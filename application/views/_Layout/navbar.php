<aside class="main-sidebar">
    <section class="sidebar">
        <ul class="sidebar-menu">
            <li class="header">MANAGEMENT</li>
            <li><a href="<?= site_url('core/index') ?>"><i class="fa fa-book"></i> <span>CORE</span></a></li>
            <li><a href="<?= site_url('designer/index') ?>"><i class="fa fa-files-o"></i> <span>DESIGNER</span></a></li>
            <li><a href="<?= site_url('developer/index') ?>"><i class="fa fa-laptop"></i> <span>DEVELOPE</span></a></li>
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-th"></i> <span>USER</span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    <li><a href="<?= site_url('user/index') ?>"><i class="fa fa-circle-o"></i> 회원</a></li>
                    <li><a href="<?= site_url('user/category') ?>"><i class="fa fa-circle-o"></i> 카테고리</a></li>
                </ul>
            </li>
        </ul>
    </section>
</aside>
