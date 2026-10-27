# Template rendering flow

The UI module provides optional template rendering. Install and activate the module only when an application needs this capability; the Flexi core does not register a template engine.

## Components

- `Template` reads a template file and exposes its content and metadata through the currently referenced `CubaDevOps\Flexi\Contracts\Interfaces\TemplateInterface`.
- `TemplateLocator` creates template objects from paths through the currently referenced `CubaDevOps\Flexi\Contracts\Interfaces\TemplateLocatorInterface`.
- `HtmlRender` implements the currently referenced `CubaDevOps\Flexi\Contracts\Interfaces\TemplateEngineInterface` and replaces `{{key}}` placeholders with supplied values. It accepts a path or a template object.

The service definitions are in `Config/services.json`. The package currently references the legacy contract namespace; migrate it to `flexi/contracts` before using it with current Flexi core. Applications normally inject the template engine contract into their own handlers rather than constructing this module's classes directly.

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

## Rendering and trust

The current renderer performs literal placeholder substitution. It does not provide a template language, escaping, layouts, includes, or sandboxing. Treat template files and interpolated values as trusted input, and apply context-appropriate HTML escaping before rendering untrusted values. Do not use this renderer as a substitute for an auto-escaping template engine when rendering user-controlled data.

## Current implementation limits

The locator currently accepts paths without a configured template-root boundary. Applications must ensure paths are selected from trusted sources. The roadmap for safe path resolution, output escaping policy, and integration work is tracked in [template system roadmap](template-system-roadmap.md).
