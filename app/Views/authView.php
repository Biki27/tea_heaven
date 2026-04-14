<?= $this->extend('layouts/main') ?>

<?= $this->section('page_styles') ?>
    <link rel="stylesheet" href="<?= base_url('assets/css/auth.css') ?>">
<?= $this->endSection() ?>

<?= $this->section('content') ?>

<div class="auth-wrapper">
    
    <?php if(session()->getFlashdata('error')): ?>
        <div class="alert alert-danger mb-4"><?= session()->getFlashdata('error') ?></div>
    <?php endif; ?>
    <?php if(session()->getFlashdata('success')): ?>
        <div class="alert alert-success mb-4"><?= session()->getFlashdata('success') ?></div>
    <?php endif; ?>

    <div class="auth-container" id="container">
        
        <div class="form-container sign-up-container">
            <form action="<?= base_url('auth/register') ?>" method="POST" class="auth-form">
                <?= csrf_field() ?>
                <h1>Create Account</h1>
                <div class="social-container">
                    <a href="#" class="social" title="Google"><i class="fab fa-google"></i></a>
                </div>
                <span>or use your email for registration</span>
                <input type="text" name="name" placeholder="Full Name" value="<?= old('name') ?>" required />
                <input type="email" name="email" placeholder="Email" value="<?= old('email') ?>" required />
                <input type="password" name="password" placeholder="Password (Min 6 chars)" required />
                <button type="submit" class="auth-btn mt-3">Sign Up</button>
            </form>
        </div>
        
        <div class="form-container sign-in-container">
            <form action="<?= base_url('auth/login') ?>" method="POST" class="auth-form">
                <?= csrf_field() ?>
                <h1>Sign In</h1>
                <div class="social-container">
                    <a href="#" class="social" title="Google"><i class="fab fa-google"></i></a>
                </div>
                <span>or use your account</span>
                <input type="email" name="email" placeholder="Email" required />
                <input type="password" name="password" placeholder="Password" required />
                <a href="#">Forgot your password?</a>
                <button type="submit" class="auth-btn">Sign In</button>
            </form>
        </div>
        
        <div class="overlay-container">
            <div class="overlay">
                <div class="overlay-panel overlay-left">
                    <h1>Welcome Back!</h1>
                    <p>To keep connected with us please login with your personal info</p>
                    <button class="auth-btn ghost" id="signIn">Sign In</button>
                </div>
                <div class="overlay-panel overlay-right">
                    <h1>Hello, Friend!</h1>
                    <p>Enter your personal details and start journey with us</p>
                    <button class="auth-btn ghost" id="signUp">Sign Up</button>
                </div>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection() ?>

<?= $this->section('page_scripts') ?>
<script>
    const signUpButton = document.getElementById('signUp');
    const signInButton = document.getElementById('signIn');
    const container = document.getElementById('container');

    signUpButton.addEventListener('click', () => {
        container.classList.add("right-panel-active");
    });

    signInButton.addEventListener('click', () => {
        container.classList.remove("right-panel-active");
    });
</script>
<?= $this->endSection() ?>