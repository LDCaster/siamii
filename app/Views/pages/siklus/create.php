<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>
<div class="card">
    <div class="card-body">
        <div class="card-title">Tambah Data Siklus</div>
        <?php if (session()->has('pesan')) : ?>
            <div class="alert alert-danger">
                <?= session('pesan') ?>
            </div>
        <?php endif; ?>
        <!-- Floating Labels Form -->
        <form action="<?= base_url('/siklus/save'); ?>" method="post" class="row g-3">
            <?= csrf_field(); ?>
            <div class="col-md-12">
                <div class="form-floating">
                    <input type="number" class="form-control <?= (session('errors.tahun')) ? 'is-invalid' : ''; ?>" id="tahun" name="tahun" placeholder="Tahun Akademik" value="<?= old('tahun'); ?>">
                    <label for="tahun">Tahun Akademik</label>
                    <?php if (session('errors') && array_key_exists('tahun', session('errors'))) : ?>
                        <div class="invalid-feedback">
                            <?= session('errors')['tahun']; ?>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
            <div class="col-md-12">
                <div class="form-floating">
                    <select class="form-control <?= (session('errors.periode')) ? 'is-invalid' : ''; ?>" id="periode" name="periode" placeholder="Periode Akademik" value="<?= old('periode'); ?>">
                        <option selected>--- Pilih Periode Akademik ---</option>
                        <option value="Ganjil">Ganjil</option>
                        <option value="Genap">Genap</option>
                        <option value="Tahunan">Tahunan</option>
                    </select>
                    <label for="periode">Periode Akademik</label>
                    <?php if (session('errors') && array_key_exists('periode', session('errors'))) : ?>
                        <div class="invalid-feedback">
                            <?= session('errors')['periode']; ?>
                        </div>
                    <?php endif; ?>
                </div>
            </div>

            <div class="text-left">
                <button type="submit" class="btn btn-primary">Simpan</button>
                <a href="/siklus" class="btn btn-secondary">Kembali</a>
            </div>
        </form><!-- End floating Labels Form -->
    </div>
</div>

<?= $this->endSection(); ?>