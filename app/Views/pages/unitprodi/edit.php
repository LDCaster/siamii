<?= $this->extend('Layout/template'); ?>

<?= $this->section('content'); ?>
<div class="card">
    <div class="card-body">
        <div class="card-title">Ubah Data Unit</div>
        <!-- Floating Labels Form -->
        <form action="<?= base_url('unit/update/' . $unit['id']); ?>" method="post" class="row g-3">
            <?= csrf_field(); ?>
            <div class="col-md-12">
                <div class="form-floating">
                    <input type="text" class="form-control <?= (session('errors.nama')) ? 'is-invalid' : ''; ?>" id="nama" name="nama" placeholder="Nama Unit" value="<?= old('nama') ? old('nama') : $unit['nama']; ?>">
                    <label for="floatingName">Nama Unit</label>
                    <?php if (session('errors')) : ?>
                        <?php if (array_key_exists('nama', session('errors'))) : ?>
                            <div class="invalid-feedback">
                                <?= session('errors')['nama']; ?>
                            </div>
                        <?php endif; ?>
                    <?php endif; ?>
                </div>
            </div>

            <div class="text-left">
                <button type="submit" class="btn btn-primary">Simpan</button>
                <a href="/unit" class="btn btn-secondary">Kembali</a>
            </div>
        </form><!-- End floating Labels Form -->
    </div>
</div>

<?= $this->endSection(); ?>