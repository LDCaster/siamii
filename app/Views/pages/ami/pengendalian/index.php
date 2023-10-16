<?= $this->extend('Layout/template'); ?>

<?= $this->section('content'); ?>

<section class="section">
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Data Pengendalian</h5>

                    <!-- Tampilkan pesan error jika ada -->
                    <?php if (session()->has('error')) : ?>
                        <div class="alert alert-danger">
                            <?= session('error') ?>
                        </div>
                    <?php endif; ?>
                    <?php if (session()->getFlashdata('pesan')) : ?>
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <i class="bi bi-check-circle me-1"></i>
                            <?= session()->getFlashdata('pesan'); ?>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    <?php endif; ?>

                    <!-- Table with stripped rows -->
                    <table class="table datatable">
                        <thead>
                            <tr>
                                <th scope="col">No</th>
                                <th scope="col">Proses AMI / Standar</th>
                                <th scope="col">Tanggal Mulai - Selesai</th>
                                <th scope="col">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $i = 1; ?>
                            <?php foreach ($prosesAMI as $proses) : ?>
                                <tr>
                                    <th scope="row"><?= $i++; ?></th>
                                    <td><span class="green-box"><?= $proses['tahun']; ?></span> - <?= $proses['periode']; ?> / <?= $proses['standar']; ?></td>
                                    <td><?= $proses['tgl_mulai']; ?> - <?= $proses['tgl_selesai']; ?></td>
                                    <td>
                                        <?php if ($proses['status'] == 1 || $isAdmin) : ?>
                                            <a href="<?= base_url('hasil-ami/detail-pengendalian/' . $proses['id']); ?>" class="btn btn-primary btn-sm"><i class="bi bi-eye-fill" title="Detail"></i></a>
                                        <?php else : ?>
                                            <!-- Tautan tidak dapat diakses jika status adalah 0 -->
                                            <button class="btn btn-secondary btn-sm" disabled><i class="bi bi-eye-fill" title="Detail"></i></button>
                                        <?php endif; ?>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                    <!-- End Table with stripped rows -->
                </div>
            </div>
        </div>
    </div>
</section>

<?= $this->endsection(); ?>