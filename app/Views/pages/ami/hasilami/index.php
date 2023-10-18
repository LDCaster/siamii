<?= $this->extend('layout/template'); ?>


<?= $this->section('content'); ?>

<section class="section">
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Audit Mutu Internal</h5>

                    <!-- Tampilkan pesan error jika ada -->
                    <?php if (session()->has('error')) : ?>
                        <div class="alert alert-danger">
                            <?= session('error') ?>
                        </div>
                    <?php endif; ?>
                    <?php if (session()->getFlashdata('pesan')) : ?>
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <i class="bi bi-check-circle me-1"></i>
                            <?= session()->getFlashdata('pesan'); ?>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    <?php endif; ?>

                    <a href="<?= base_url('hasil-ami/create/' . $prosesAMI['id']); ?>" class="btn btn-primary mb-3 mt-2">+ Add New</a>

                    <!-- Check if $hasilAMI is empty -->
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
                                        <a href="<?= base_url('hasil-ami/delete/' . $proses['id']); ?>" class="btn btn-danger btn-sm" onclick="return confirm('Apakah Anda yakin ingin menghapus hasil ini?')">
                                            <i class="bi bi-trash" title="Hapus"></i>
                                        </a>
                                    </div>
                                </div><!-- End Default Accordion Example -->
                            <?php endforeach; ?>
                        <?php endif; ?>

                            </div>
                </div>
            </div>
        </div>
</section>


<?= $this->endsection(); ?>