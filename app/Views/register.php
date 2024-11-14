<body>
    <div id="auth">
        <div class="container">
            <div class="row">
                <div class="col-md-5 col-sm-12 mx-auto">
                    <div class="card pt-4 shadow-lg rounded" style="border-radius: 15px;">
                        <div class="card-body">
                            <div class="text-center mb-5">
                                <div style="text-align: center;">
                                    <img src="<?php echo base_url('images/'.$setting->logo_web) ?>" style="width: 120px; height: auto;">
                                </div>
                                <h5 style="font-weight: bold; color: #6c757d;">Sign Up</h5>
                            </div>
                            <form class="row g-3 needs-validation" novalidate action="<?= base_url('home/aksi_register')?>" method="POST">
                                <div class="form-group position-relative has-icon-left">
                                    <label for="nama_lengkap" style="font-weight: 500; color: #6c757d;">Nama Lengkap</label>
                                    <div class="position-relative">
                                        <input type="text" class="form-control" id="nama_lengkap" name="nama_lengkap" required style="border-radius: 10px;">
                                        <div class="form-control-icon">
                                            <i data-feather="user"></i>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group position-relative has-icon-left">
                                    <label for="username" style="font-weight: 500; color: #6c757d;">Username</label>
                                    <div class="position-relative">
                                        <input type="text" class="form-control" id="username" name="username" required style="border-radius: 10px;">
                                        <div class="form-control-icon">
                                            <i data-feather="user"></i>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group position-relative has-icon-left">
                                    <label for="telp" style="font-weight: 500; color: #6c757d;">No. Telepon</label>
                                    <div class="position-relative">
                                        <input type="tel" class="form-control" id="telp" name="telp" required style="border-radius: 10px;">
                                        <div class="form-control-icon">
                                            <i data-feather="phone"></i>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group position-relative has-icon-left">
                                    <label for="password" style="font-weight: 500; color: #6c757d;">Password</label>
                                    <div class="position-relative">
                                        <input type="password" class="form-control" id="password" name="password" required style="border-radius: 10px;">
                                        <span class="toggle-password position-absolute" style="right: 10px; top: 50%; transform: translateY(-50%); cursor: pointer;" onclick="togglePassword()">
                                            <i data-feather="eye"></i>
                                        </span>
                                        <div class="form-control-icon">
                                            <i data-feather="lock"></i>
                                        </div>
                                    </div>
                                </div>

                                <div class="text-center mt-3">
                                    <p style="font-weight: 500; color: #6c757d;">
                                        Sudah memiliki akun? <a href="<?= base_url('home/login') ?>" style="color: #007bff; text-decoration: none;">Login di sini</a>.
                                    </p>
                                </div>

                                <br/>
                                <div class="clearfix">
                                    <button class="btn btn-primary float-end" style="border-radius: 25px; background: linear-gradient(45deg, #888888, #aaaaaa); border: none; transition: all 0.3s ease;">
                                        Register
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="<?= base_url('js/feather-icons/feather.min.js')?>"></script>
    <script src="<?= base_url('js/app.js')?>"></script>
    <script src="<?= base_url('js/main.js')?>"></script>

    <script>
    function togglePassword() {
        var passwordField = document.getElementById('password');
        var passwordIcon = document.querySelector('.toggle-password i');

        if (passwordField.type === 'password') {
            passwordField.type = 'text';
            passwordIcon.setAttribute('data-feather', 'eye-off');
        } else {
            passwordField.type = 'password';
            passwordIcon.setAttribute('data-feather', 'eye');
        }
        feather.replace(); // Update feather icons
    }
    </script>

    <style>
    .toggle-password {
        cursor: pointer;
        color: #6c757d;
    }

    .btn-primary:hover {
        background: linear-gradient(45deg, #aaaaaa, #888888);
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
        transform: scale(1.05);
    }

    .card {
        border-radius: 15px;
        background-color: #f8f9fa;
    }

    .form-control {
        box-shadow: none !important;
        border: 1px solid #ced4da !important;
    }
    
    .form-control:focus {
        border-color: #888888 !important;
        box-shadow: 0 0 5px rgba(136, 136, 136, 0.5) !important;
    }

    .form-control-icon {
        position: absolute;
        right: 15px;
        top: 50%;
        transform: translateY(-50%);
        pointer-events: none;
    }

    h5 {
        color: #6c757d;
    }
    </style>
</body>
