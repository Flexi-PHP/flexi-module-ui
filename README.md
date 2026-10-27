# UI Module

This optional Flexi module provides basic template-file loading and placeholder rendering. It keeps presentation behavior out of the framework core.

## Components

- `Template` loads a template file and exposes its content and metadata through the currently referenced `CubaDevOps\Flexi\Contracts\Interfaces\TemplateInterface`.
- `TemplateLocator` creates template objects from paths through the currently referenced `CubaDevOps\Flexi\Contracts\Interfaces\TemplateLocatorInterface`.
- `HtmlRender` implements the currently referenced `CubaDevOps\Flexi\Contracts\Interfaces\TemplateEngineInterface`, accepts a path or template object, and replaces `{{key}}` placeholders.

Service definitions are in `Config/services.json`. Applications should inject the template engine contract into their handlers rather than constructing module classes directly.

```php
use CubaDevOps\Flexi\Contracts\Interfaces\TemplateEngineInterface;

final class RenderPage
{
    private TemplateEngineInterface $engine;

    public function __construct(TemplateEngineInterface $engine)
    {
        $this->engine = $engine;
    }

    public function render(string $templatePath): string
    {
        return $this->engine->render($templatePath, ['title' => 'Welcome']);
    }
}
```

The current renderer performs literal substitution. It does not provide a template language, escaping, layouts, includes, or sandboxing. Read [template rendering flow](docs/template-rendering-flow.md) for current behavior and security limits. Planned improvements, including migration to the current `flexi/contracts` package and core module manifest, are in the [template system roadmap](docs/template-system-roadmap.md).

## Tests

Tests are under `tests/Infrastructure/Ui/`. Run them with PHPUnit from the module root.

## Architecture

- This module handles rendering, not business logic.
- Dependencies are injected through constructors.
- The package metadata still references the legacy `cubadevops/flexi-contracts` dependency; migrate it to `flexi/contracts` before activating this module with current Flexi core.
- The core does not contain or require this module.
