<ul class="sidebar-nav" id="sidebar-nav">

    <li class="nav-item">
        <a class="nav-link " href="/dashboard">
            <i class="bi bi-grid"></i>
            <span>Dashboard</span>
        </a>
    </li><!-- End Dashboard Nav -->

    <?php if (session('role') === 'admin') : ?>
        <h5 class="card-title" style="margin-bottom: -5px;">Data Master</h5>

        <li class="nav-item">
            <a class="nav-link collapsed " data-bs-target="#forms-nav3" data-bs-toggle="collapse" href="#">
                <i class="bi bi-people"></i><span>Kelola Users</span><i class="bi bi-chevron-down ms-auto"></i>
            </a>
            <ul id="forms-nav3" class="nav-content collapse <?= (strpos($_SERVER['REQUEST_URI'], '/unit') !== false || strpos($_SERVER['REQUEST_URI'], '/user') !== false) ? 'show' : ''; ?>" data-bs-parent="#sidebar-nav">
                <li>
                    <a href="<?= base_url('unit'); ?>" class="<?= ($_SERVER['REQUEST_URI'] == '/unit') ? 'active' : ''; ?>">
                        <i class="bi bi-circle"></i><span>Unit</span>
                    </a>
                </li>
                <li>
                    <a href="<?= base_url('user'); ?>" class="<?= ($_SERVER['REQUEST_URI'] == '/user') ? 'active' : ''; ?>">
                        <i class="bi bi-circle"></i><span>Users</span>
                    </a>
                </li>
            </ul>
        </li><!-- End Forms Users -->
        <li class="nav-item">
            <a class="nav-link collapsed" href="<?= base_url('/proses-ami'); ?>">
                <i class="bi bi-ui-checks"></i>
                <span>Riwayat AMI</span>
            </a>
        </li>
    <?php endif; ?>

    <h5 class="card-title" style="margin-bottom: -5px;">SIKLUS SPMI</h5>

    <?php if (session('role') === 'admin') : ?>
        <li class="nav-item">
            <a class="nav-link collapsed " data-bs-target="#forms-nav1" data-bs-toggle="collapse" href="#">
                <i class="bi bi-journal-text"></i><span>Penetapan</span><i class="bi bi-chevron-down ms-auto"></i>
            </a>
            <ul id="forms-nav1" class="nav-content collapse <?= (strpos($_SERVER['REQUEST_URI'], '/standar') !== false || strpos($_SERVER['REQUEST_URI'], '/butiran') !== false || strpos($_SERVER['REQUEST_URI'], '/siklus') !== false) ? 'show' : ''; ?>" data-bs-parent="#sidebar-nav">
                <li>
                    <a href="<?= base_url('siklus'); ?>" class="<?= ($_SERVER['REQUEST_URI'] == '/siklus') ? 'active' : ''; ?>">
                        <i class="bi bi-circle"></i><span>Periode Akademik</span>
                    </a>
                </li>
                <li>
                    <a href="<?= base_url('standar'); ?>" class="<?= ($_SERVER['REQUEST_URI'] == '/standar') ? 'active' : ''; ?>">
                        <i class="bi bi-circle"></i><span>Standar</span>
                    </a>
                </li>
                <li>
                    <a href="<?= base_url('butiran'); ?>" class="<?= ($_SERVER['REQUEST_URI'] == '/butiran') ? 'active' : ''; ?>">
                        <i class="bi bi-circle"></i><span>Butiran Mutu</span>
                    </a>
                </li>
            </ul>
        </li>
        <!-- End Forms penetapan -->
    <?php endif; ?>

    <?php if (session('role') === 'admin' || session('role') === 'auditee') : ?>
        <li class="nav-item">
            <a class="nav-link collapsed " data-bs-target="#forms-nav-evaluasi" data-bs-toggle="collapse" href="#">
                <i class="bi bi-journal-text"></i><span>Pelaksanaan</span><i class="bi bi-chevron-down ms-auto"></i>
            </a>
            <ul id="forms-nav-evaluasi" class="nav-content collapse <?= (strpos($_SERVER['REQUEST_URI'], '/evaluasi-diri') !== false) ? 'show' : ''; ?>" data-bs-parent="#sidebar-nav">
                <li>
                    <a href="<?= base_url('evaluasi-diri'); ?>" class="<?= ($_SERVER['REQUEST_URI'] == '/evaluasi-diri') ? 'active' : ''; ?>">
                        <i class="bi bi-circle"></i><span>Evaluasi Diri</span>
                    </a>
                </li>
            </ul>
        </li><!-- End Forms Nav -->
    <?php endif; ?>

    <?php if (session('role') === 'admin' || session('role') === 'auditor') : ?>
        <li class="nav-item">
            <a class="nav-link collapsed " data-bs-target="#forms-nav2" data-bs-toggle="collapse" href="#">
                <i class="bi bi-journal-text"></i><span>Evaluasi</span><i class="bi bi-chevron-down ms-auto"></i>
            </a>
            <ul id="forms-nav2" class="nav-content collapse <?= (strpos($_SERVER['REQUEST_URI'], '/evaluasi-audit') !== false) ? 'show' : ''; ?>" data-bs-parent="#sidebar-nav">
                <li>
                    <a href="<?= base_url('evaluasi-audit'); ?>" class="<?= ($_SERVER['REQUEST_URI'] == '/evaluasi-audit') ? 'active' : ''; ?>">
                        <i class="bi bi-circle"></i><span>Evaluasi Audit</span>
                    </a>
                </li>
            </ul>
        </li><!-- End Forms Nav -->
    <?php endif; ?>

    <?php if (session('role') === 'admin' || session('role') === 'auditee') : ?>
        <li class="nav-item">
            <a class="nav-link collapsed" href="<?= base_url('pengendalian'); ?>">
                <i class="bi bi-ui-checks"></i>
                <span>Pengendalian</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link collapsed" href="<?= base_url('peningkatan'); ?>">
                <i class="bi bi-ui-checks"></i>
                <span>Peningkatan</span>
            </a>
        </li>
    <?php endif; ?>

    <li class="nav-item">
        <a class="nav-link collapsed" href="<?= base_url('user-profile'); ?>">
            <i class="bi bi-person"></i>
            <span>Profile</span>
        </a>
    </li><!-- End Profile Page Nav -->

</ul>