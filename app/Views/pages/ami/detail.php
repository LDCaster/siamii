<?= $this->extend('Layout/template'); ?>

<?= $this->section('content'); ?>

<section class="section">
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Hasil Audit Mutu Internal</h5>

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
                                <th scope="col">Butir Mutu</th>
                                <th scope="col">Indikator Target</th>
                                <th scope="col">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $i = 1; ?>
                            <?php foreach ($hasilAMI as $hasil) : ?>
                                <tr>
                                    <th scope="row"><?= $i++; ?></th>
                                    <td id="left-align"><?= $hasil['butiran_mutu_isi']; ?></td>
                                    <td><?= $hasil['indikator_target']; ?></td>

                                    <td>
                                        <?php if ($hasil['status_ketercapaian'] && $hasil['hasil_evaluasi_diri'] && $hasil['bukti_evaluasi_diri']) : ?>
                                            <a href="<?= base_url('hasil-ami/evaluasi-diri/' . $hasil['id']); ?>" class="btn btn-success btn-sm">
                                                <i class="bi bi-clipboard-fill" title="Evaluasi Diri"></i>
                                            </a>
                                        <?php else : ?>
                                            <a href="<?= base_url('hasil-ami/evaluasi-diri/' . $hasil['id']); ?>" class="btn btn-warning btn-sm">
                                                <i class="bi bi-clipboard-fill" title="Evaluasi Diri"></i>
                                            </a>
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