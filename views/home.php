<?php $this->extends('layout.php', ['title' => 'Home']) ?>

<?php $this->start('content') ?>
<div class="text-center">
        <h1>Welcome to the Home Page</h1>
        <p class="lead">This is a simple PHP router example using Nano Template.</p>
        </div>
<?php $this->end('content') ?>

<?php $this->start('scripts') ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
<?php $this->end('scripts') ?>