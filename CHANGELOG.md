# Changelog

All notable changes to this project will be documented in this file, in reverse chronological order by release.

Versions prior to 0.3.0 were released as the package "weierophinney/hal".

## 0.3.0 - TBD

### Added

- Nothing.

### Changed

- The package name was changed to "zendframework/zend-expressive-hal".
- The namespace was changed from `Hal` to `Zend\Expressive\Hal`.

### Deprecated

- Nothing.

### Removed

- Nothing.

### Fixed

- Nothing.

## 0.2.0 - 2017-07-13

### Added

- [#1](https://github.com/weierophinney/pull/1) adds a `Hal\Renderer`
  subcomponent with the following:
  - `Renderer` interface
  - `JsonRenderer`, for creating JSON representations of `HalResource` instances.
  - `XmlRenderer`, for creating XML representations of `HalResource` instances.

### Changed

- [#1](https://github.com/weierophinney/pull/1) changes `Hal\HalResponseFactory`
  to compose a `JsonRenderer` and `XmlRenderer`, instead of composing
  `$jsonFlags` and creating representations itself. 

  It also makes the response prototype and the stream factory the first
  arguments, as those will be the values most often injected.
  
  The constructor signature is
  now:

  ```php
  public function __construct(
      Psr\Http\Message\ResponseInterface $responsePrototype = null,
      callable $streamFactory = null,
      Hal\Renderer\JsonRenderer $jsonRenderer = null,
      Hal\Renderer\XmlRenderer $xmlRenderer = null
  ) {
  ```

- [#1](https://github.com/weierophinney/pull/1) changes `Hal\HalResponseFactoryFactory`
  to comply with the new constructor signature of `Hal\HalResponseFactory`. It
  also updates to check for `Psr\Http\Message\ResponseInterface` and
  `Psr\Http\Message\StreamInterface` services before attempting to use
  zend-diactoros classes.

### Deprecated

- Nothing.

### Removed

- Nothing.

### Fixed

- Nothing.

## 0.1.6 - 2017-07-12

### Added

- Adds keywords to the `composer.json`
- Adds a "provides" section to the `composer.json` (provides PSR-13 implementation)
- Adds `composer.json` suggestions for:
  - PSR-11 implementation
  - zend-paginator

### Deprecated

- Nothing.

### Removed

- Nothing.

### Fixed

- Nothing.

## 0.1.5 - 2017-07-12

### Added

- Adds documentation; see the [doc/book/](doc/book/) tree, or browse at
  https://weierophinney.github.io/hal/

### Deprecated

- Nothing.

### Removed

- Nothing.

### Fixed

- Nothing.

## 0.1.4 - 2017-07-12

### Added

- Adds the method `templatedFromRoute()` to the `LinkGenerator` class. Acts
  exactly like `fromRoute()`, but the generated `Link` instance will have the
  `isTemplated` property toggled `true`.

### Deprecated

- Nothing.

### Removed

- Nothing.

### Fixed

- Nothing.

## 0.1.3 - 2017-07-11

### Added

- Nothing.

### Deprecated

- Nothing.

### Removed

- Nothing.

### Fixed

- Fixes registration of the `MetadataMap` in the `ConfigProvider`; it was
  previously using an incorrect namespace.

## 0.1.2 - 2017-07-11

### Added

- Adds `HalResponseFactoryFactory`, a factory for generating a
  `HalResponseFactory` instance.

### Deprecated

- Nothing.

### Removed

- Nothing.

### Fixed

- Nothing.

## 0.1.1 - 2017-07-11

### Added

- Adds the ability to inject route params and query string arguments at run-time
  to the route-based metadata instances.

  When dealing with route-based metadata, we may be dealing with
  sub-resources; in such cases, the route parameters may be derived from
  the request, and we will want to inject them at run-time.

  When dealing with collections, the query string arguments may indicate
  things such as searches, sort directions, sort columns, filters, limits,
  etc.; these will be derived from the request, and need to be injected at
  run-time.

### Deprecated

- Nothing.

### Removed

- Nothing.

### Fixed

- Nothing.

## 0.1.0 - 2017-07-10

Initial Release.

### Added

- Everything.

### Deprecated

- Nothing.

### Removed

- Nothing.

### Fixed

- Nothing.
