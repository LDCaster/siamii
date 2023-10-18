<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>
<div class="card">
    <div class="card-body">
        <!-- <div class="card-title">Hasil Audit</div> -->

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
                    <td><strong>Standar </strong></td>
                    <td style="padding-left: 20px;"> : </td>
                    <td style="padding-left: 10px;"><?= $hasilAMI['nama_standar']; ?></td>
                </tr>
                <tr>
                    <td><strong>Sub Standar </strong></td>
                    <td style="padding-left: 20px;"> : </td>
                    <td style="padding-left: 10px;"><?= $hasilAMI['sub_standar']; ?></td>
                </tr>
                <tr>
                    <td><strong>Butiran Mutu </strong></td>
                    <td style="padding-left: 20px;"> : </td>
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
                <td></td>
            </tbody>
        </table>


        <!-- Floating Labels Form -->
        <form action=" <?= base_url('/hasil-ami/update-audit/' . $evaluasi['id']); ?>" method="post" class="row g-3 mt-2">
            <?= csrf_field(); ?>
            <div class="col-md-12">
                <h5 class="card-title">Audit Dokumen</h5>
                <div class=" form-floating">
                    <textarea name="hasil_audit_dokumen" id="hasil_audit_dokumen" class="ckeditor form-control <?= (session('errors.hasil_audit_dokumen')) ? 'is-invalid' : ''; ?>" placeholder="Hasil Audit Dokumen"><?= (old('hasil_audit_dokumen')) ? old('hasil_audit_dokumen') : $evaluasi['hasil_audit_dokumen']; ?></textarea>
                    <?php if (session('errors') && array_key_exists('hasil_audit_dokumen', session('errors'))) : ?>
                        <div class="invalid-feedback">
                            <?= session('errors')['hasil_audit_dokumen']; ?>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
            <div class="col-md-12">
                <div class="form-floating">
                    <input type="text" class="form-control <?= (session('errors.daftar_tilik')) ? 'is-invalid' : ''; ?>" id="daftar_tilik" name="daftar_tilik" placeholder="Nama daftar_tilik" value="<?= (old('daftar_tilik')) ? old('daftar_tilik') : $evaluasi['daftar_tilik']; ?>">
                    <label for="daftar_tilik">Daftar Tilik</label>
                    <?php if (session('errors') && array_key_exists('daftar_tilik', session('errors'))) : ?>
                        <div class="invalid-feedback">
                            <?= session('errors')['daftar_tilik']; ?>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
            <div class="col-md-12">
                <h5 class="card-title">Audit Lapangan</h5>
                <div class="form-floating">
                    <textarea name="hasil_temuan_audit" id="hasil_temuan_audit" class="ckeditor form-control <?= (session('errors.hasil_temuan_audit')) ? 'is-invalid' : ''; ?>" placeholder="Hasil Temuan Audit"><?= (old('hasil_temuan_audit')) ? old('hasil_temuan_audit') : $evaluasi['hasil_temuan_audit']; ?></textarea>
                    <?php if (session('errors') && array_key_exists('hasil_temuan_audit', session('errors'))) : ?>
                        <div class="invalid-feedback">
                            <?= session('errors')['hasil_temuan_audit']; ?>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
            <div class="col-md-12">
                <div class="form-floating">
                    <select class="form-select <?= (session('errors.status_temuan')) ? 'is-invalid' : ''; ?>" id="status_temuan" name="status_temuan">
                        <option value="Tidak Tercapai" <?= (old('status_temuan') == 'Tidak Tercapai' || $evaluasi['status_temuan'] == 'Tidak Tercapai') ? 'selected' : ''; ?>>Tidak Tercapai</option>
                        <option value="Tercapai" <?= (old('status_temuan') == 'Tercapai' || $evaluasi['status_temuan'] == 'Tercapai') ? 'selected' : ''; ?>>Tercapai</option>
                        <option value="Terlampaui" <?= (old('status_temuan') == 'Terlampaui' || $evaluasi['status_temuan'] == 'Terlampaui') ? 'selected' : ''; ?>>Terlampaui</option>
                    </select>
                    <label for="status_temuan">Status Temuan</label>
                    <?php if (session('errors') && array_key_exists('status_temuan', session('errors'))) : ?>
                        <div class="invalid-feedback">
                            <?= session('errors')['status_temuan']; ?>
                        </div>
                    <?php endif; ?>
                </div>
            </div>

            <div class="col-md-12">
                <div class="form-floating">
                    <input type="text" class="form-control <?= (session('errors.hasil_rekomendasi')) ? 'is-invalid' : ''; ?>" id="hasil_rekomendasi" name="hasil_rekomendasi" placeholder="Nama hasil_rekomendasi" value="<?= (old('hasil_rekomendasi')) ? old('hasil_rekomendasi') : $evaluasi['hasil_rekomendasi']; ?>">
                    <label for="hasil_rekomendasi">Hasil Rekomendasi</label>
                    <?php if (session('errors') && array_key_exists('hasil_rekomendasi', session('errors'))) : ?>
                        <div class="invalid-feedback">
                            <?= session('errors')['hasil_rekomendasi']; ?>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
            <div class="text-left">
                <button type="submit" class="btn btn-primary">Update</button>
                <a href="<?= base_url('/hasil-ami/detail/' . $hasilAMI['proses_ami_id']); ?>" class="btn btn-secondary">Kembali</a>
            </div>
        </form>

    </div>
</div>

<?= $this->endSection(); ?>