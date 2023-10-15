<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>

<?php if (session('role') === 'admin') : ?>
    <!-- PROSES AMI Card -->
    <div class="col-xxl-4 col-md-4">
        <div class="card info-card sales-card">

            <div class="card-body">
                <h5 class="card-title">Proses AMI <span>| </span></h5>

                <div class="d-flex align-items-center">
                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                        <i class="bi bi-arrow-clockwise"></i>
                    </div>
                    <div class="ps-3">
                        <h6><?= $prosesAMI; ?></h6>
                        <!-- <span class="text-success small pt-1 fw-bold">12%</span> <span class="text-muted small pt-2 ps-1">increase</span> -->

                    </div>
                </div>
            </div>

        </div>
    </div><!-- End PROSES AMI Card -->

    <!-- Users Card -->
    <div class="col-xxl-4 col-md-4">
        <div class="card info-card sales-card">
            <div class="card-body">
                <h5 class="card-title">Users <span>|</span></h5>

                <div class="d-flex align-items-center">
                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                        <i class="bi bi-people"></i>
                    </div>
                    <div class="ps-3">
                        <h6><?= $user; ?></h6>
                        <!-- <span class="text-success small pt-1 fw-bold">12%</span> <span class="text-muted small pt-2 ps-1">increase</span> -->

                    </div>
                </div>
            </div>

        </div>
    </div><!-- End User Card -->

    <!-- unit prodi Card -->
    <div class="col-xxl-4 col-md-4">
        <div class="card info-card sales-card">

            <div class="card-body">
                <h5 class="card-title">Unit/Program Studi <span>|</span></h5>

                <div class="d-flex align-items-center">
                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                        <i class="bi bi-building"></i>
                    </div>
                    <div class="ps-3">
                        <h6><?= $unit_prodi; ?></h6>
                        <!-- <span class="text-success small pt-1 fw-bold">12%</span> <span class="text-muted small pt-2 ps-1">increase</span> -->

                    </div>
                </div>
            </div>

        </div>
    </div><!-- End unit prodi Card -->

    <!-- Standar Card -->
    <div class="col-xxl-4 col-md-4">
        <div class="card info-card sales-card">

            <div class="card-body">
                <h5 class="card-title">Standar <span>|</span></h5>

                <div class="d-flex align-items-center">
                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                        <i class="bi bi-badge-sd"></i>
                    </div>
                    <div class="ps-3">
                        <h6><?= $standar; ?></h6>
                        <!-- <span class="text-success small pt-1 fw-bold">12%</span> <span class="text-muted small pt-2 ps-1">increase</span> -->

                    </div>
                </div>
            </div>

        </div>
    </div><!-- End Standar Card -->
<?php endif; ?>

<?php if (session('role') === 'auditee') : ?>
    <!-- PROSES AMI Card -->
    <div class="col-xxl-4 col-md-4">
        <div class="card info-card sales-card">

            <div class="card-body">
                <h5 class="card-title">Proses AMI <span>| </span></h5>

                <div class="d-flex align-items-center">
                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                        <i class="bi bi-arrow-clockwise"></i>
                    </div>
                    <div class="ps-3">
                        <h6><?= $prosesAMIbyAuditee; ?></h6>
                        <!-- <span class="text-success small pt-1 fw-bold">12%</span> <span class="text-muted small pt-2 ps-1">increase</span> -->

                    </div>
                </div>
            </div>

        </div>
    </div><!-- End PROSES AMI Card -->
<?php endif; ?>

<?php if (session('role') === 'auditor') : ?>
    <!-- PROSES AMI Card -->
    <div class="col-xxl-4 col-md-4">
        <div class="card info-card sales-card">

            <div class="card-body">
                <h5 class="card-title">Proses AMI <span>| </span></h5>

                <div class="d-flex align-items-center">
                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                        <i class="bi bi-cart"></i>
                    </div>
                    <div class="ps-3">
                        <h6><?= $prosesAMIbyAuditor; ?></h6>
                        <!-- <span class="text-success small pt-1 fw-bold">12%</span> <span class="text-muted small pt-2 ps-1">increase</span> -->

                    </div>
                </div>
            </div>

        </div>
    </div><!-- End PROSES AMI Card -->
<?php endif; ?>

<?= $this->endsection(); ?>