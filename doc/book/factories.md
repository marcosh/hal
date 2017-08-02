# Provided factories

This component provides a number of factories for use with
[PSR-11](http://www.php-fig.org/psr/psr-11/), in order to generate fully
configured instances for your use.

## Zend\Expressive\Hal\HalResponseFactoryFactory

- Registered as service: `Zend\Expressive\Hal\HalResponseFactory`
- Generates instance of: `Zend\Expressive\Hal\HalResponseFactory`
- Depends on:
    - `Psr\Http\Message\ResponseInterface` service. If not present, it will
      check if zend-diactoros is installed, and use a new `Response` instance
      from that library; if not, it raises an exception.
    - `Psr\Http\Message\StreamInterface` service. This service must return a
      a callable capable of returning a `StreamInterface` instance (in other
      words, the service returns a _factory_, and not the stream itself). If th
      service is not present, the factory will check if zend-diactoros is
      installed, and return a callable that returns a new `Stream` instance from
      that library; if not, it raises an exception.
    - `Zend\Expressive\Hal\Renderer\JsonRenderer` service. If the service is not
      present, it instantiates an instance itself.
    - `Zend\Expressive\Hal\Renderer\XmlRenderer` service. If the service is not
      present, it instantiates an instance itself.

If you want to use a different PSR-7 implementation for the response and stream,
provide services for `Psr\Http\Message\ResponseInterface` and
`Psr\Http\Message\StreamInterface`, as described above.

## Zend\Expressive\Hal\LinkGeneratorFactory

- Registered as service: `Zend\Expressive\Hal\LinkGenerator`
- Generates instance of: `Zend\Expressive\Hal\LinkGenerator`
- Depends on:
    - `Zend\Expressive\Hal\LinkGenerator\UrlGenerator` service

## Zend\Expressive\Hal\LinkGenerator\ExpressiveUrlGeneratorFactory

- Registered as service: `Zend\Expressive\Hal\LinkGenerator\ExpressiveUrlGenerator`
- Generates instance of: `Zend\Expressive\Hal\LinkGenerator\ExpressiveUrlGenerator`
- Depends on:
    - [zendframework/zend-expressive-helpers](https://github.com/zendframework/zend-expressive-helpers) package
    - `Zend\Expressive\Helper\UrlHelper` service
    - `Zend\Expressive\Helper\ServerUrlHelper` service (optional; if not provided,
      URIs will be generated without authority information)

## Zend\Expressive\Hal\LinkGenerator\UrlGenerator

- Registered as service: `Zend\Expressive\Hal\LinkGenerator\UrlGenerator`
- Aliased to service: `Zend\Expressive\Hal\LinkGenerator\ExpressiveUrlGenerator`

You can either define an alternate alias, or map the `UrlGenerator` service
directly to a factory that will return a valid instance.

## Zend\Expressive\Hal\Metadata\MetadataMapFactory

- Registered as service: `Zend\Expressive\Hal\Metadata\MetadataMap`
- Generates instance of: `Zend\Expressive\Hal\Metadata\MetadataMap`
- Depends on:
    - `config` service; if not present, will use an empty array

This service uses the `Zend\Expressive\Hal\Metadata\MetadataMap` key of the `config` service in
order to configure and return a `Zend\Expressive\Hal\Metadata\MetadataMap` instance. It expects
that value to be an array of elements, each with the following structure:

```php
[
    '__class__' => 'Fully qualified class name of an AbstractMetadata type',
    // additional key/value pairs as required by the metadata type.
]
```

The additional pairs are as follows:

- For `UrlBasedResourceMetadata`:
    - `resource_class`: the resource class the metadata describes.
    - `url`: the URL to use when generating a self-relational link for the
      resource.
    - `extractor`: the extractor/hydrator service to use to extract resource
      data.
- For `UrlBasedCollectionMetadata`:
    - `collection_class`: the collection class the metadata describes.
    - `collection_relation`: the embedded relation for the collection in the
      generated resource.
    - `url`: the URL to use when generating a self-relational link for the
      collection resource.
    - `pagination_param`: the name of the parameter indicating what page of data
      is present. Defaults to "page".
    - `pagination_param_type`: whether the pagination parameter is a query string
      or path placeholder; use either `AbstractCollectionMetadata::TYPE_QUERY`
      ("query") or `AbstractCollectionMetadata::TYPE_PLACEHOLDER` ("placeholder");
      default is "query".
- For `RouteBasedResourceMetadata`:
    - `resource_class`: the resource class the metadata describes.
    - `route`: the route to use when generating a self relational link for the
      resource.
    - `extractor`: the extractor/hydrator service to use to extract resource
      data.
    - `resource_identifier`: what property in the resource represents its
      identifier; defaults to "id".
    - `route_identifier_placeholder`: what placeholder in the route string
      represents the resource identifier; defaults to "id".
    - `route_params`: an array of additional routing parameters to use when
      generating the self relational link for the resource.
- For `RouteBasedCollectionMetadata`:
    - `collection_class`: the collection class the metadata describes.
    - `collection_relation`: the embedded relation for the collection in the
      generated resource.
    - `route`: the route to use when generating a self relational link for the
      collection resource.
    - `pagination_param`: the name of the parameter indicating what page of data
      is present. Defaults to "page".
    - `pagination_param_type`: whether the pagination parameter is a query string
      or path placeholder; use either `AbstractCollectionMetadata::TYPE_QUERY`
      ("query") or `AbstractCollectionMetadata::TYPE_PLACEHOLDER` ("placeholder");
      default is "query".
    - `route_params`: an array of additional routing parameters to use when
      generating the self relational link for the collection resource. Defaults
      to an empty array.
    - `query_string_arguments`: an array of query string parameters to include
      when generating the self relational link for the collection resource.
      Defaults to an empty array.

If you have created custom metadata types, you can extend this class to
support them. Create `create<type>(array $metadata)` methods for each
type you wish to support, where `<type>` is your custom class name, minus
the namespace.

## Zend\Expressive\Hal\ResourceGeneratorFactory

- Registered as service: `Zend\Expressive\Hal\ResourceGenerator`
- Generates instance of: `Zend\Expressive\Hal\ResourceGenerator`
- Depends on:
    - `Zend\Expressive\Hal\Metadata\MetadataMap` service
    - `Zend\Hydrator\HydratorPluginManager` service
    - `Zend\Expressive\Hal\LinkGenerator` service

If you wish to use a container implementation other than the
`Zend\Hydrator\HydratorPluginManager`, either register it under that service
name, or create an alternate factory.
