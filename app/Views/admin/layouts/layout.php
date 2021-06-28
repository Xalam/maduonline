<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Madu Online | <?= $title; ?></title>

    <link href="https://fonts.googleapis.com/css?family=Poppins" rel=" stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="/assets/vendor/fontawesome-free/css/all.min.css">
    <!-- Sweet Alert -->
    <link type="text/css" href="/assets/vendor/sweetalert2/dist/sweetalert2.min.css" rel="stylesheet">
    <!-- Volt CSS -->
    <link type="text/css" href="/assets/css/volt.css" rel="stylesheet">

    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no, minimal-ui">

    <?= $this->renderSection('style'); ?>

    <style>
        * {
            font-family: 'Poppins', sans-serif;
        }
    </style>
</head>

<body>
    <main class="content">

        <?= $this->include('admin/layouts/navbar'); ?>

        <?= $this->include('admin/layouts/sidebar'); ?>

        <?= $this->renderSection('content'); ?>

    </main>
    <!-- Core -->
    <script src="/assets/vendor/@popperjs/core/dist/umd/popper.min.js"></script>
    <script src="/assets/vendor/bootstrap/dist/js/bootstrap.min.js"></script>

    <!-- Vendor JS -->
    <script src="/assets/vendor/onscreen/dist/on-screen.umd.min.js"></script>

    <!-- Slider -->
    <script src="/assets/vendor/nouislider/distribute/nouislider.min.js"></script>

    <!-- Smooth scroll -->
    <script src="/assets/vendor/smooth-scroll/dist/smooth-scroll.polyfills.min.js"></script>

    <!-- Sweet Alerts 2 -->
    <script src="/assets/vendor/sweetalert2/dist/sweetalert2.all.min.js"></script>

    <!-- Volt JS -->
    <script src="/assets/assets/js/volt.js"></script>

    <?= $this->renderSection('script') ?>
</body>

</html>