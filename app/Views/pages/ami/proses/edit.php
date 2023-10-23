<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>
<div class="card">
    <div class="card-body">
        <div class="card-title">Edit Proses AMI</div>
        <?php if (session()->has('pesan')) : ?>
            <div class="alert alert-danger">
                <?= session('pesan') ?>
            </div>
        <?php endif; ?>
        <!-- Floating Labels Form -->
        <form action="<?= base_url('/proses-ami/update/' . $prosesAMI['id']); ?>" method="post" class="row g-3">
            <?= csrf_field(); ?>
            <div class="col-md-4">
                <div class="form-floating">
                    <select class="form-select <?= (session('errors.tahun_periode_id')) ? 'is-invalid' : ''; ?>" id="tahun_periode_id" name="tahun_periode_id">
                        <option value="">--- Pilih Periode ---</option>
                        <?php foreach ($siklus as $s) : ?>
                            <option value="<?= $s['id']; ?>" <?= ($prosesAMI['tahun_periode_id'] == $s['id']) ? 'selected' : ''; ?>>
                                <?= $s['tahun']; ?> - <?= $s['periode']; ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                    <label for="tahun_periode_id">Periode <span style="color: red;">*</span></label>
                    <?php if (session('errors') && array_key_exists('tahun_periode_id', session('errors'))) : ?>
                        <div class="invalid-feedback">
                            <?= session('errors')['tahun_periode_id']; ?>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
            <div class="col-md-8">
                <div class="form-floating">
                    <select class="form-select <?= (session('errors.standar_id')) ? 'is-invalid' : ''; ?>" id="standar_id" name="standar_id">
                        <option value="">--- Pilih Standar ---</option>
                        <?php foreach ($standar as $s) : ?>
                            <option value="<?= $s['id']; ?>" <?= ($prosesAMI['standar_id'] == $s['id']) ? 'selected' : ''; ?>>
                                <?= $s['nama']; ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                    <label for="standar_id">Standar <span style="color: red;">*</span></label>
                    <?php if (session('errors') && array_key_exists('standar_id', session('errors'))) : ?>
                        <div class="invalid-feedback">
                            <?= session('errors')['standar_id']; ?>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
            <div class="col-md-12">
                <div class="form-floating">
                    <select class="form-select <?= (session('errors.auditor_id')) ? 'is-invalid' : ''; ?>" id="auditor_id" name="auditor_id">
                        <option value="">--- Pilih Auditor ---</option>
                        <?php foreach ($users as $u) : ?>
                            <option value="<?= $u['id']; ?>" <?= ($prosesAMI['auditor_id'] == $u['id']) ? 'selected' : ''; ?>>
                                <?= $u['nama']; ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                    <label for="auditor_id">Auditor <span style="color: red;">*</span></label> <!-- Ganti "Standar" menjadi "Auditor" -->
                    <?php if (session('errors') && array_key_exists('auditor_id', session('errors'))) : ?>
                        <div class="invalid-feedback">
                            <?= session('errors')['auditor_id']; ?>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-floating">
                    <input type="date" class="form-control <?= (session('errors.tgl_mulai')) ? 'is-invalid' : ''; ?>" id="tgl_mulai" name="tgl_mulai" placeholder="tgl_mulai Akademik" value="<?= $prosesAMI['tgl_mulai']; ?>">
                    <label for="tgl_mulai">Tanggal Mulai <span style="color: red;">*</span></label>
                    <?php if (session('errors') && array_key_exists('tgl_mulai', session('errors'))) : ?>
                        <div class="invalid-feedback">
                            <?= session('errors')['tgl_mulai']; ?>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-floating">
                    <input type="date" class="form-control <?= (session('errors.tgl_selesai')) ? 'is-invalid' : ''; ?>" id="tgl_selesai" name="tgl_selesai" placeholder="tgl_selesai Akademik" value="<?= $prosesAMI['tgl_selesai']; ?>">
                    <label for="tgl_selesai">Tanggal Selesai <span style="color: red;">*</span></label>
                    <?php if (session('errors') && array_key_exists('tgl_selesai', session('errors'))) : ?>
                        <div class="invalid-feedback">
                            <?= session('errors')['tgl_selesai']; ?>
                        </div>
                    <?php endif; ?>
                </div>
            </div>

            <div class="text-left">
                <button type="submit" class="btn btn-primary">Update</button>
                <a href="/proses-ami" class="btn btn-secondary">Kembali</a>
            </div>
        </form>
    </div>
</div>

<?= $this->endSection(); ?>