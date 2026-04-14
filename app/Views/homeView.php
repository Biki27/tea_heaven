<?= $this->extend('layouts/main') ?>
<?= $this->section('page_styles') ?>
    <link rel="stylesheet" href="<?= base_url('assets/css/home.css') ?>">
<?= $this->endSection() ?>
<?= $this->section('content') ?>
<!-- HERO -->
    <section class="slide-banner">
        </section>

    <section class="best-seller-section">
        <div class="container">
            <h2 class="section-title">Best Sellers</h2>

            <div class="best-seller-grid">
                <?php if (!empty($best_sellers)): ?>
                    <?php foreach ($best_sellers as $tea): ?>
                        <div class="bs-card">
                            <div class="bs-image">
                                <img src="<?= base_url('assets/images/' . esc($tea['image_path'])) ?>" alt="<?= esc($tea['name']) ?>">
                                <div class="bs-hover">
                                    <button class="add-cart">Add to Cart</button>
                                </div>
                            </div>
                            <h5><?= esc($tea['name']) ?></h5>
                            <div class="bs-price">
                                <span class="new">$<?= number_format($tea['price'], 2) ?></span>
                                <?php if($tea['old_price']): ?>
                                    <span class="old">$<?= number_format($tea['old_price'], 2) ?></span>
                                <?php endif; ?>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php else: ?>
                    <p>No best sellers found.</p>
                <?php endif; ?>
            </div>
        </div>
    </section>

    <?= $this->endSection() ?>