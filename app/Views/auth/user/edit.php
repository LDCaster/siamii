<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>
<div class="card">
    <div class="card-body">
        <div class="card-title">Edit Data User</div>
        <!-- Floating Labels Form -->
        <form action="<?= base_url('user/update/' . $user['id']); ?>" method="post" class="row g-3" enctype="multipart/form-data">
            <?= csrf_field(); ?>

            <!-- Bagian Role -->
            <div class="col-md-6">
                <div class="form-floating">
                    <select class="form-control <?= (session('errors.role')) ? 'is-invalid' : ''; ?>" id="role" name="role" aria-label="Default select example">
                        <option value="">--- Pilih Role ---</option>
                        <option value="admin" <?= ($user['role'] == 'admin') ? 'selected' : ''; ?>>Admin</option>
                        <option value="auditee" <?= ($user['role'] == 'auditee') ? 'selected' : ''; ?>>Auditee</option>
                        <option value="auditor" <?= ($user['role'] == 'auditor') ? 'selected' : ''; ?>>Auditor</option>
                    </select>
                    <label for="role">Role <span style="color: red;">*</span></label>
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
                    <select class="form-control <?= (session('errors.unit_prodi_id')) ? 'is-invalid' : ''; ?>" id="unit_prodi_id" name="unit_prodi_id" placeholder="Unit" aria-label="Default select example">
                        <option>--- Pilih Unit ---</option>
                        <?php foreach ($unit as $u) : ?>
                            <option value="<?= $u['id']; ?>" <?= ($u['id'] == $user['unit_prodi_id']) ? 'selected' : ''; ?>>
                                <?= $u['nama']; ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                    <label for="floatingName">Unit <span style="color: red;">*</span></label>
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
                    <input type="text" class="form-control <?= (session('errors.nik_nip')) ? 'is-invalid' : ''; ?>" id="nik_nip" name="nik_nip" placeholder="NIK/NIP" value="<?= $user['nik_nip']; ?>">
                    <label for="floatingName">NIK/NIP <span style="color: red;">*</span></label>
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
                    <label for="floatingName">Nama <span style="color: red;">*</span></label>
                    <?php if (session('errors') && array_key_exists('nama', session('errors'))) : ?>
                        <div class="invalid-feedback">
                            <?= session('errors')['nama']; ?>
                        </div>
                    <?php endif; ?>
                </div>
            </div>

            <!-- Bagian Jabatan -->
            <div class="col-md-4">
                <div class="form-floating">
                    <input type="text" class="form-control <?= (session('errors.jabatan')) ? 'is-invalid' : ''; ?>" id="jabatan" name="jabatan" placeholder="Jabatan" value="<?= $user['jabatan']; ?>">
                    <label for="floatingName">Jabatan</label>
                    <?php if (session('errors') && array_key_exists('jabatan', session('errors'))) : ?>
                        <div class="invalid-feedback">
                            <?= session('errors')['jabatan']; ?>
                        </div>
                    <?php endif; ?>
                </div>
            </div>

            <!-- Bagian Email -->
            <div class="col-md-8">
                <div class="form-floating">
                    <input type="text" class="form-control <?= (session('errors.email')) ? 'is-invalid' : ''; ?>" id="email" name="email" placeholder="E-mail" value="<?= $user['email']; ?>">
                    <label for="floatingName">E-mail <span style="color: red;">*</span></label>
                    <?php if (session('errors') && array_key_exists('email', session('errors'))) : ?>
                        <div class="invalid-feedback">
                            <?= session('errors')['email']; ?>
                        </div>
                    <?php endif; ?>
                </div>
            </div>

            <!-- Bagian New Image -->
            <div class="col-md-6">
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

            <!-- Display the current photo -->
            <div class="col-md-6 mt-3">
                <img id="image-preview" src="<?= base_url('assets/img/profile/' . $user['image']); ?>" alt="Current User Image" width="100" class="rounded-circle">
            </div>

            <!-- Bagian Password -->
            <div class="col-md-6">
                <div class="form-floating">
                    <input type="password" class="form-control <?= (session('errors.password')) ? 'is-invalid' : ''; ?>" id="password" name="password" placeholder="Password">
                    <label for="floatingName">Password <span style="color: red;">*</span></label>
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
                    <label for="floatingName">Verifikasi Password <span style="color: red;">*</span></label>
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
                <a href="/user" class="btn btn-secondary">Kembali</a>
            </div>
        </form><!-- End floating Labels Form -->

    </div>
</div>


<?= $this->endSection(); ?>