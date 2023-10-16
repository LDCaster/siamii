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
                                <th scope="col">Bukti RTM</th>
                                <th scope="col">Bukti RTL</th>
                                <th scope="col">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $i = 1; ?>
                            <?php foreach ($hasilAMI as $hasil) : ?>
                                <tr>
                                    <?php if (!empty($hasil['bukti_rtm']) || !empty($hasil['bukti_rtl'])) : ?>
                                        <th scope="row"><?= $i++; ?></th>
                                        <td>
                                            <?php if (!empty($hasil['bukti_rtm'])) : ?>
                                                <a class="btn btn-primary" href="<?= $hasil['bukti_rtm']; ?>" target="_blank"><i class="bi bi-link-45deg"></i></a>
                                            <?php endif; ?>
                                        </td>
                                        <td>
                                            <?php if (!empty($hasil['bukti_rtl'])) : ?>
                                                <a class="btn btn-primary" href="<?= $hasil['bukti_rtl']; ?>" target="_blank"><i class="bi bi-link-45deg"></i></a>
                                            <?php endif; ?>
                                        </td>
                                    <?php endif; ?>


                                    <td>
                                        <?php if ($hasil['bukti_rtm'] || $hasil['bukti_rtl']) : ?>
                                            <?php if ($hasil['bukti_peningkatan']) : ?>
                                                <a href="<?= base_url('hasil-ami/peningkatan/' . $hasil['id']); ?>" class="btn btn-success btn-sm">
                                                    <i class="bi bi-pencil-square" title="Peningkatan"></i>
                                                </a>
                                            <?php else : ?>
                                                <a href="<?= base_url('hasil-ami/peningkatan/' . $hasil['id']); ?>" class="btn btn-warning btn-sm">
                                                    <i class="bi bi-pencil-square" title="Peningkatan"></i>
                                                </a>
                                            <?php endif; ?>
                                        <?php else : ?>
                                            <a href="#" class="btn btn-warning btn-sm" hidden>
                                                <i class="bi bi-pencil-square" title="Peningkatan"></i>
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