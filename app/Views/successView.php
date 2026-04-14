<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>
<div class="container text-center py-5 mt-5">
    <i class="fas fa-check-circle text-success mb-3" style="font-size: 5rem;"></i>
    <h1 class="display-4 text-dark">Order Confirmed!</h1>
    <p class="lead text-muted">Thank you for your purchase. Your premium tea is being prepared for shipment.</p>
    <a href="<?= base_url('shop') ?>" class="btn btn-outline-success mt-4 px-4 py-2 rounded-pill">Continue Shopping</a>
</div>
<?= $this->endSection() ?>