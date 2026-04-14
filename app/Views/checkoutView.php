<?= $this->extend('layouts/main') ?>

<?= $this->section('page_styles') ?>
    <link rel="stylesheet" href="<?= base_url('assets/css/checkout.css') ?>">
<?= $this->endSection() ?>

<?= $this->section('content') ?>

<div class="container">
    <form action="<?= base_url('checkout/process') ?>" method="POST" class="checkout-grid">
        <?= csrf_field() ?>
        
        <div class="forms-section">
            <?php if(session()->getFlashdata('error')): ?>
                <div class="alert alert-danger"><?= session()->getFlashdata('error') ?></div>
            <?php endif; ?>

            <div class="form-divider">
                <h2>Contact Information</h2>
                <div class="form-group">
                    <div class="grid-2">
                        <div>
                            <label>First Name</label>
                            <input type="text" name="first_name" required>
                        </div>
                        <div>
                            <label>Last Name</label>
                            <input type="text" name="last_name" required>
                        </div>
                    </div>
                    <div>
                        <label>Email</label>
                        <input type="email" name="email" required>
                    </div>
                </div>
            </div>

            <div class="form-divider">
                <h2>Shipping Address</h2>
                <div class="form-group">
                    <div>
                        <label>Address</label>
                        <input type="text" name="address" required>
                    </div>
                    <div class="grid-2">
                        <div>
                            <label>City</label>
                            <input type="text" name="city" required>
                        </div>
                        <div>
                            <label>PIN Code</label>
                            <input type="text" name="pin_code" required>
                        </div>
                    </div>
                    <div class="grid-2">
                        <div>
                            <label>Country</label>
                            <select name="country" required>
                                <option value="India">India</option>
                                <option value="USA">United States</option>
                                <option value="UK">United Kingdom</option>
                            </select>
                        </div>
                        <div>
                            <label>Phone</label>
                            <input type="tel" name="phone" required>
                        </div>
                    </div>
                </div>
            </div>

            <div>
                <h2>Payment Method</h2>
                <div class="payment-options">
                    <label class="checkbox-group">
                        <input type="radio" name="payment" value="Credit Card" required>
                        <span>Credit/Debit Card</span>
                    </label>
                    <label class="checkbox-group">
                        <input type="radio" name="payment" value="UPI" required>
                        <span>UPI / Net Banking</span>
                    </label>
                    <label class="checkbox-group">
                        <input type="radio" name="payment" value="COD" required checked>
                        <span>Cash on Delivery (COD)</span>
                    </label>
                </div>
            </div>
        </div>

        <div class="order-summary">
            <div class="summary-card">
                <h2>Order Summary</h2>
                <div class="order-items">
                    <?php foreach($cart as $item): ?>
                        <div class="order-row">
                            <span><?= esc($item['name']) ?> (x<?= esc($item['qty']) ?>)</span>
                            <span>₹<?= number_format($item['price'] * $item['qty'], 2) ?></span>
                        </div>
                    <?php endforeach; ?>
                    <hr>
                    <div class="order-row">
                        <span>Subtotal</span>
                        <span>₹<?= number_format($subtotal, 2) ?></span>
                    </div>
                    <div class="order-row">
                        <span>Tax (5%)</span>
                        <span>₹<?= number_format($tax, 2) ?></span>
                    </div>
                    <hr>
                    <div class="order-row">
                        <span>Total</span>
                        <span>₹<?= number_format($total, 2) ?></span>
                    </div>
                </div>
                <button type="submit" class="pay-btn">Confirm Order (₹<?= number_format($total, 2) ?>)</button>
            </div>
        </div>
    </form>
</div>

<?= $this->endSection() ?>