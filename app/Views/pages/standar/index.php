<?= $this->extend('Layout/template'); ?>
<?= $this->section('content'); ?>

<section class="section">
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Data Standar</h5>

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

                    <a href="<?= base_url('standar/create'); ?>" class="btn btn-primary mb-3 mt-2">+ Add New</a>
                    <!-- Table with stripped rows -->
                    <table class="table datatable">
                        <thead>
                            <tr>
                                <th scope="col">No</th>
                                <th scope="col">Nama Standar</th>
                                <th scope="col">Unit/Program Studi</th>
                                <th scope="col">Tahun Periode</th>
                                <th scope="col">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $i = 1; ?>
                            <?php foreach ($standar as $str) : ?>
                                <tr>
                                    <th scope="row"><?= $i++; ?></th>
                                    <td><?= $str['nama']; ?></td>
                                    <td><?= $str['nama_unit_prodi']; ?></td>
                                    <td><?= $str['tahun_periode']; ?></td>
                                    <td>
                                        <a href="<?= base_url('sub-standar/' . $str['id']); ?>" class="btn btn-primary btn-sm"><i class="bi bi-eye" title="Lihat Sub Standar"></i></a>
                                        <a href="<?= base_url('standar/edit/' . $str['id']); ?>" class="btn btn-primary btn-sm"><i class="bi bi-pencil-square" title="Ubah"></i></a>
                                        <a href="<?= base_url('standar/delete/' . $str['id']); ?>" class="btn btn-danger btn-sm" onclick="return confirm('Apakah Anda yakin ingin menghapus standar ini?')"><i class="bi bi-trash" title="Hapus"></i></a>
                                    </td>
                                    <!-- <td><span class="green-circle"></span></td> -->
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

<?= $this->endSection(); ?>