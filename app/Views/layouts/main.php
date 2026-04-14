<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tea Haven - Premium Teas</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="<?= base_url('assets/css/variables.css') ?>">
    <link rel="stylesheet" href="<?= base_url('assets/css/global.css') ?>">

    <?= $this->renderSection('page_styles') ?>
</head>

<body class="d-flex flex-column min-vh-100">
    <!-- navbar -->
    <nav class="navbar navbar-expand-lg fixed-top tea-nav">
        <div class="container">
            <a class="navbar-brand" href="<?= base_url() ?>">
                <img src="<?= base_url('assets/images/logo.png') ?>" alt="logo" class="logo-img" />
                <span class="brand-name">Tea Haven</span>
            </a>
            <button
                class="navbar-toggler custom-toggler"
                type="button"
                data-bs-toggle="collapse"
                data-bs-target="#mainNav"
                aria-controls="mainNav"
                aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="mainNav">
                <ul class="navbar-nav nav-main">
                        <li class="nav-item"><a class="nav-link" href="<?= base_url('shop') ?>">Our Teas</a></li>
                     

                    <li class="nav-item">
                        <a class="nav-link" href="#about">About</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="#contact">Contact</a>
                    </li>
                </ul>

                <!-- Search Bar -->
                <div class="search-section">
                    <form class="search-form">
                        <div class="input-group search-wrap">
                            <input
                                type="search"
                                class="form-control search-input"
                                placeholder="Search premium teas..."
                                aria-label="Search" />
                            <button class="btn search-btn" type="submit">
                                <i class="fas fa-search"></i>
                            </button>
                        </div>
                    </form>
                </div>

                <!-- Icons FAR  -->
                <div class="nav-actions d-flex align-items-center">
                    <a href="<?= base_url('cart') ?>" class="cart-link me-3" title="Cart">
                        <i class="fas fa-shopping-bag"></i>
                        <?php if(session()->has('cart') && !empty(session()->get('cart'))): ?>
                            <span class="cart-count"><?= count(session()->get('cart')) ?></span>
                        <?php endif; ?>
                    </a>
                    
                    <?php if(session()->get('is_logged_in')): ?>
                        <div class="dropdown">
                            <a href="#" class="account-icon dropdown-toggle text-decoration-none" data-bs-toggle="dropdown" title="Account">
                                <i class="fas fa-user"></i>
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end mt-2">
                                <li><span class="dropdown-item-text fw-bold"><?= esc(session()->get('user_name')) ?></span></li>
                                <li><hr class="dropdown-divider"></li>
                                <li><a class="dropdown-item text-danger" href="<?= base_url('logout') ?>">Logout</a></li>
                            </ul>
                        </div>
                    <?php else: ?>
                        <a href="<?= base_url('login') ?>" class="account-icon" title="Login / Register">
                            <i class="fas fa-user"></i>
                        </a>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </nav>

    <main class="flex-grow-1">
        <?= $this->renderSection('content') ?>
    </main>

    <footer class="site-footer">
        <div class="container">
            <div class="row">
                <div class="col-12 col-md-6">
                    <h6>About</h6>
                    <p class="text-justify">
                        Teabird.com <i>Lets have tea</i> Lorem ipsum dolor sit amet
                        consectetur adipisicing elit. Animi impedit beatae sint
                        necessitatibus dolores dolore voluptates ex odio earum alias
                        voluptatibus molestias tempora dolorem, eos doloremque amet optio
                        deserunt! Laboriosam.
                    </p>
                </div>
                <div class="col-6 col-md-3">
                    <h6>Categories</h6>
                    <ul class="footer-links">
                        <li><a href="#">Tea</a></li>
                        <li><a href="#">Green Tea</a></li>
                        <li><a href="#">Helthy</a></li>
                        <li><a href="#">Jafrani Tea</a></li>
                        <li><a href="#">tea leaf</a></li>
                        <li><a href="#">Templates</a></li>
                    </ul>
                </div>
                <div class="col-6 col-md-3">
                    <h6>Quick Links</h6>
                    <ul class="footer-links">
                        <li><a href="#">About Us</a></li>
                        <li><a href="#">Contact Us</a></li>
                        <li><a href="#">Contribute</a></li>
                        <li><a href="#">Privacy Policy</a></li>
                        <li><a href="#">Sitemap</a></li>
                    </ul>
                </div>
            </div>
            <hr />
        </div>
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-12">
                    <p class="copyright-text">
                        Copyright &copy; 2026 All Rights Reserved by
                        <a href="#">Suropriyo</a>.
                    </p>
                </div>
                <div class="col-lg-4 col-12">
                    <ul class="social-icons">
                        <li>
                            <a class="facebook" href="#" title="Facebook"><i class="fab fa-facebook-f"></i></a>
                        </li>
                        <li>
                            <a class="twitter" href="#" title="Twitter"><i class="fab fa-twitter"></i></a>
                        </li>
                        <li>
                            <a class="dribbble" href="#" title="Dribbble"><i class="fab fa-dribbble"></i></a>
                        </li>
                        <li>
                            <a class="linkedin" href="#" title="LinkedIn"><i class="fab fa-linkedin-in"></i></a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <?= $this->renderSection('page_scripts') ?>
</body>

</html>