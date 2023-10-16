<?= $this->extend('Layout/template'); ?>

<?= $this->section('content'); ?>
<div class="card">
    <div class="card-body">
        <div class="card-title">Tambah Data Isi Butiran</div>

        <?php if (session()->has('pesan')) : ?>
            <div class="alert alert-danger">
                <?= session('pesan') ?>
            </div>
        <?php endif; ?>

        <!-- Floating Labels Form -->
        <form action="<?= base_url('/hasil-ami/save'); ?>" method="post" class="row g-3">
            <?= csrf_field(); ?>
            <div class="col-md-12">
                <div class="form-floating">
                    <select class="form-control <?= (session('errors.proses_ami_id')) ? 'is-invalid' : ''; ?>" id="proses_ami_id" name="proses_ami_id" placeholder="Siklus/Standar" value="<?= old('proses_ami_id'); ?>" aria-label="Default select example">
                        <option selected>--- Pilih Periode/Standar ---</option>
                        <?php foreach ($prosesAMI as $proses) : ?>
                            <option value="<?= $proses['id']; ?>"><?= $proses['tahun']; ?>-<?= $proses['periode']; ?>/<?= $proses['standar']; ?></option>
                        <?php endforeach; ?>
                    </select>
                    <label for="floatingName">Periode/Standar</label>
                    <?php if (session('errors') && array_key_exists('proses_ami_id', session('errors'))) : ?>
                        <div class="invalid-feedback">
                            <?= session('errors')['proses_ami_id']; ?>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
            <div class="col-md-12">
                <div class="form-floating">
                    <select class="form-control <?= (session('errors.butir_mutu_isi')) ? 'is-invalid' : ''; ?>" id="butir_mutu_isi" name="butir_mutu_isi" placeholder="Butiran Mutu" aria-label="Default select example">
                        <option selected>--- Pilih Butiran Mutu ---</option>
                        <?php foreach ($butiran_mutu as $butir) : ?>
                            <option value="="></option>
                        <?php endforeach; ?>
                    </select>
                    <label for="floatingName">Butiran Mutu</label>
                    <?php if (session('errors') && array_key_exists('butir_mutu_isi', session('errors'))) : ?>
                        <div class="invalid-feedback">
                            <?= session('errors')['butir_mutu_isi']; ?>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
            <div class="col-md-12">
                <div class="form-floating">
                    <input type="text" class="form-control <?= (session('errors.indikator_target')) ? 'is-invalid' : ''; ?>" id="indikator_target" name="indikator_target" placeholder="Indikator Target" value="<?= old('indikator_target'); ?>">
                    <label for="indikator_target">Indikator Target</label>
                    <?php if (session('errors') && array_key_exists('indikator_target', session('errors'))) : ?>
                        <div class="invalid-feedback">
                            <?= session('errors')['indikator_target']; ?>
                        </div>
                    <?php endif; ?>
                </div>
            </div>

            <div class="text-left">
                <button type="submit" class="btn btn-primary">Simpan</button>
                <a href="<?= base_url('/proses-ami/hasil-ami/' .  $prosesAMI[0]['id']); ?>" class="btn btn-secondary">Kembali</a>
            </div>
        </form><!-- End floating Labels Form -->
    </div>
</div>

<script>
    // Event listener untuk dropdown "proses_ami_id"
    document.getElementById('proses_ami_id').addEventListener('change', function() {
        var selectedProsesId = this.value;
        // Dapatkan standar_id yang sesuai dengan selectedProsesId
        var selectedStandarId = getStandarId(selectedProsesId);

        // Lakukan permintaan AJAX untuk mendapatkan butiran_mutu sesuai dengan standar yang dipilih
        fetch('/get-butiran-mutu/' + selectedStandarId)
            .then(function(response) {
                return response.json();
            })
            .then(function(data) {
                // Dapatkan dropdown "butir_mutu_isi"
                var butiranDropdown = document.getElementById('butir_mutu_isi');

                // Hapus semua opsi saat ini dari dropdown "butir_mutu_isi"
                butiranDropdown.innerHTML = '';
                // console.log(data);
                // Tambahkan opsi yang baru berdasarkan data yang diterima dari server
                data.forEach(function(butir) {
                    var option = document.createElement('option');
                    option.value = butir.butiran_mutu_isi;
                    option.textContent = butir.butiran_mutu_isi;
                    butiranDropdown.appendChild(option);
                });
            });
    });

    // Fungsi untuk mendapatkan standar_id sesuai dengan selectedProsesId
    function getStandarId(selectedProsesId) {
        // Dapatkan standar_id yang sesuai dengan selectedProsesId dari $prosesAMI
        var prosesAMI = <?php echo json_encode($prosesAMI); ?>;
        for (var i = 0; i < prosesAMI.length; i++) {
            if (prosesAMI[i].id == selectedProsesId) {
                return prosesAMI[i].standar_id;
            }
        }
        return null; // Kembalikan null jika tidak ditemukan
    }
</script>
<?= $this->endSection(); ?>