<?= $this->extend('Layout/template'); ?>

<?= $this->section('content'); ?>

<section class="section">
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Delete Confirmation</h5>

                    <!-- Display the error message -->
                    <?php if (session()->has('error')) : ?>
                        <div class="alert alert-danger">
                            <?= session('error') ?>
                        </div>
                    <?php endif; ?>

                    <!-- Display confirmation message -->
                    <p>Anda yakin ingin menghapus data Hasil AMI dan Evaluasi terkait?</p>
                    <form method="post" action="<?= base_url('hasil-ami/delete/' . $hasilAMI['id']); ?>">
                        <?= csrf_field() ?>
                        <button type="submit" name="confirm_delete" class="btn btn-danger">Hapus</button>
                        <a href="<?= base_url('hasil-ami'); ?>" class="btn btn-secondary">Batal</a>
                    </form>

                </div>
            </div>
        </div>
    </div>
</section>

<?= $this->endsection(); ?>