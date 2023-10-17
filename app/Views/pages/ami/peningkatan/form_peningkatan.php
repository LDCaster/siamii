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
                    <td class="card-title">Pengendalian</td>
                </tr>
                <tr>
                    <td><strong>Bukti RTM </strong></td>
                    <td style=" padding-left: 20px;"> : </td>
                    <td style=" padding-left: 10px;"><a href="<?= $prosesAMI[0]['bukti_rtm']; ?>" target="_blank"><?= $prosesAMI[0]['bukti_rtm']; ?></a></td>
                </tr>
                <tr>
                    <td><strong>Bukti RTM </strong></td>
                    <td style=" padding-left: 20px;"> : </td>
                    <td style=" padding-left: 10px;"><a href="<?= $prosesAMI[0]['bukti_rtl']; ?>" target="_blank"><?= $prosesAMI[0]['bukti_rtl']; ?></a></td>
                </tr>
            </tbody>
        </table>


        <!-- Floating Labels Form -->
        <form action=" <?= base_url('/hasil-ami/update-peningkatan/' . $prosesAMI[0]['id']); ?>" method="post" class="row g-3 mt-2">
            <?= csrf_field(); ?>
            <div class="col-md-12">
                <h5 class="card-title">Form Peningkatan</h5>
                <div class=" form-floating">
                    <input type="text" class="form-control <?= (session('errors.bukti_peningkatan')) ? 'is-invalid' : ''; ?>" id="bukti_peningkatan" name="bukti_peningkatan" placeholder="Nama bukti_peningkatan" value="<?= (old('bukti_peningkatan')) ? old('bukti_peningkatan') : $prosesAMI[0]['bukti_peningkatan']; ?>">
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
                <a href="<?= base_url('/peningkatan'); ?>" class="btn btn-secondary">Kembali</a>
            </div>
        </form>

    </div>
</div>

<?= $this->endSection(); ?>