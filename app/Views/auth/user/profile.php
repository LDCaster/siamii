<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>
<div class="card">
    <div class="card-body">
        <div class="card-title">User Profile</div>
        <?php if (session()->getFlashdata('success')) : ?>
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <i class="bi bi-check-circle me-1"></i>
                <?= session()->getFlashdata('success'); ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php endif; ?>

        <?php if (session('alert')) : ?>
            <div class="alert alert-danger">
                <?= session('alert') ?>
            </div>
        <?php endif; ?>

        <!-- Floating Labels Form -->
        <form action="<?= base_url('update-profile'); ?>" method="post" class="row g-3" enctype="multipart/form-data">
            <?= csrf_field(); ?>

            <!-- Bagian Role -->
            <div class="col-md-6">
                <div class="form-floating">
                    <input type="text" class="form-control <?= (session('errors.role')) ? 'is-invalid' : ''; ?>" id="role" name="role" placeholder="Role" value="<?= $user['role']; ?>" disabled>
                    <label for="role">Role</label>
                    <?php if (session('errors') && array_key_exists('role', session('errors'))) : ?>
                        <div class="invalid-feedback">
                            <?= session('errors')['role']; ?>
                        </div>
                    <?php endif; ?>
                </div>
            </div>

            <!-- Bagian Unit -->
            <div class="col-md-6">
                <div class="form-floating">
                    <input type="text" class="form-control <?= (session('errors.unit_prodi_id')) ? 'is-invalid' : ''; ?>" id="unit_prodi_id" name="unit_prodi_id" placeholder="Unit" value="<?= $user['nama_unit_prodi']; ?>" disabled>
                    <label for="unit_prodi_id">Unit</label>
                    <?php if (session('errors') && array_key_exists('unit_prodi_id', session('errors'))) : ?>
                        <div class="invalid-feedback">
                            <?= session('errors')['unit_prodi_id']; ?>
                        </div>
                    <?php endif; ?>
                </div>
            </div>

            <!-- Bagian NIK/NIP -->
            <div class="col-md-4">
                <div class="form-floating">
                    <input type="text" class="form-control <?= (session('errors.nik_nip')) ? 'is-invalid' : ''; ?>" id="nik_nip" name="nik_nip" placeholder="NIK/NIP" value="<?= $user['nik_nip']; ?>" disabled>
                    <label for="floatingName">NIK/NIP</label>
                    <?php if (session('errors') && array_key_exists('nik_nip', session('errors'))) : ?>
                        <div class="invalid-feedback">
                            <?= session('errors')['nik_nip']; ?>
                        </div>
                    <?php endif; ?>
                </div>
            </div>

            <!-- Bagian Nama -->
            <div class="col-md-8">
                <div class="form-floating">
                    <input type="text" class="form-control <?= (session('errors.nama')) ? 'is-invalid' : ''; ?>" id="nama" name="nama" placeholder="Nama" value="<?= $user['nama']; ?>">
                    <label for="floatingName">Nama</label>
                    <?php if (session('errors') && array_key_exists('nama', session('errors'))) : ?>
                        <div class="invalid-feedback">
                            <?= session('errors')['nama']; ?>
                        </div>
                    <?php endif; ?>
                </div>
            </div>

            <!-- Bagian Jabatan -->
            <div class="col-md-12">
                <div class="form-floating">
                    <input type="text" class="form-control <?= (session('errors.jabatan')) ? 'is-invalid' : ''; ?>" id="jabatan" name="jabatan" placeholder="Jabatan" value="<?= $user['jabatan']; ?>" disabled>
                    <label for="floatingName">Jabatan</label>
                    <?php if (session('errors') && array_key_exists('jabatan', session('errors'))) : ?>
                        <div class="invalid-feedback">
                            <?= session('errors')['jabatan']; ?>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
            <!-- Display the current photo -->
            <div class="col-md-2 mt-3">
                <img id="image-preview" src="<?= base_url('assets/img/profile/' . $user['image']); ?>" alt="Current User Image" width="100" class="rounded-circle">
            </div>

            <!-- Bagian New Image -->
            <div class="col-md-10">
                <div class="form-floating">
                    <input type="file" class="form-control <?= (session('errors.new_image')) ? 'is-invalid' : ''; ?>" id="new_image" name="new_image" placeholder="New Image">
                    <label for="new_image">New Image</label>
                    <?php if (session('errors') && array_key_exists('new_image', session('errors'))) : ?>
                        <div class="invalid-feedback">
                            <?= session('errors')['new_image']; ?>
                        </div>
                    <?php endif; ?>
                </div>
            </div>


            <!-- Bagian Email -->
            <div class="col-md-12">
                <div class="form-floating">
                    <input type="text" class="form-control <?= (session('errors.email')) ? 'is-invalid' : ''; ?>" id="email" name="email" placeholder="E-mail" value="<?= $user['email']; ?>">
                    <label for="floatingName">E-mail</label>
                    <?php if (session('errors') && array_key_exists('email', session('errors'))) : ?>
                        <div class="invalid-feedback">
                            <?= session('errors')['email']; ?>
                        </div>
                    <?php endif; ?>
                </div>
            </div>

            <!-- Bagian Password -->
            <div class="col-md-6">
                <div class="form-floating">
                    <input type="password" class="form-control <?= (session('errors.password')) ? 'is-invalid' : ''; ?>" id="password" name="password" placeholder="Password">
                    <label for="floatingName">Password</label>
                    <?php if (session('errors') && array_key_exists('password', session('errors'))) : ?>
                        <div class="invalid-feedback">
                            <?= session('errors')['password']; ?>
                        </div>
                    <?php endif; ?>
                </div>
            </div>

            <!-- Bagian Verifikasi Password -->
            <div class="col-md-6">
                <div class="form-floating">
                    <input type="password" class="form-control <?= (session('errors.verifikasi_password')) ? 'is-invalid' : ''; ?>" id="verifikasi_password" name="verifikasi_password" placeholder="Verifikasi Password">
                    <label for="floatingName">Verifikasi Password</label>
                    <?php if (session('errors') && array_key_exists('verifikasi_password', session('errors'))) : ?>
                        <div class="invalid-feedback">
                            <?= session('errors')['verifikasi_password']; ?>
                        </div>
                    <?php endif; ?>
                </div>
            </div>

            <!-- Tombol Simpan dan Kembali -->
            <div class="text-left">
                <button type="submit" class="btn btn-primary">Simpan</button>
            </div>
        </form><!-- End floating Labels Form -->

    </div>
</div>
<?= $this->endSection(); ?>