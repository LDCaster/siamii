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

        <table class="table-borderless">
            <tbody>
                <tr>
                    <td class="card-title">Pelaksanaan AMI</td>
                </tr>
                <tr>
                    <td><strong>Butiran Mutu </strong></td>
                    <td style=" padding-left: 20px;"> : </td>
                    <td style="padding-left: 10px;"><?= $hasilAMI['butiran_mutu_isi']; ?></td>
                </tr>
                <tr>
                    <td><strong>Indikator Target </strong></td>
                    <td style=" padding-left: 20px;"> : </td>
                    <td style=" padding-left: 10px;"><?= $hasilAMI['indikator_target']; ?></td>
                </tr>
                <tr>
                    <td class="card-title">Evaluasi Diri (Auditee)</td>
                </tr>
                <tr>
                    <td><strong>Status Ketercapaian </strong></td>
                    <td style=" padding-left: 20px;"> : </td>
                    <td style=" padding-left: 10px;"><?= $hasilAMI['status_ketercapaian']; ?></td>
                </tr>
                <tr>
                    <td><strong>Hasil Evaluasi Diri </strong></td>
                    <td style=" padding-left: 20px;"> : </td>
                    <td style=" padding-left: 10px;"><?= $hasilAMI['hasil_evaluasi_diri']; ?></td>
                </tr>
                <tr>
                    <td><strong>Bukti Evaluasi Diri </strong></td>
                    <td style=" padding-left: 20px;"> : </td>
                    <td style=" padding-left: 10px;"><?= $hasilAMI['bukti_evaluasi_diri']; ?></td>
                </tr>
                <tr>
                    <td class="card-title">Audit Dokumen</td>
                </tr>
                <tr>
                    <td><strong>Hasil Audit Dokumen </strong></td>
                    <td style=" padding-left: 20px;"> : </td>
                    <td style=" padding-left: 10px;"><?= $hasilAMI['hasil_audit_dokumen']; ?></td>
                </tr>
                <tr>
                    <td><strong>Daftar Tilik </strong></td>
                    <td style=" padding-left: 20px;"> : </td>
                    <td style=" padding-left: 10px;"><?= $hasilAMI['daftar_tilik']; ?></td>
                </tr>
                <tr>
                    <td class="card-title">Audit Lapangan</td>
                </tr>
                <tr>
                    <td><strong>Hasil Temuan Audit </strong></td>
                    <td style=" padding-left: 20px;"> : </td>
                    <td style=" padding-left: 10px;"><?= $hasilAMI['hasil_temuan_audit']; ?></td>
                </tr>
                <tr>
                    <td><strong>Status Temuan </strong></td>
                    <td style=" padding-left: 20px;"> : </td>
                    <td style=" padding-left: 10px;"><?= $hasilAMI['status_temuan']; ?></td>
                </tr>
                <tr>
                    <td><strong>Hasil Rekomendasi </strong></td>
                    <td style=" padding-left: 20px;"> : </td>
                    <td style=" padding-left: 10px;"><?= $hasilAMI['hasil_rekomendasi']; ?></td>
                </tr>
                <td></td>
            </tbody>
        </table>


        <!-- Floating Labels Form -->
        <form action=" <?= base_url('/hasil-ami/update-pengendalian/' . $evaluasi['id']); ?>" method="post" class="row g-3 mt-2">
            <?= csrf_field(); ?>
            <div class="col-md-12">
                <h5 class="card-title">Form Pengendalian</h5>
                <div class=" form-floating">
                    <input type="text" class="form-control <?= (session('errors.bukti_rtm')) ? 'is-invalid' : ''; ?>" id="bukti_rtm" name="bukti_rtm" placeholder="Nama Bukti RTM" value="<?= (old('bukti_rtm')) ? old('bukti_rtm') : $evaluasi['bukti_rtm']; ?>">
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
                    <input type="text" class="form-control <?= (session('errors.bukti_rtl')) ? 'is-invalid' : ''; ?>" id="bukti_rtl" name="bukti_rtl" placeholder="Nama Bukti RTL" value="<?= (old('bukti_rtl')) ? old('bukti_rtl') : $evaluasi['bukti_rtl']; ?>">
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
                    <input type="text" class="form-control <?= (session('errors.deskripsi_pengendalian')) ? 'is-invalid' : ''; ?>" id="deskripsi_pengendalian" name="deskripsi_pengendalian" placeholder="Nama Deskripsi Pengendalian" value="<?= (old('deskripsi_pengendalian')) ? old('deskripsi_pengendalian') : $evaluasi['deskripsi_pengendalian']; ?>">
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
                <a href="<?= base_url('/hasil-ami/detail-pengendalian/' . $hasilAMI['proses_ami_id']); ?>" class="btn btn-secondary">Kembali</a>
            </div>
        </form>

    </div>
</div>

<?= $this->endSection(); ?>