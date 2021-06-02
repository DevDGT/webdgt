<?= $this->extend('admin/layouts/app'); ?>

<?= $this->section('content'); ?>

<div class="container">
    <div class="card">
        Lorem ipsum dolor sit amet consectetur adipisicing elit. Facere cumque pariatur, laudantium voluptas eius officia eos, aspernatur numquam provident autem aliquam animi maiores iusto vel fuga quas laboriosam! Animi, rerum!
    </div>
</div>

<?= $this->endSection(); ?>
<?= $this->section('js'); ?>
<script src="<?= base_url('assets/js/page/admin/dashboard.js') ?>" defer></script>
<?= $this->endSection(); ?>