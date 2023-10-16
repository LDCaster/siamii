<?= $this->extend('Layout/template'); ?>

<?= $this->section('content'); ?>

<section class="section">
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Data Butiran Isi</h5>
                    <?php if (session()->getFlashdata('pesan')) : ?>
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <i class="bi bi-check-circle me-1"></i>
                            <?= session()->getFlashdata('pesan'); ?>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    <?php endif; ?>
                    <a href="<?= base_url('butiran/create'); ?>" class="btn btn-primary mb-3 mt-2">+ Add New</a>

                    <!-- Table with stripped rows -->
                    <table class="table datatable">
                        <thead>
                            <tr>
                                <th scope="col">No</th>
                                <th scope="col">Standar - Sub Standar</th>
                                <th scope="col">Butiran Isi</th>
                                <th scope="col">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $i = 1; ?>
                            <?php foreach ($butiran as $butiran) : ?>
                                <th scope="row"><?= $i++; ?></th>
                                <td><span class="green-box"><?= $butiran['tahun_periode']; ?></span> <?= $butiran['nama']; ?> - <?= $butiran['nama_sub']; ?></td>
                                <td><?= $butiran['butiran_mutu_isi']; ?></td>
                                <td>
                                    <a href="<?= base_url('butiran/edit/' . $butiran['id']); ?>" class="btn btn-primary btn-sm"><i class="bi bi-pencil-square" title="Ubah"></i></a>
                                    <a href="<?= base_url('butiran/delete/' . $butiran['id']); ?>" class="btn btn-danger btn-sm" onclick="return confirm('Apakah Anda yakin ingin menghapus butiran ini?')"> <i class="bi bi-trash" title="Hapus"></i></a>
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

<?= $this->endSection(); ?>