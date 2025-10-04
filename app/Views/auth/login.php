<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>

    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous">
</head>
<body class="bg-light">

    <div class="container d-flex align-items-center justify-content-center vh-100">
        <div class="card shadow-sm w-100" style="max-width: 400px;">
            <div class="card-body p-4">
                <h3 class="text-center mb-3">Login</h3>
                <p class="text-center text-muted small mb-4">Masukkan email dan password Anda</p>

                <!-- ✅ Tampilkan pesan error jika login gagal -->
                <?php if (session()->getFlashdata('error')): ?>
                    <div class="alert alert-danger small text-center">
                        <?= session()->getFlashdata('error'); ?>
                    </div>
                <?php endif; ?>

                <form action="/login" method="post">
                    <?= csrf_field() ?>

                    <div class="mb-3">
                        <label for="email" class="form-label fw-semibold">Email</label>
                        <input type="email" name="email" id="email" class="form-control" placeholder="Masukkan Email" required>
                    </div>

                    <div class="mb-3">
                        <label for="password" class="form-label fw-semibold">Password</label>
                        <input type="password" name="password" id="password" class="form-control" placeholder="Masukkan Password" required>
                    </div>

                    <div class="d-grid">
                        <button type="submit" class="btn btn-primary">Login</button>
                    </div>
                </form>

            </div>
        </div>
    </div>

</body>
</html>