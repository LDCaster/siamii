<?= $this->extend('Layout/template'); ?>

<?= $this->section('content'); ?>
<main>
    <div class="container">

        <section class="section register min-vh-100 d-flex flex-column align-items-center justify-content-center py-4">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-4 col-md-6 d-flex flex-column align-items-center justify-content-center">

                        <div class="d-flex justify-content-center py-4">
                            <a href="index.html" class="logo d-flex align-items-center w-auto">
                                <img src="<?= base_url('assets/img/logo.png'); ?>" alt="">
                                <span class="d-none d-lg-block">AMI</span>
                            </a>
                        </div><!-- End Logo -->

                        <div class="card mb-3">

                            <div class="card-body">


                                <div class="pt-4 pb-2">
                                    <h5 class="card-title text-center pb-0 fs-4">Hubungkan Akun Anda</h5>
                                    <p class="text-center small">Isi NIK/NIP & password untuk Login</p>
                                </div>

                                <?php if (session()->getFlashdata('error')) : ?>
                                    <div style="color: red;"><?= session()->getFlashdata('error') ?></div>
                                <?php endif; ?>

                                <form class="row g-3 needs-validation" action="<?= base_url('/login'); ?>" method="post" novalidate>
                                    <?= csrf_field(); ?>
                                    <div class="col-12">
                                        <label for="nik_nip" class="form-label">NIK/NIP</label>
                                        <div class="input-group">
                                            <input type="text" name="nik_nip" class="form-control" id="nik_nip" required>
                                            <div class="invalid-feedback">Isikan NIK/NIP.</div>
                                        </div>
                                    </div>

                                    <div class="col-12">
                                        <label for="password" class="form-label">Password</label>
                                        <input type="password" name="password" class="form-control" id="password" required>
                                        <div class="invalid-feedback">Isikan Password.</div>
                                    </div>

                                    <div class="col-12">
                                        <button class="btn btn-primary w-100" type="submit">Masuk</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </section>

    </div>
</main><!-- End #main -->
<?= $this->endSection(); ?>