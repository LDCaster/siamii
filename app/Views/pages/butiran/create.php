<?= $this->extend('Layout/template'); ?>

<?= $this->section('content'); ?>
<div class="card">
    <div class="card-body">
        <div class="card-title">Tambah Data Isi Butiran</div>
        <!-- Floating Labels Form -->
        <form action="<?= base_url('/butiran/save'); ?>" method="post" class="row g-3">
            <?= csrf_field(); ?>
            <div class="col-md-12">
                <div class="form-floating">
                    <select class="form-control <?= (session('errors.standar_id')) ? 'is-invalid' : ''; ?>" id="standar_id" name="standar_id" placeholder="Tahun Akademik" value="<?= old('standar_id'); ?>" aria-label="Default select example">
                        <option selected>--- Pilih Standar ---</option>
                        <?php foreach ($standar as $s) : ?>
                            <option value="<?= $s['id']; ?>"><?= $s['nama']; ?> - <?= $s['tahun_periode']; ?></option>
                        <?php endforeach; ?>
                    </select>
                    <label for="floatingName">Standar</label>
                    <?php if (session('errors') && array_key_exists('standar_id', session('errors'))) : ?>
                        <div class="invalid-feedback">
                            <?= session('errors')['standar_id']; ?>
                        </div>
                    <?php endif; ?>
                </div>
            </div>

            <div class="col-md-12">
                <div class="form-floating">
                    <select class="form-control <?= (session('errors.nama_sub')) ? 'is-invalid' : ''; ?>" id="nama_sub" name="nama_sub" placeholder="Butiran Mutu" aria-label="Default select example">
                        <option selected>--- Pilih Sub Standar ---</option>
                    </select>
                    <label for="floatingName">Sub Standar</label>
                    <?php if (session('errors') && array_key_exists('nama_sub', session('errors'))) : ?>
                        <div class="invalid-feedback">
                            <?= session('errors')['nama_sub']; ?>
                        </div>
                    <?php endif; ?>
                </div>
            </div>

            <div class="col-md-12">
                <div class="form-floating mb-3">
                    <textarea name="butiran_mutu_isi" id="butiran_mutu_isi" class="ckeditor"></textarea>
                </div>
            </div>
            <div class="text-left">
                <button type="submit" class="btn btn-primary">Simpan</button>
                <a href="/butiran" class="btn btn-secondary">Kembali</a>
            </div>
        </form><!-- End floating Labels Form -->
    </div>
</div>

<script>
    // Event listener untuk dropdown "standar_id"
    document.getElementById('standar_id').addEventListener('change', function() {
        var selectedStandarId = this.value;

        // Lakukan permintaan AJAX untuk mendapatkan substandar sesuai dengan standar yang dipilih
        fetch('/butiran/get-sub-standar/' + selectedStandarId)
            .then(function(response) {
                return response.json();
            })
            .then(function(data) {
                // Dapatkan dropdown "nama_sub"
                var substandarDropdown = document.getElementById('nama_sub');

                // Hapus semua opsi saat ini dari dropdown "nama_sub"
                substandarDropdown.innerHTML = '';

                // Tambahkan opsi yang baru berdasarkan data yang diterima dari server
                data.forEach(function(sub) {
                    var option = document.createElement('option');
                    option.value = sub.id; // Set the value to the sub_standar_id
                    option.textContent = sub.nama_sub;
                    substandarDropdown.appendChild(option);
                });
            });
    });
</script>

<?= $this->endSection(); ?>