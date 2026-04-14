<?= $this->extend('layouts/main') ?>

<?= $this->section('page_styles') ?>
    <link rel="stylesheet" href="<?= base_url('assets/css/cart.css') ?>">
<?= $this->endSection() ?>

<?= $this->section('content') ?>

<div class="cart-container">
    <div class="cart-header">
        <h1><i class="fas fa-shopping-cart me-3"></i>Your Tea Cart</h1>
    </div>

    <div class="row">
        <div class="col-lg-8">
            <?php if(empty($cart)): ?>
                <div class="alert alert-info text-center py-5">
                    <h4>Your cart is empty!</h4>
                    <p>Looks like you haven't added any premium teas yet.</p>
                    <a href="<?= base_url('shop') ?>" class="btn btn-success mt-3">Continue Shopping</a>
                </div>
            <?php else: ?>
                <?php foreach($cart as $item): ?>
                    <div class="cart-item">
                        <img src="<?= base_url('assets/images/' . esc($item['image_path'])) ?>" alt="<?= esc($item['name']) ?>" class="cart-image">
                        <div class="cart-details">
                            <h4 class="cart-name"><?= esc($item['name']) ?></h4>
                            <div class="cart-price">₹<?= number_format($item['price'], 2) ?></div>
                        </div>
                        <div class="quantity-section ms-auto d-flex align-items-center">
                            <div class="quantity-control">
                                <input type="number" class="qty-input" value="<?= esc($item['qty']) ?>" readonly>
                            </div>
                            <a href="<?= base_url('cart/remove/' . $item['id']) ?>" class="remove-btn ms-3 text-decoration-none">
                                <i class="fas fa-times"></i>
                            </a>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>

        <div class="col-lg-4">
            <div class="cart-summary">
                <h4 class="mb-4">Order Summary</h4>
                <ul class="summary-list">
                    <li>Subtotal <span>₹<?= number_format($subtotal, 2) ?></span></li>
                    <li>Tax (5%) <span>₹<?= number_format($tax, 2) ?></span></li>
                    <li class="summary-total">Total <span>₹<?= number_format($total, 2) ?></span></li>
                </ul>
                <a href="<?= base_url('checkout') ?>" class="checkout-btn <?= empty($cart) ? 'disabled' : '' ?>">
                    <i class="fas fa-credit-card me-2"></i> Proceed to Checkout
                </a>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection() ?>