<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>
<div class="card">
    <div class="card-body">
        <div class="card-title">Tambah Data Standar</div>
        <!-- Floating Labels Form -->
        <form action="<?= base_url('/standar/update/' . $standar['id']); ?>" method="post" class="row g-3">
            <?= csrf_field(); ?>
            <div class="col-md-12">
                <div class="form-floating">
                    <input type="text" class="form-control <?= (session('errors.nama')) ? 'is-invalid' : ''; ?>" id="nama" name="nama" placeholder="Nama Standar" value="<?= (old('nama')) ? old('nama') : $standar['nama']; ?>">
                    <label for="nama">Nama Standar</label>
                    <?php if (session('errors') && array_key_exists('nama', session('errors'))) : ?>
                        <div class="invalid-feedback">
                            <?= session('errors')['nama']; ?>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
            <div class="col-md-12">
                <div class="form-floating mb-3">
                    <select class="form-select <?= (session('errors.unit_prodi_id')) ? 'is-invalid' : ''; ?>" aria-label="Unit" id="unit_prodi_id" name="unit_prodi_id">
                        <option value="">--- Pilih Unit ---</option>
                        <?php foreach ($unit as $u) : ?>
                            <option value="<?= $u['id']; ?>" <?= ($u['id'] == $standar['unit_prodi_id']) ? 'selected' : ''; ?>><?= $u['nama']; ?></option>
                        <?php endforeach; ?>
                    </select>
                    <label for="unit_prodi_id">Unit</label>
                    <?php if (session('errors') && array_key_exists('unit_prodi_id', session('errors'))) : ?>
                        <div class="invalid-feedback">
                            <?= session('errors')['unit_prodi_id']; ?>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
            <div class="col-md-12">
                <div class="form-floating">
                    <input type="text" class="form-control <?= (session('errors.tahun_periode')) ? 'is-invalid' : ''; ?>" id="tahun_periode" name="tahun_periode" placeholder="Tahun Periode" value="<?= (old('tahun_periode')) ? old('tahun_periode') : $standar['tahun_periode']; ?>">
                    <label for="tahun_periode">Tahun Periode</label>
                    <?php if (session('errors') && array_key_exists('tahun_periode', session('errors'))) : ?>
                        <div class="invalid-feedback">
                            <?= session('errors')['tahun_periode']; ?>
                        </div>
                    <?php endif; ?>
                </div>
            </div>

            <div class="text-left">
                <button type="submit" class="btn btn-primary">Update</button>
                <a href="/standar" class="btn btn-secondary">Kembali</a>
            </div>
        </form>
    </div>
</div>


<?= $this->endSection(); ?>