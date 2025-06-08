# SaaSus SDK PHP Development Rules

1. OSS Quality Principles:
   - Follow KISS principle (Keep It Simple, Stupid) - avoid complex abstractions
   - Apply YAGNI principle (You Aren't Gonna Need It) - remove unused code, classes, methods
   - Minimize external dependencies - prefer Laravel standard features
   - Maintain backward compatibility - avoid breaking API changes (e.g., keep `$request->merge()`)

2. PHP Compatibility:
   - Support PHP 8.1+ with PHP 8.4 new features (Property hooks, Asymmetric visibility)
   - Use strict type declarations and proper exception handling
   - Write PHPDoc comments for public APIs

3. Laravel Integration:
   - Support Laravel 9.x+ (composer.json: ">=9 <13")
   - Use `Illuminate\Routing\Controller` as base class, avoid `App\Http\Controllers\Controller`
   - Use `$request->merge()` for request data modification, avoid `$request->attributes->set()`
   - Follow Laravel standard middleware patterns

4. Code Quality:
   - Remove unused import statements and dead code
   - Use meaningful variable and method names
   - Keep methods under 20 lines, minimize nesting depth
   - Use early return patterns
   - Provide user-friendly error messages without exposing technical details