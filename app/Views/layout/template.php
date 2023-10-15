<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title><?= $title; ?></title>
    <meta content="" name="description">
    <meta content="" name="keywords">

    <!-- Favicons -->
    <link href="<?= base_url('assets/img/favicon.png'); ?>" rel="icon">
    <link href="<?= base_url('assets/img/apple-touch-icon.png'); ?>" rel="apple-touch-icon">

    <!-- Google Fonts -->
    <link href="https://fonts.gstatic.com" rel="preconnect">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href="<?= base_url('assets/vendor/bootstrap/css/bootstrap.min.css'); ?>" rel="stylesheet">
    <link href="<?= base_url('assets/vendor/bootstrap-icons/bootstrap-icons.css'); ?>" rel="stylesheet">
    <!-- <link href="<?= base_url('assets/vendor/boxicons/css/boxicons.min.css'); ?>" rel="stylesheet"> -->
    <!-- <link href="<?= base_url('assets/vendor/quill/quill.snow.css'); ?>" rel="stylesheet"> -->
    <!-- <link href="<?= base_url('assets/vendor/quill/quill.bubble.css'); ?>" rel="stylesheet"> -->
    <link href="<?= base_url('assets/vendor/remixicon/remixicon.css"'); ?> rel=" stylesheet">
    <link href="<?= base_url('assets/vendor/simple-datatables/style.css'); ?>" rel="stylesheet">

    <!-- Template Main CSS File -->
    <link href="<?= base_url('assets/css/style.css'); ?>" rel="stylesheet">

    <!-- =======================================================
  * Template Name: NiceAdmin
  * Updated: May 30 2023 with Bootstrap v5.3.0
  * Template URL: https://bootstrapmade.com/nice-admin-bootstrap-admin-html-template/
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
</head>

<body>

    <?php
    $current_url = $_SERVER['REQUEST_URI'];
    if ($current_url !== '/' && strpos($current_url, '/login') === false) :
    ?>
        <!-- ======= Header ======= -->
        <header id="header" class="header fixed-top d-flex align-items-center">

            <?= $this->include('layout/navbar'); ?>

        </header><!-- End Header -->

        <!-- ======= Sidebar ======= -->
        <aside id="sidebar" class="sidebar">
            <?= $this->include('layout/sidebar'); ?>
        </aside><!-- End Sidebar -->

        <main id="main" class="main">

            <div class="pagetitle">
                <h1><?= $title; ?></h1>
                <nav>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="/">Home</a></li>
                        <li class="breadcrumb-item active"><?= $title; ?></li>
                    </ol>
                </nav>
            </div><!-- End Page Title -->
        <?php endif; ?>

        <section class="section dashboard">
            <div class="row">

                <?= $this->renderSection('content'); ?>

            </div>
        </section>

        </main><!-- End #main -->

        <?php
        $current_url = $_SERVER['REQUEST_URI'];
        if ($current_url !== '/' && strpos($current_url, '/login') === false) :
        ?>
            <!-- ======= Footer ======= -->
            <footer id="footer" class="footer">
                <div class="copyright">
                    &copy; Copyright <strong><span>NiceAdmin</span></strong>. All Rights Reserved
                </div>
                <div class="credits">
                    <!-- All the links in the footer should remain intact. -->
                    <!-- You can delete the links only if you purchased the pro version. -->
                    <!-- Licensing information: https://bootstrapmade.com/license/ -->
                    <!-- Purchase the pro version with working PHP/AJAX contact form: https://bootstrapmade.com/nice-admin-bootstrap-admin-html-template/ -->
                    Designed by <a href="https://bootstrapmade.com/">BootstrapMade</a>
                </div>
            </footer><!-- End Footer -->
        <?php endif; ?>

        <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

        <!-- Vendor JS Files -->
        <script src="<?= base_url('assets/vendor/bootstrap/js/bootstrap.bundle.min.js'); ?>"></script>
        <!-- <script src="<?= base_url('assets/vendor/quill/quill.min.js'); ?>"></script> -->
        <script src="<?= base_url('assets/vendor/simple-datatables/simple-datatables.js'); ?>"></script>
        <!-- <script src="<?= base_url('assets/vendor/tinymce/tinymce.min.js'); ?>"></script> -->
        <script src="<?= base_url('assets/vendor/php-email-form/validate.js'); ?>"></script>

        <script src="<?= base_url('assets/vendor/ckeditor5/ckeditor.js'); ?>"></script>
        <script>
            ClassicEditor
                .create(document.querySelector('#butiran_mutu_isi'))
                .catch(error => {
                    console.error(error);
                });
            ClassicEditor
                .create(document.querySelector('#hasil_audit_dokumen'))
                .catch(error => {
                    console.error(error);
                });
            ClassicEditor
                .create(document.querySelector('#hasil_temuan_audit'))
                .catch(error => {
                    console.error(error);
                });
        </script>


        <script>
            // Function to update the image preview
            function updateImagePreview(event) {
                const input = event.target;
                if (input.files && input.files[0]) {
                    const reader = new FileReader();

                    reader.onload = function(e) {
                        const imagePreview = document.getElementById('image-preview');
                        imagePreview.src = e.target.result;
                    };

                    reader.readAsDataURL(input.files[0]);
                }
            }

            // Attach the function to the file input's change event
            const newImageInput = document.getElementById('new_image');
            newImageInput.addEventListener('change', updateImagePreview);
        </script>

        <script>
            // Function to update the image preview for new user
            function updateImagePreview(event) {
                const input = event.target;
                if (input.files && input.files[0]) {
                    const reader = new FileReader();

                    reader.onload = function(e) {
                        const imagePreview = document.getElementById('image-preview');
                        imagePreview.src = e.target.result;
                    };

                    reader.readAsDataURL(input.files[0]);
                }
            }

            // Attach the function to the file input's change event
            const imageInput = document.getElementById('image');
            imageInput.addEventListener('change', updateImagePreview);
        </script>

        <!-- Template Main JS File -->
        <script src="<?= base_url('assets/js/main.js'); ?>"></script>

</body>

</html>