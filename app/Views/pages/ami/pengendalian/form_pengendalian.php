<?= $this->extend('Layout/template'); ?>

<?= $this->section('content'); ?>
<div class="card">
    <div class="card-body">

        <?php if (session()->getFlashdata('pesan')) : ?>
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <i class="bi bi-check-circle me-1"></i>
                <?= session()->getFlashdata('pesan'); ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php endif; ?>

        <div style="margin-top: 20px; margin-bottom: -20px;">
            <?php if (empty($hasilAMI)) : ?>
                <div class="alert alert-warning">
                    Data Hasil Audit Mutu Internal Belum Ada
                </div>
            <?php else : ?>
                <!-- Default Accordion -->
                <?php foreach ($hasilAMI as $key => $proses) : ?>
                    <div class="accordion" id="accordionExample">
                        <div class="accordion-item">
                            <h1 class="accordion-header" id="heading<?= $key ?>">
                                <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapse<?= $key ?>" aria-expanded="true" aria-controls="collapse<?= $key ?>">
                                    <?= $proses['butiran_mutu_isi']; ?>
                                </button>
                            </h1>
                            <div id="collapse<?= $key ?>" class="accordion-collapse collapse" aria-labelledby="heading<?= $key ?>" data-bs-parent="#accordionExample">

                                <div class="accordion-body">
                                    <strong>Indikator Target : </strong> <?= $proses['indikator_target']; ?>.
                                </div>
                                <div id="collapse<?= $key ?>" class="accordion-collapse collapse" aria-labelledby="heading<?= $key ?>" data-bs-parent="#accordionExample">
                                    <div class="accordion-body">
                                        <strong>Status Ketercapaian : </strong> <?= $proses['status_ketercapaian']; ?>.
                                    </div>
                                </div>
                                <div id="collapse<?= $key ?>" class="accordion-collapse collapse " aria-labelledby="heading<?= $key ?>" data-bs-parent="#accordionExample">
                                    <div class="accordion-body">
                                        <strong>Hasil Evaluasi Diri : </strong> <?= $proses['hasil_evaluasi_diri']; ?>.
                                    </div>
                                </div>
                                <div id="collapse<?= $key ?>" class="accordion-collapse collapse " aria-labelledby="heading<?= $key ?>" data-bs-parent="#accordionExample">
                                    <div class="accordion-body">
                                        <strong>Bukti Evaluasi Diri : </strong> <a href="<?= $proses['bukti_evaluasi_diri']; ?>"><?= $proses['bukti_evaluasi_diri']; ?></a>.
                                    </div>
                                </div>
                                <div id="collapse<?= $key ?>" class="accordion-collapse collapse " aria-labelledby="heading<?= $key ?>" data-bs-parent="#accordionExample">
                                    <div class="accordion-body">
                                        <strong>Hasil Audit Dokumen : </strong> <?= $proses['hasil_audit_dokumen']; ?>.
                                    </div>
                                </div>
                                <div id="collapse<?= $key ?>" class="accordion-collapse collapse " aria-labelledby="heading<?= $key ?>" data-bs-parent="#accordionExample">
                                    <div class="accordion-body">
                                        <strong>Daftar Tilik : </strong> <?= $proses['daftar_tilik']; ?>.
                                    </div>
                                </div>
                                <div id="collapse<?= $key ?>" class="accordion-collapse collapse " aria-labelledby="heading<?= $key ?>" data-bs-parent="#accordionExample">
                                    <div class="accordion-body">
                                        <strong>Hasil Temuan Audit : </strong> <?= $proses['hasil_temuan_audit']; ?>.
                                    </div>
                                </div>
                                <div id="collapse<?= $key ?>" class="accordion-collapse collapse " aria-labelledby="heading<?= $key ?>" data-bs-parent="#accordionExample">
                                    <div class="accordion-body">
                                        <strong>Status Temuan : </strong> <?= $proses['status_temuan']; ?>.
                                    </div>
                                </div>
                                <div id="collapse<?= $key ?>" class="accordion-collapse collapse " aria-labelledby="heading<?= $key ?>" data-bs-parent="#accordionExample">
                                    <div class="accordion-body">
                                        <strong>Hasil Rekomendasi : </strong> <?= $proses['hasil_rekomendasi']; ?>.
                                    </div>
                                </div>
                                <div id="collapse<?= $key ?>" class="accordion-collapse collapse " aria-labelledby="heading<?= $key ?>" data-bs-parent="#accordionExample">
                                    <div class="accordion-body">
                                        <strong>Bukti RTM : </strong> <a href="<?= $proses['bukti_rtm']; ?>"><?= $proses['bukti_rtm']; ?></a> .
                                    </div>
                                </div>
                                <div id="collapse<?= $key ?>" class="accordion-collapse collapse " aria-labelledby="heading<?= $key ?>" data-bs-parent="#accordionExample">
                                    <div class="accordion-body">
                                        <strong>Bukti RTlL : </strong> <a href="<?= $proses['bukti_rtl']; ?>"><?= $proses['bukti_rtl']; ?></a>.
                                    </div>
                                </div>
                                <div id="collapse<?= $key ?>" class="accordion-collapse collapse " aria-labelledby="heading<?= $key ?>" data-bs-parent="#accordionExample">
                                    <div class="accordion-body">
                                        <strong>Deskripsi Pengendalian : </strong> <?= $proses['deskripsi_pengendalian']; ?>.
                                    </div>
                                </div>
                                <div id="collapse<?= $key ?>" class="accordion-collapse collapse " aria-labelledby="heading<?= $key ?>" data-bs-parent="#accordionExample">
                                    <div class="accordion-body">
                                        <strong>Bukti Peningkatan : </strong> <?= $proses['bukti_peningkatan']; ?>.
                                    </div>
                                </div>
                            </div>
                        </div><!-- End Default Accordion Example -->
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>

        <!-- Floating Labels Form -->
        <form action=" <?= base_url('/hasil-ami/update-pengendalian/' . $prosesAMI[0]['id']); ?>" method="post" class="row g-3 mt-2">
            <?= csrf_field(); ?>
            <div class="col-md-12">
                <h5 class="card-title">Form Pengendalian</h5>
                <div class=" form-floating">
                    <input type="text" class="form-control <?= (session('errors.bukti_rtm')) ? 'is-invalid' : ''; ?>" id="bukti_rtm" name="bukti_rtm" placeholder="Nama Bukti RTM" value="<?= (old('bukti_rtm')) ? old('bukti_rtm') : $prosesAMI[0]['bukti_rtm']; ?>">
                    <label for="bukti_rtm">Bukti RTM</label>
                    <?php if (session('errors') && array_key_exists('bukti_rtm', session('errors'))) : ?>
                        <div class="invalid-feedback">
                            <?= session('errors')['bukti_rtm']; ?>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
            <div class="col-md-12">
                <div class="form-floating">
                    <input type="text" class="form-control <?= (session('errors.bukti_rtl')) ? 'is-invalid' : ''; ?>" id="bukti_rtl" name="bukti_rtl" placeholder="Nama Bukti RTL" value="<?= (old('bukti_rtl')) ? old('bukti_rtl') : $prosesAMI[0]['bukti_rtl']; ?>">
                    <label for="bukti_rtl">Bukti RTL</label>
                    <?php if (session('errors') && array_key_exists('bukti_rtl', session('errors'))) : ?>
                        <div class="invalid-feedback">
                            <?= session('errors')['bukti_rtl']; ?>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
            <div class="col-md-12">
                <div class="form-floating">
                    <input type="text" class="form-control <?= (session('errors.deskripsi_pengendalian')) ? 'is-invalid' : ''; ?>" id="deskripsi_pengendalian" name="deskripsi_pengendalian" placeholder="Nama Deskripsi Pengendalian" value="<?= (old('deskripsi_pengendalian')) ? old('deskripsi_pengendalian') : $prosesAMI[0]['deskripsi_pengendalian']; ?>">
                    <label for="deskripsi_pengendalian">Deskripsi</label>
                    <?php if (session('errors') && array_key_exists('deskripsi_pengendalian', session('errors'))) : ?>
                        <div class="invalid-feedback">
                            <?= session('errors')['deskripsi_pengendalian']; ?>
                        </div>
                    <?php endif; ?>
                </div>
            </div>

            <div class="text-left">
                <button type="submit" class="btn btn-primary">Update</button>
                <a href="<?= base_url('/pengendalian'); ?>" class="btn btn-secondary">Kembali</a>
            </div>
        </form>

    </div>
</div>

<?= $this->endSection(); ?>