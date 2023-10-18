<?= $this->extend('layout/template'); ?>

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
                <input type="text" name="proses_ami_id" id="proses_ami_id" value="<?= $prosesAMI[0]['id']; ?>" hidden>
            </div>
            <div class="col-md-12">
                <div class="form-floating">
                    <select class="form-control <?= (session('errors.sub_standar_id')) ? 'is-invalid' : ''; ?>" id="sub_standar_id" name="sub_standar_id" placeholder="Sub Standar" value="<?= old('sub_standar_id'); ?>" aria-label="Default select example">
                        <option selected>--- Pilih Sub Standar ---</option>
                        <?php foreach ($prosesAMI as $proses) : ?>
                            <option value="<?= $proses['nama_sub_standar']; ?>" data-sub-standar-id="<?= $proses['sub_standar_id']; ?>"><?= $proses['nama_sub_standar']; ?></option>
                        <?php endforeach; ?>
                    </select>

                    <label for="floatingName">Sub Standar</label>
                    <?php if (session('errors') && array_key_exists('sub_standar_id', session('errors'))) : ?>
                        <div class="invalid-feedback">
                            <?= session('errors')['sub_standar_id']; ?>
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
    // Event listener untuk dropdown "sub_standar"
    document.getElementById('sub_standar_id').addEventListener('change', function() {
        var selectedSubStandarId = this.options[this.selectedIndex].getAttribute('data-sub-standar-id');

        // Lakukan permintaan AJAX untuk mendapatkan butiran_mutu sesuai dengan sub_standar_id yang dipilih
        fetch('/get-butiran-mutu/' + selectedSubStandarId) // Ganti URL sesuai dengan URL yang sesuai di controller
            .then(function(response) {
                return response.json();
            })
            .then(function(data) {
                // Dapatkan dropdown "butir_mutu_isi"
                var butiranDropdown = document.getElementById('butir_mutu_isi');

                // Hapus semua opsi saat ini dari dropdown "butir_mutu_isi"
                butiranDropdown.innerHTML = '';

                // Tambahkan opsi yang baru berdasarkan data yang diterima dari server
                data.forEach(function(butir) {
                    var option = document.createElement('option');
                    option.value = butir.butiran_mutu_isi;
                    option.textContent = butir.butiran_mutu_isi;

                    // Hapus elemen HTML yang tidak diinginkan dari teks yang akan ditampilkan
                    option.textContent = option.textContent.replace(/<[^>]*>/g, '');

                    butiranDropdown.appendChild(option);
                });
            });
    });


    // Fungsi untuk mendapatkan standar_id sesuai dengan selectedProsesId
    function getStandarId(selectedProsesId) {
        // Dapatkan standar_id yang sesuai dengan selectedProsesId dari $prosesAMI
        var prosesAMI = <?php echo json_encode($prosesAMI); ?>;

        console.log(prosesAMI);
        for (var i = 0; i < prosesAMI.length; i++) {
            if (prosesAMI[i].id == selectedProsesId) {
                return prosesAMI[i].standar_id;
            }
        }
        return null; // Kembalikan null jika tidak ditemukan
    }
</script>
<?= $this->endSection(); ?>