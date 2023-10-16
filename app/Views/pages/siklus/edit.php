<?= $this->extend('Layout/template'); ?>

<?= $this->section('content'); ?>
<div class="card">
    <div class="card-body">
        <div class="card-title">Edit Data Siklus</div>
        <?php if (session()->has('pesan')) : ?>
            <div class="alert alert-danger">
                <?= session('pesan') ?>
            </div>
        <?php endif; ?>
        <!-- Floating Labels Form -->
        <form action="<?= base_url('/siklus/update/' . $siklus['id']); ?>" method="post" class="row g-3">
            <?= csrf_field(); ?>
            <div class="col-md-12">
                <div class="form-floating">
                    <input type="number" class="form-control <?= (session('errors.tahun')) ? 'is-invalid' : ''; ?>" id="tahun" name="tahun" value="<?= old('tahun', $siklus['tahun']); ?>" min="2023-01-01" max="2025-12-31" step="1">
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
                    <select class="form-control <?= (session('errors.periode')) ? 'is-invalid' : ''; ?>" id="periode" name="periode">
                        <option value="">--- Pilih Periode Akademik ---</option>
                        <option value="Ganjil" <?= ($siklus['periode'] == 'Ganjil') ? 'selected' : ''; ?>>Ganjil</option>
                        <option value="Genap" <?= ($siklus['periode'] == 'Genap') ? 'selected' : ''; ?>>Genap</option>
                        <option value="Tahunan" <?= ($siklus['periode'] == 'Tahunan') ? 'selected' : ''; ?>>Tahunan</option>
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
                <button type="submit" class="btn btn-primary">Update</button>
                <a href="/siklus" class="btn btn-secondary">Kembali</a>
            </div>
        </form>

    </div>
</div>

<?= $this->endSection(); ?>