<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Madu Online | <?= $title; ?></title>

    <!-- Notyf -->
    <link type="text/css" href="/assets/vendor/notyf/notyf.min.css" rel="stylesheet">
    <!-- Volt CSS -->
    <link type="text/css" href="/assets/css/volt.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="/assets/vendor/fontawesome-free/css/all.min.css">

    <style>
        body {
            background-image: url("<?= base_url(); ?>/assets/assets/img/illustrations/signin.svg");
        }
    </style>
</head>

<body>
    <main>
        <!-- Section -->
        <section class="vh-lg-100 mt-5 mt-lg-0 bg-soft d-flex align-items-center" data-background-lg="<?= base_url(); ?>/assets/assets/img/illustrations/signin.svg">
            <div class="container">
                <div class="row justify-content-center form-bg-image">
                    <div class="col-12 d-flex align-items-center justify-content-center">
                        <div class="bg-white shadow border-0 rounded border-light p-4 p-lg-5 w-100 fmxw-500">
                            <div class="text-center text-md-center mb-4 mt-md-0">
                                <h1 class="mb-0 h3">Sign in ke Madu Online</h1>
                            </div>
                            <form action="/admin/login/post_login" class="mt-4" method="POST">
                                <?= csrf_field(); ?>
                                <!-- Form -->
                                <div class="form-group mb-4">
                                    <label for="username">Username</label>
                                    <div class="input-group">
                                        <span class="input-group-text" id="basic-addon1">
                                            <i class="fas fa-user" style="padding: 4px;"></i>
                                        </span>
                                        <input type="text" class="form-control" placeholder="Username" id="username" name="username" autofocus required>
                                    </div>
                                </div>
                                <!-- End of Form -->
                                <div class="form-group">
                                    <!-- Form -->
                                    <div class="form-group mb-4">
                                        <label for="password">Password</label>
                                        <div class="input-group">
                                            <span class="input-group-text" id="basic-addon1">
                                                <i class="fas fa-lock" style="padding: 4px;"></i>
                                            </span>
                                            <input type="password" placeholder="Password" class="form-control" id="password" name="password" required>
                                        </div>
                                    </div>
                                    <!-- End of Form -->
                                </div>
                                <div class="d-grid">
                                    <button type="submit" class="btn btn-gray-800" style="margin-top: 10px;">Sign in</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>
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

    <!-- Notyf -->
    <script src="/assets/vendor/notyf/notyf.min.js"></script>

    <!-- Volt JS -->
    <script src="/assets/assets/js/volt.js"></script>

    <?php if (session('error')) { ?>
        <script>
            const notyf = new Notyf({
                position: {
                    x: 'right',
                    y: 'top',
                },
                types: [{
                    type: 'info',
                    background: '#FA5252',
                    icon: {
                        className: 'fas fa-times-circle',
                        tagName: 'span',
                        color: '#fff'
                    },
                    dismissible: false
                }]
            });
            notyf.open({
                type: 'info',
                message: '<?= session('error'); ?>'
            });
        </script>
    <?php } ?>
</body>

</html>