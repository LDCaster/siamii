<?= $this->extend('Layout/template'); ?>

<?= $this->section('content'); ?>

<section class="section">
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Data User</h5>
                    <?php if (session()->getFlashdata('pesan')) : ?>
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <i class="bi bi-check-circle me-1"></i>
                            <?= session()->getFlashdata('pesan'); ?>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    <?php endif; ?>
                    <a href="<?= base_url('user/create'); ?>" class="btn btn-primary mb-3 mt-2">+ Add New</a>

                    <!-- Table with stripped rows -->
                    <table class="table datatable">
                        <thead>
                            <tr>
                                <th scope="col">No</th>
                                <th scope="col">Roles</th>
                                <th scope="col">Unit/Program Studi</th>
                                <th scope="col">Nama</th>
                                <th scope="col">NIK/NIP</th>
                                <th scope="col">Foto</th>
                                <th scope="col">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $i = 1; ?>
                            <?php foreach ($user as $u) : ?>
                                <tr>
                                    <th scote="row"><?= $i++; ?></th>
                                    <td><?= $u['role'] ?></td>
                                    <td><?= $u['nama_unit_prodi'] ?></td>
                                    <td><?= $u['nama']; ?></td>
                                    <td><?= $u['nik_nip']; ?></td>
                                    <td>
                                        <?php if (!empty($u['image'])) : ?>
                                            <img src="<?= base_url('assets/img/profile/' . $u['image']); ?>" alt="User Image" class="img-thumbnail rounded-circle" style="width: 50px; height: 50px;">
                                        <?php else : ?>
                                            <!-- Display a default image or a placeholder image if no image exists -->
                                            <img src="<?= base_url('assets/img/profile/default.png'); ?>" alt="User Image" class="img-thumbnail rounded-circle" style="width: 50px; height: 50px;">
                                        <?php endif; ?>
                                    </td>
                                    <td>
                                        <a href="<?= base_url('user/edit/' . $u['id']); ?>" class="btn btn-primary btn-sm"><i class="bi bi-pencil-square" title="Ubah"></i></a>
                                        <a href="<?= base_url('user/delete/' . $u['id']); ?>" class="btn btn-danger btn-sm" onclick="return confirm('Apakah Anda yakin ingin menghapus user ini?')"> <i class="bi bi-trash" title="Hapus"></i></a>
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