    <?= $this->extend('Layout/template'); ?>

    <?= $this->section('content'); ?>

    <section class="section">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Data Proses AMI</h5>

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


                        <a href="<?= base_url('proses-ami/create'); ?>" class="btn btn-primary mb-3 mt-2">+ Add New</a>

                        <!-- Table with stripped rows -->
                        <table class="table datatable">
                            <thead>
                                <tr>
                                    <th scope="col">No</th>
                                    <th scope="col">Proses AMI / Standar</th>
                                    <th scope="col">Auditor</th>
                                    <th scope="col">Tanggal Mulai - Selesai</th>
                                    <th scope="col" style="text-align: center;">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $i = 1; ?>
                                <?php foreach ($prosesAMI as $proses) : ?>
                                    <th scope="row"><?= $i++; ?></th>
                                    <td><span class="green-box"><?= $proses['tahun']; ?></span> - <?= $proses['periode']; ?> / <?= $proses['nama']; ?></td>
                                    <td><?= $proses['nama_auditor']; ?></td>
                                    <td><?= $proses['tgl_mulai']; ?> - <?= $proses['tgl_selesai']; ?></td>
                                    <td>
                                        <a href="<?= base_url('proses-ami/toggle-status/' . $proses['id']); ?>" class="btn btn-<?= $proses['status'] === '1' ? 'success' : 'danger'; ?> btn-sm"><i class="bi bi-<?= $proses['status'] === '1' ? 'unlock' : 'lock'; ?>" title="<?= $proses['status'] === '1' ? 'Aktif' : 'Tidak Aktif'; ?>"></i></a>
                                        <a href="<?= base_url('proses-ami/hasil-ami/' . $proses['id']); ?>" class="btn btn-primary btn-sm"><i class="bi bi-eye" title="Detail Proses"></i></a>
                                        <a href="<?= base_url('proses-ami/edit/' . $proses['id']); ?>" class="btn btn-primary btn-sm"><i class="bi bi-pencil-square" title="Ubah"></i></a>
                                        <a href="<?= base_url('proses-ami/export-spreadsheet/' . $proses['id']); ?>" class="btn btn-secondary btn-sm"><i class="bi bi-file-earmark-spreadsheet" title="Cetak Spreadsheet"></i></a>
                                        <a href="<?= base_url('proses-ami/delete/' . $proses['id']); ?>" class="btn btn-danger btn-sm" onclick="return confirm('Apakah Anda yakin ingin menghapus Proses AMI ini?')"> <i class="bi bi-trash" title="Hapus"></i></a>
                                    </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                        <!-- End Table with stripped rows -->
                    </div>
                </div>
            </div>
        </div>
    </section>

    <script>
        $(document).ready(function() {
            $('.toggle-status-button').click(function(e) {
                e.preventDefault();
                var id = $(this).data('id');
                toggleStatus(id);
            });

            function toggleStatus(id) {
                $.ajax({
                    url: '<?= base_url('proses-ami/toggle-status/'); ?>' + id,
                    type: 'POST',
                    success: function(response) {
                        // Assuming your server returns a JSON response
                        var data = JSON.parse(response);
                        if (data.success) {
                            // Update the button icon or do any other necessary UI changes
                            var button = $('.toggle-status-button[data-id="' + id + '"]');
                            var icon = button.find('.bi');
                            if (data.status === '1') {
                                icon.removeClass('btn btn-danger btn-sm').addClass('btn btn-success btn-sm');
                            } else {
                                icon.removeClass('btn btn-success btn-sm').addClass('btn btn-danger btn-sm');
                            }
                        } else {
                            // Handle the case where the status toggle was not successful
                            alert('Failed to toggle status.');
                        }
                    },
                    error: function() {
                        alert('Failed to toggle status. Please try again.');
                    }
                });
            }
        });
    </script>


    <?= $this->endSection(); ?>