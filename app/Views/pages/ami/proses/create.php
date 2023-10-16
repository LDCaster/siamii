<?= $this->extend('Layout/template'); ?>

<?= $this->section('content'); ?>
<div class="card">
    <div class="card-body">
        <div class="card-title">Tambah Proses AMI</div>

        <!-- menampilkan pesan alert -->
        <?php if (session()->has('pesan')) : ?>
            <div class="alert alert-danger">
                <?= session('pesan') ?>
            </div>
        <?php endif; ?>

        <!-- Floating Labels Form -->
        <form action="<?= base_url('/proses-ami/save'); ?>" method="post" class="row g-3">
            <?= csrf_field(); ?>
            <div class="col-md-12">
                <div class="form-floating mb-3">
                    <select class="form-select <?= (session('errors.tahun_periode_id')) ? 'is-invalid' : ''; ?>" aria-label="Unit" id="tahun_periode_id" name="tahun_periode_id">
                        <option selected>--- Pilih Periode ---</option>
                        <?php foreach ($siklus as $u) : ?>
                            <option value="<?= $u['id']; ?>"><?= $u['tahun']; ?> - <?= $u['periode']; ?></option>
                        <?php endforeach; ?>
                    </select>
                    <label for="tahun_periode_id">Periode</label>
                    <?php if (session('errors')) : ?>
                        <?php if (array_key_exists('tahun_periode_id', session('errors'))) : ?>
                            <div class="invalid-feedback">
                                <?= session('errors')['tahun_periode_id']; ?>
                            </div>
                        <?php endif; ?>
                    <?php endif; ?>
                </div>
            </div>
            <div class="col-md-12">
                <div class="form-floating mb-3">
                    <select class="form-select <?= (session('errors.standar_id')) ? 'is-invalid' : ''; ?>" aria-label="Unit" id="standar_id" name="standar_id">
                        <option selected>--- Pilih Standar ---</option>
                        <?php foreach ($standar as $s) : ?>
                            <option value="<?= $s['id']; ?>"><?= $s['nama']; ?></option>
                        <?php endforeach; ?>
                    </select>
                    <label for="standar_id">Standar</label>
                    <?php if (session('errors')) : ?>
                        <?php if (array_key_exists('standar_id', session('errors'))) : ?>
                            <div class="invalid-feedback">
                                <?= session('errors')['standar_id']; ?>
                            </div>
                        <?php endif; ?>
                    <?php endif; ?>
                </div>
            </div>
            <div class="col-md-12">
                <div class="form-floating mb-3">
                    <select class="form-select <?= (session('errors.auditor_id')) ? 'is-invalid' : ''; ?>" aria-label="auditor" id="auditor_id" name="auditor_id">
                        <option selected>--- Pilih Auditor ---</option>
                        <?php foreach ($users as $u) : ?>
                            <option value="<?= $u['id']; ?>"><?= $u['nama']; ?></option>
                        <?php endforeach; ?>
                    </select>
                    <label for="auditor_id">Auditor</label>
                    <?php if (session('errors')) : ?>
                        <?php if (array_key_exists('auditor_id', session('errors'))) : ?>
                            <div class="invalid-feedback">
                                <?= session('errors')['auditor_id']; ?>
                            </div>
                        <?php endif; ?>
                    <?php endif; ?>
                </div>
            </div>
            <div class="col-md-12">
                <div class="form-floating">
                    <input type="date" class="form-control <?= (session('errors.tgl_mulai')) ? 'is-invalid' : ''; ?>" id="tgl_mulai" name="tgl_mulai" placeholder="tgl_mulai Akademik" value="<?= old('tgl_mulai'); ?>">
                    <label for="tgl_mulai">Tanggal Mulai</label>
                    <?php if (session('errors') && array_key_exists('tgl_mulai', session('errors'))) : ?>
                        <div class="invalid-feedback">
                            <?= session('errors')['tgl_mulai']; ?>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
            <div class="col-md-12">
                <div class="form-floating">
                    <input type="date" class="form-control <?= (session('errors.tgl_selesai')) ? 'is-invalid' : ''; ?>" id="tgl_selesai" name="tgl_selesai" placeholder="tgl_selesai Akademik" value="<?= old('tgl_selesai'); ?>">
                    <label for="tgl_selesai">Tanggal Selesai</label>
                    <?php if (session('errors') && array_key_exists('tgl_selesai', session('errors'))) : ?>
                        <div class="invalid-feedback">
                            <?= session('errors')['tgl_selesai']; ?>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
            <div class="text-left">
                <button type="submit" class="btn btn-primary">Simpan</button>
                <a href="/proses-ami" class="btn btn-secondary">Kembali</a>
            </div>
        </form><!-- End floating Labels Form -->
    </div>
</div>


<?= $this->endSection(); ?>