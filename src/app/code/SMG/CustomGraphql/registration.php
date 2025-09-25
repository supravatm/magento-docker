<?php

declare(strict_types=1);
/**
 * Package: SMG_CustomGraphql
 * Author: Supravat Mondal <supravat.com@gmail.com>
 * license: MIT
 * Copyright: 2025
 * Description: Component Registrar
 */

use Magento\Framework\Component\ComponentRegistrar;

ComponentRegistrar::register(
    ComponentRegistrar::MODULE,
    'SMG_CustomGraphql',
    __DIR__
);
