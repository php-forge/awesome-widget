<p align="center">
    <a href="https://github.com/php-forge/widget" target="_blank">
        <img src="https://avatars.githubusercontent.com/u/103309199?s=400&u=ca3561c692f53ed7eb290d3bb226a2828741606f&v=4" height="100px">
    </a>
    <h1 align="center">PHP Forge - Widget</h1>
    <br>
</p>


[![Total Downloads](https://poser.pugx.org/php-forge/widget/downloads.png)](https://packagist.org/packages/php-forge/widget)
[![Build Status](https://github.com/php-forge/widget/workflows/build/badge.svg)](https://github.com/php-forge/widget/actions?query=workflow%3Abuild)
[![codecov](https://codecov.io/gh/php-forge/widget/branch/master/graph/badge.svg?token=gaUysTvoUu)](https://codecov.io/gh/php-forge/widget)
[![Mutation testing badge](https://img.shields.io/endpoint?style=flat&url=https%3A%2F%2Fbadge-api.stryker-mutator.io%2Fgithub.com%2Fyii-extension%2Fsimple-widget%2Fmaster)](https://dashboard.stryker-mutator.io/reports/github.com/php-forge/widget/master)
[![static analysis](https://github.com/php-forge/widget/workflows/static%20analysis/badge.svg)](https://github.com/php-forge/widget/actions?query=workflow%3A%22static+analysis%22)
[![type-coverage](https://shepherd.dev/github/php-forge/widget/coverage.svg)](https://shepherd.dev/github/php-forge/widget)


## Instalación

```shell
composer require php-forge/widget
```

## Uso

### Crear un nuevo widget sin dependencias:

```php
<?php

declare(strict_types=1);

namespace App\Widget;

use Forge\Widget\AbstractWidget;
use Forge\Widget\Html\Attributes;

final class Widget extends AbstractWidget
{
    protected function run(): string
    {
        return '<' . trim((new Attributes())->render($this->attributes)) . '>';
    }

    public function id(string $value): self
    {
        $new = clone $this;
        $new->attributes['id'] = $value;
        return $new;
    }

    protected function beforeRun(): bool
    {
        if (isset($this->attributes['id']) && $this->attributes['id'] === 'beforerun') {
            return false;
        }

        return parent::beforeRun();
    }

    protected function afterRun(string $result): string
    {
        $result = parent::afterRun($result);

        if (isset($this->attributes['id']) && $this->attributes['id'] === 'afterrun') {
            $result = '<div>' . $result . '</div>';
        }

        return $result;
    }
}
```

Uso en vista:

```php
<?php

declare(strict_types=1);

Widget::create()->id('id-test')->attributes(['class' => 'text-danger'])->render();
```

Código generado:

```html
<id="id-test" class="text-danger">
```

### Usar widget en vista con configuración

Uso en vista:

```php
<?php

declare(strict_types=1);

Widget::create(
    config: ['attributes()' => [['class' => 'test-class']], 'id()' => ['id-tests']],
)->render();
```

Código generado:

```html
<id="id-tests" class="test-class">
```

### Usar widget en vista con archivo de configuración

Cargar archivo de configuración desde: `/config/ConfigWidget.php`:

```php
return [
    // Sintax for array shortNameWidget => [method() => [$value]
    'Widget' => [
        'attributes()' => ['class' => 'test-class'],
        'id()' => 'id-tests',
    ],
];
```

Uso en vista:

```php
<?php

declare(strict_types=1);

Widget::create(
    loadConfigFile: __DIR__ . '/config/ConfigWidget.php',
)->render();
```

Código generado:
```html
<id="id-tests" class="test-class">
```

### Crear un nuevo widget con inyección de depedencia

```php
<?php

declare(strict_types=1);

namespace App\Widget;

use Forge\Widget\AbstractWidget;
use Forge\Widget\Html\Attributes;

final class Widget extends AbstractWidget
{
    public function __construct(private Attributes $attributes)
    {
    }

    protected function run(): string
    {
        return '<' . trim($this->attributes->render($this->attributes)) . '>';
    }

    public function id(string $value): self
    {
        $new = clone $this;
        $new->attributes['id'] = $value;
        return $new;
    }
}
```

Uso en vista:

```php
<?php

declare(strict_types=1);

use App\Widget;
use Forge\Widget\Html\Attributes;

Widget::create(
    config: ['attributes()' => [['class' => 'test-class']]],
    constructorArguments: [new Attributes()],
)->id('w0')->render();
```

Código generado:
```html
<id="w0" class="test-class">
```

### Uso de archivo de configuración de witget con: `CONSTANT`

Defined `CONSTANT`: `WIDGET_CONFIG_FILE`:

```php
define('WIDGET_CONFIG_FILE', __DIR__ . '/config/ConfigWidget.php');
```

Crear archivo `/config/ConfigWidget.php`:

```php
<?php

declare(strict_types=1);

return [
    // Sintax for array shortNameWidget => [method() => [$value]
    'Widget' => [
        'attributes()' => [['class' => 'test-class']],
        'id()' => ['id-tests'],
    ],
];
```

## Análisis estático

El código se analiza estáticamente con [Psalm](https://psalm.dev/docs). Para ejecutarlo:

```shell
./vendor/bin/psalm
```

## Pruebas de mutación

Las pruebas de mutación se comprueban con [Infection](https://infection.github.io/). Para ejecutarlo:

```shell
./vendor/bin/roave-infection-static-analysis-plugin
```

## Pruebas unitarias

Las pruebas unitarias se comprueban con [PHPUnit](https://phpunit.de/). Para ejecutarlo:

```shell
./vendor/bin/phpunit
```

## Licencia

El paquete `php-forge/widget` es software libre. Se publica bajo los términos de la Licencia BSD.
Consulte [`LICENSE`](./LICENSE.md) para obtener más información.

Mantenido por [Terabytesoftw](https://github.com/terabytesoftw).

## Nuestras redes sociales

[![Twitter](https://img.shields.io/badge/twitter-follow-1DA1F2?logo=twitter&logoColor=1DA1F2&labelColor=555555?style=flat)](https://twitter.com/PhpForge)
