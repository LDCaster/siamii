<?= $this->extend('Layout/template'); ?>

<?= $this->section('content'); ?>
<div class="card">
    <div class="card-body">
        <div class="card-title">Evaluasi Diri</div>

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
                    <td><strong>Butiran Mutu </strong></td>
                    <td style="padding-left: 20px;"> : </td>
                    <td style="padding-left: 10px;"><?= $hasilAMI['butiran_mutu_isi']; ?></td>
                </tr>
                <tr>
                    <td><strong>Indikator Target </strong></td>
                    <td style=" padding-left: 20px;"> : </td>
                    <td style=" padding-left: 10px;"><?= $hasilAMI['indikator_target']; ?></td>
                </tr>
                <td></td>
            </tbody>
        </table>


        <!-- Floating Labels Form -->
        <form action=" <?= base_url('/hasil-ami/update-evaluasi-diri/' . $evaluasi['id']); ?>" method="post" class="row g-3 mt-2">
            <?= csrf_field(); ?>
            <div class="col-md-12">
                <div class="form-floating">
                    <select class="form-select <?= (session('errors.status_ketercapaian')) ? 'is-invalid' : ''; ?>" id="status_ketercapaian" name="status_ketercapaian">
                        <option value="Tercapai" <?= (old('status_ketercapaian') === 'Tercapai' || $evaluasi['status_ketercapaian'] === 'Tercapai') ? 'selected' : ''; ?>>Tercapai</option>
                        <option value="Tidak Tercapai" <?= (old('status_ketercapaian') === 'Tidak Tercapai' || $evaluasi['status_ketercapaian'] === 'Tidak Tercapai') ? 'selected' : ''; ?>>Tidak Tercapai</option>
                    </select>
                    <label for="status_ketercapaian">Status Ketercapaian</label>
                    <?php if (session('errors') && array_key_exists('status_ketercapaian', session('errors'))) : ?>
                        <div class="invalid-feedback">
                            <?= session('errors')['status_ketercapaian']; ?>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
            <div class="col-md-12">
                <div class="form-floating">
                    <input type="text" class="form-control <?= (session('errors.hasil_evaluasi_diri')) ? 'is-invalid' : ''; ?>" id="hasil_evaluasi_diri" name="hasil_evaluasi_diri" placeholder="Nama hasil_evaluasi_diri" value="<?= (old('hasil_evaluasi_diri')) ? old('hasil_evaluasi_diri') : $evaluasi['hasil_evaluasi_diri']; ?>">
                    <label for="hasil_evaluasi_diri">Hasil Evaluasi Diri</label>
                    <?php if (session('errors') && array_key_exists('hasil_evaluasi_diri', session('errors'))) : ?>
                        <div class="invalid-feedback">
                            <?= session('errors')['hasil_evaluasi_diri']; ?>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
            <div class="col-md-12">
                <div class="form-floating">
                    <input type="text" class="form-control <?= (session('errors.bukti_evaluasi_diri')) ? 'is-invalid' : ''; ?>" id="bukti_evaluasi_diri" name="bukti_evaluasi_diri" placeholder="Nama bukti_evaluasi_diri" value="<?= (old('bukti_evaluasi_diri')) ? old('bukti_evaluasi_diri') : $evaluasi['bukti_evaluasi_diri']; ?>">
                    <label for="bukti_evaluasi_diri">Bukti Evaluasi Diri</label>
                    <?php if (session('errors') && array_key_exists('bukti_evaluasi_diri', session('errors'))) : ?>
                        <div class="invalid-feedback">
                            <?= session('errors')['bukti_evaluasi_diri']; ?>
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