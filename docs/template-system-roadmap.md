# Template system roadmap

This roadmap describes how the optional UI module can grow while keeping presentation concerns outside Flexi core. It is a design plan, not a claim that the listed behavior exists today.

## Current state

- `Template` reads one file and exposes content and metadata.
- `TemplateLocator` constructs a template from a path.
- `HtmlRender` replaces `{{key}}` placeholders with string values.
- The module now targets `flexi/contracts` `^5.2.1` and declares compatibility with Flexi Core `^3.2`.
- There is no built-in escaping, root containment, layout inheritance, includes, or cache invalidation policy.

## Roadmap

1. **Align package integration.** Use `flexi/contracts` and its `Flexi\Contracts` namespace, declare the current module manifest schema and core compatibility, and verify activation against Flexi core.
2. **Define safe file resolution.** Support one or more configured template roots, reject traversal and absolute-path escapes, and make missing-template errors predictable.
3. **Define output safety.** Decide whether the simple engine performs HTML escaping by default or requires explicit safe/raw values. Preserve context-aware escaping; HTML text, attributes, URLs, and JavaScript contexts are not interchangeable.
4. **Add focused behavior tests.** Cover path containment, missing files, empty values, arrays/objects, escaping, and placeholder edge cases.
5. **Add composition only when needed.** Consider layouts, partials, and inheritance after documenting a minimal syntax and deterministic resolution rules.
6. **Add caching behind a clear policy.** Cache parsed/compiled templates only if measurements justify it; define invalidation for development and deployment separately.
7. **Document framework integration.** Show module installation/activation, service injection, configuration, and error handling using the current core contracts.

## Decisions to make before expanding syntax

- Whether this module remains a deliberately small substitution engine or delegates to an established template engine.
- Whether escaping is automatic, explicit, or configurable, and how trusted markup is represented.
- Whether template paths are module-relative, application-root-relative, or selected from named roots.
- Whether layouts and partials belong in this module or should be supplied by another adapter.

Keep the core responsible for module discovery, activation, configuration composition, dependency injection, and runtime orchestration. Rendering syntax, template lookup policy, and presentation behavior belong to this optional module or a dedicated adapter.
