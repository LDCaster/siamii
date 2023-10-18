<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>
<div class="card">
    <div class="card-body">
        <div class="card-title">Tambah Data Unit</div>
        <!-- Floating Labels Form -->
        <form action="<?= base_url('unit/save'); ?>" method="post" class="row g-3">
            <?= csrf_field(); ?>
            <div class="col-md-12">
                <div class="form-floating">
                    <input type="text" class="form-control <?= (session('errors.nama')) ? 'is-invalid' : ''; ?>" id="nama" name="nama" placeholder="Nama Unit/Program Studi" value="<?= old('nama'); ?>">
                    <label for="floatingName">Nama Unit/Program Studi</label>
                    <?php if (session('errors')) : ?>
                        <?php if (array_key_exists('nama', session('errors'))) : ?> <!-- Tambahkan kondisi if ini -->
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