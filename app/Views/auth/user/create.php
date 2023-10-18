<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>
<div class="card">
    <div class="card-body">
        <div class="card-title">Tambah Data User</div>
        <!-- Floating Labels Form -->
        <form action="<?= base_url('user/save'); ?>" method="post" class="row g-3" enctype="multipart/form-data">
            <?= csrf_field(); ?>
            <div class="col-md-12">
                <div class="form-floating">
                    <select class="form-control <?= (session('errors.role')) ? 'is-invalid' : ''; ?>" id="role" name="role" aria-label="Default select example">
                        <option value="admin" <?= (old('role') == 'admin') ? 'selected' : ''; ?>>Admin</option>
                        <option value="auditee" <?= (old('role') == 'auditee') ? 'selected' : ''; ?>>Auditee</option>
                        <option value="auditor" <?= (old('role') == 'auditor') ? 'selected' : ''; ?>>Auditor</option>
                    </select>
                    <label for="role">Role</label>
                    <?php if (session('errors') && array_key_exists('role', session('errors'))) : ?>
                        <div class="invalid-feedback">
                            <?= session('errors')['role']; ?>
                        </div>
                    <?php endif; ?>
                </div>
            </div>

            <div class="col-md-12">
                <div class="form-floating">
                    <select class="form-control <?= (session('errors.unit_prodi_id')) ? 'is-invalid' : ''; ?>" id="unit_prodi_id" name="unit_prodi_id" placeholder="Unit" aria-label="Default select example">
                        <option>--- Pilih Unit ---</option>
                        <?php foreach ($unit as $u) : ?>
                            <option value="<?= $u['id']; ?>" <?= (old('unit_prodi_id') == $u['id']) ? 'selected' : ''; ?>>
                                <?= $u['nama']; ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                    <label for="floatingName">Unit</label>
                    <?php if (session('errors') && array_key_exists('unit_prodi_id', session('errors'))) : ?>
                        <div class="invalid-feedback">
                            <?= session('errors')['unit_prodi_id']; ?>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
            <div class="col-md-12">
                <div class="form-floating">
                    <input type="text" class="form-control <?= (session('errors.nik_nip')) ? 'is-invalid' : ''; ?>" id="nik_nip" name="nik_nip" placeholder="NIK/NIP" value="<?= old('nik_nip'); ?>">
                    <label for="floatingName">NIK/NIP</label>
                    <?php if (session('errors')) : ?>
                        <?php if (array_key_exists('nik_nip', session('errors'))) : ?> <!-- Tambahkan kondisi if ini -->
                            <div class="invalid-feedback">
                                <?= session('errors')['nik_nip']; ?>
                            </div>
                        <?php endif; ?>
                    <?php endif; ?>
                </div>
            </div>
            <div class="col-md-12">
                <div class="form-floating">
                    <input type="text" class="form-control <?= (session('errors.nama')) ? 'is-invalid' : ''; ?>" id="nama" name="nama" placeholder="Nama" value="<?= old('nama'); ?>">
                    <label for="floatingName">Nama</label>
                    <?php if (session('errors')) : ?>
                        <?php if (array_key_exists('nama', session('errors'))) : ?> <!-- Tambahkan kondisi if ini -->
                            <div class="invalid-feedback">
                                <?= session('errors')['nama']; ?>
                            </div>
                        <?php endif; ?>
                    <?php endif; ?>
                </div>
            </div>
            <div class="col-md-12">
                <div class="form-floating">
                    <input type="text" class="form-control <?= (session('errors.jabatan')) ? 'is-invalid' : ''; ?>" id="jabatan" name="jabatan" placeholder="No Telp" value="<?= old('jabatan'); ?>">
                    <label for="floatingName">Jabatan</label>
                    <?php if (session('errors')) : ?>
                        <?php if (array_key_exists('jabatan', session('errors'))) : ?> <!-- Tambahkan kondisi if ini -->
                            <div class="invalid-feedback">
                                <?= session('errors')['jabatan']; ?>
                            </div>
                        <?php endif; ?>
                    <?php endif; ?>
                </div>
            </div>
            <div class="col-md-12">
                <div class="form-floating">
                    <input type="file" class="form-control <?= (session('errors.image')) ? 'is-invalid' : ''; ?>" id="image" name="image" placeholder="Image" value="<?= old('image'); ?>">
                    <label for="image">Image</label>
                    <?php if (session('errors')) : ?>
                        <?php if (array_key_exists('image', session('errors'))) : ?>
                            <div class="invalid-feedback">
                                <?= session('errors')['image']; ?>
                            </div>
                        <?php endif; ?>
                    <?php endif; ?>
                </div>
            </div>

            <!-- Display the selected image for new user -->
            <div class="col-md-12 mt-3">
                <img id="image-preview" src="<?= base_url('assets/img/profile/default.png'); ?>" alt="Selected Image" width="100" class="rounded-circle">
            </div>

            <div class="col-md-12">
                <div class="form-floating">
                    <input type="text" class="form-control <?= (session('errors.email')) ? 'is-invalid' : ''; ?>" id="email" name="email" placeholder="Image" value="<?= old('email'); ?>">
                    <label for="floatingName">E-mail</label>
                    <?php if (session('errors')) : ?>
                        <?php if (array_key_exists('email', session('errors'))) : ?> <!-- Tambahkan kondisi if ini -->
                            <div class="invalid-feedback">
                                <?= session('errors')['email']; ?>
                            </div>
                        <?php endif; ?>
                    <?php endif; ?>
                </div>
            </div>
            <div class="col-md-12">
                <div class="form-floating">
                    <input type="password" class="form-control <?= (session('errors.password')) ? 'is-invalid' : ''; ?>" id="password" name="password" placeholder="***" value="<?= old('password'); ?>">
                    <label for="floatingName">Password</label>
                    <?php if (session('errors')) : ?>
                        <?php if (array_key_exists('password', session('errors'))) : ?> <!-- Tambahkan kondisi if ini -->
                            <div class="invalid-feedback">
                                <?= session('errors')['password']; ?>
                            </div>
                        <?php endif; ?>
                    <?php endif; ?>
                </div>
            </div>
            <div class="col-md-12">
                <div class="form-floating">
                    <input type="password" class="form-control <?= (session('errors.verifikasi_password')) ? 'is-invalid' : ''; ?>" id="verifikasi_password" name="verifikasi_password" placeholder="***" value="<?= old('verifikasi_password'); ?>">
                    <label for="floatingName">Verifikasi Password</label>
                    <?php if (session('errors')) : ?>
                        <?php if (array_key_exists('verifikasi_password', session('errors'))) : ?> <!-- Tambahkan kondisi if ini -->
                            <div class="invalid-feedback">
                                <?= session('errors')['verifikasi_password']; ?>
                            </div>
                        <?php endif; ?>
                    <?php endif; ?>
                </div>
            </div>

            <div class="text-left">
                <button type="submit" class="btn btn-primary">Simpan</button>
                <a href="/user" class="btn btn-secondary">Kembali</a>
            </div>
        </form><!-- End floating Labels Form -->
    </div>
</div>

<?= $this->endSection(); ?>