<?php

declare(strict_types=1);

namespace CubaDevOps\Flexi\Modules\Ui\Infrastructure\Ui;

use Flexi\Contracts\Interfaces\TemplateInterface;
use Flexi\Contracts\Interfaces\TemplateLocatorInterface;

class TemplateLocator implements TemplateLocatorInterface
{
    public function locate(string $templatePath): TemplateInterface
    {
        return new Template($templatePath);
    }
}
