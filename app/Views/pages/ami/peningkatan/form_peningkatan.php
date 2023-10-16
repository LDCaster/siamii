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
                <tr>
                    <td class="card-title">Pengendalian</td>
                </tr>
                <tr>
                    <td><strong>Bukti RTM </strong></td>
                    <td style=" padding-left: 20px;"> : </td>
                    <td style=" padding-left: 10px;"><a href="<?= $hasilAMI['bukti_rtm']; ?>" target="_blank"><?= $hasilAMI['bukti_rtm']; ?></a></td>
                </tr>
                <tr>
                    <td><strong>Bukti RTM </strong></td>
                    <td style=" padding-left: 20px;"> : </td>
                    <td style=" padding-left: 10px;"><a href="<?= $hasilAMI['bukti_rtl']; ?>" target="_blank"><?= $hasilAMI['bukti_rtl']; ?></a></td>
                </tr>
            </tbody>
        </table>


        <!-- Floating Labels Form -->
        <form action=" <?= base_url('/hasil-ami/update-peningkatan/' . $evaluasi['id']); ?>" method="post" class="row g-3 mt-2">
            <?= csrf_field(); ?>
            <div class="col-md-12">
                <h5 class="card-title">Form Peningkatan</h5>
                <div class=" form-floating">
                    <input type="text" class="form-control <?= (session('errors.bukti_peningkatan')) ? 'is-invalid' : ''; ?>" id="bukti_peningkatan" name="bukti_peningkatan" placeholder="Nama bukti_peningkatan" value="<?= (old('bukti_peningkatan')) ? old('bukti_peningkatan') : $evaluasi['bukti_peningkatan']; ?>">
                    <label for="bukti_peningkatan">Bukti Peningkatan</label>
                    <?php if (session('errors') && array_key_exists('bukti_peningkatan', session('errors'))) : ?>
                        <div class="invalid-feedback">
                            <?= session('errors')['bukti_peningkatan']; ?>
                        </div>
                    <?php endif; ?>
                </div>
            </div>

            <div class="text-left">
                <button type="submit" class="btn btn-primary">Update</button>
                <a href="<?= base_url('/hasil-ami/detail-peningkatan/' . $hasilAMI['proses_ami_id']); ?>" class="btn btn-secondary">Kembali</a>
            </div>
        </form>

    </div>
</div>

<?= $this->endSection(); ?>