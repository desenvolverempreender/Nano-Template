# Nano\Template

**Nano\Template** is a lightweight template engine written in PHP. It is a standalone version of Namo's templating engine for use outside of Nano.

## Usage

Nano\Template engine initialization:

```php
$template = new Nano\Template\Engine(__DIR__.'/../path/to/views');
```

Site-wide configuration parameters can be assigned before rendering so they are
available in all templates:

```php
$template->assign([
    'url' => 'https://www.mysite.com',
    // ...
]);
```

Page can be rendered in the controller:

```php
echo $template->render('about.php', [
    'mainHeading' => 'A short introduction',
]);
```

The `views/about.php`:

```php
<?php $this->extends('layout.php', ['title' => 'About us']) ?>

<?php $this->start('content') ?>
<div class="text-center">
    <h1>About Us</h1>
    <p class="lead">Learn more about our website!</p>
</div>
<?php $this->end('content') ?>

<?php $this->start('scripts') ?>
    <script src="js/bootstrap.bundle.min.js"></script>
<?php $this->end('scripts') ?>
```

The `views/layout.php`:

```html
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?? 'Website' ?></title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <?= $this->block('content') ?>
    </div>

    <?= $this->block('scripts') ?>
</body>
</html>

```

### Including templates

To include a partial template snippet file:

```php
<?php $this->include('contact.php') ?>
```

which is equivalent to `<?php include __DIR__.'/../contact.php' ?>`,
except that the variable scope is not inherited by the template that included
the file. To import variables into the included template snippet file:

```php
<?php $this->include('contact.php', ['formHeading' => 'value', 'foo' => 'bar']) ?>
```

### Blocks

Blocks are main building elements that contain template snippets and can be
included into the parent file(s).

Block is started with the `$this->start('block_name')` call and ends with
`$this->end('block_name')`:

```php
<?php $this->start('block_name') ?>
    <h1>Hello World!</h1>

    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
<?php $this->end('block_name') ?>
```

### Appending blocks

Block content can be appended to existing blocks by the
`$this->append('block_name')`.

The `views/layout.php`:

```html
<html>
<head></head>
<body>
    <?= $this->block('content'); ?>

    <?= $this->block('scripts'); ?>
</body>
</html>
```

The `views/pages/index.php`:

```php
<?php $this->extends('layout.php'); ?>

<?php $this->start('scripts'); ?>
    <script src="/js/foo.js"></script>
<?php $this->end('scripts'); ?>

<?php $this->start('content') ?>
    <?php $this->include('form.php') ?>
<?php $this->end('content') ?>
```

The `views/form.php`:

```php
<form>
    <input type="text" name="title">
    <input type="submit" value="Submit">
</form>

<?php $this->append('scripts'); ?>
    <script src="/js/script.js"></script>
<?php $this->end('scripts'); ?>
```

The final rendered page:

```html
<html>
<head></head>
<body>
    <form>
        <input type="text" name="title">
        <input type="submit" value="Submit">
    </form>

    <script src="/js/foo.js"></script>
    <script src="/js/bar.js"></script>
</body>
</html>
```

### Helpers

Registering additional template helpers can be useful when a custom function or
class method needs to be called in the template.

#### Registering function

```php
$template->register('timeStamp', function (int $timestamp): string {
    return gmdate('Y-m-d H:i e', $timestamp - date('Z', $timestamp));
});
```

#### Registering object method

```php
$router = new Nano\Router('/my_router_base');

$template = new Nano\Template\Engine(__DIR__.'/views');
$template->register('url', [$router, 'url']);
```

Using helpers in templates:

```php
<p>Time: <?= $this->timeStamp(time()) ?></p>
<a class="nav-link" href="<?= $this->url('/about') ?>">About</a>
```

### Escaping

When protecting against XSS, the built-in "e()" methods are provided.

To escape a given string and still preserve certain characters as HTML:

```php
<?= $this->e("Lorem ipsum dolor sit amet") ?>
<?= $this->e($string) ?>
```

## License and contributing

Contributions are most welcome by forking the Git repository over GitHub and
sending a pull request.
