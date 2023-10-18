<?= $this->extend('layout/template'); ?>
<?= $this->section('content'); ?>

<section class="section">
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Data Sub Standar <?= $standar['nama']; ?></h5>

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

                    <a href="<?= base_url('sub-standar/create/' . $standarId); ?>" class="btn btn-primary mb-3 mt-2">+ Tambah</a>

                    <a href="<?= base_url('standar'); ?>" class="btn btn-warning mb-3 mt-2"><- Kembali</a>
                            <!-- Table with stripped rows -->
                            <?php if (!empty($substandar)) : ?>
                                <table class="table datatable">
                                    <thead>
                                        <tr>
                                            <th scope="col">No</th>
                                            <th scope="col">Nama Standar</th>
                                            <th scope="col">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $i = 1; ?>
                                        <?php foreach ($substandar as $sub_str) : ?>
                                            <tr>
                                                <th scope="row"><?= $i++; ?></th>
                                                <td><?= $sub_str['nama_sub']; ?></td>
                                                <td>
                                                    <a href="<?= base_url('sub-standar/edit/' . $sub_str['id']); ?>" class="btn btn-primary btn-sm"><i class="bi bi-pencil-square" title="Ubah"></i></a>
                                                    <a href="<?= base_url('sub-standar/delete/' . $sub_str['id']); ?>" class="btn btn-danger btn-sm" onclick="return confirm('Apakah Anda yakin ingin menghapus sub standar ini?')"><i class="bi bi-trash" title="Hapus"></i></a>
                                                </td>
                                                <!-- <td><span class="green-circle"></span></td> -->
                                            </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
                            <?php else : ?>
                                <!-- Display a message when no sub-standards are available -->
                                <p>Data Sub Standar belum ada</p>
                            <?php endif; ?>
                            <!-- End Table with stripped rows -->
                </div>
            </div>
        </div>
    </div>
</section>

<?= $this->endSection(); ?>