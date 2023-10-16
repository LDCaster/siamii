<?= $this->extend('Layout/template'); ?>

<?= $this->section('content'); ?>
<div class="card">
    <div class="card-body">
        <div class="card-title">Ubah Sub Standar</div>
        <!-- Floating Labels Form -->
        <form action="<?= base_url('sub-standar/update/' . $substandar['id']); ?>" method="post" class="row g-3">
            <?= csrf_field(); ?>
            <div class="col-md-12">
                <div class="form-floating">
                    <input type="text" class="form-control <?= (session('errors.nama_sub')) ? 'is-invalid' : ''; ?>" id="nama_sub" name="nama_sub" placeholder="Nama Sub Standar" value="<?= $substandar['nama_sub']; ?>">
                    <label for="nama_sub">Nama Sub Standar</label>
                    <?php if (session('errors')) : ?>
                        <?php if (array_key_exists('nama_sub', session('errors'))) : ?>
                            <div class="invalid-feedback">
                                <?= session('errors')['nama_sub']; ?>
                            </div>
                        <?php endif; ?>
                    <?php endif; ?>
                </div>
            </div>
            <div class="text-left">
                <button type="submit" class="btn btn-primary">Simpan</button>
                <a href="<?= base_url('/sub-standar/' . $standarId); ?>" class="btn btn-secondary">Kembali</a>
            </div>
        </form><!-- End Floating Labels Form -->
    </div>
</div>

<?= $this->endSection(); ?>