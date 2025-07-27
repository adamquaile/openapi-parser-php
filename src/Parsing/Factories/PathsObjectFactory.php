<?php

declare(strict_types=1);

namespace TypeSlow\OpenApiParser\Parsing\Factories;

use TypeSlow\OpenApiParser\Model\PathItemObject;
use TypeSlow\OpenApiParser\Model\PathsObject;
use TypeSlow\OpenApiParser\Model\ResponseObject;
use TypeSlow\OpenApiParser\Model\ResponsesObject;
use TypeSlow\OpenApiParser\Parsing\ParseContext;

final class PathsObjectFactory implements PathsObjectFactoryInterface
{
    use SpecificationExtensionFactoryTrait;

    public function create(object $data, ParseContext $context): PathsObject
    {
        $paths = self::removeExtendedKeys($data);
        array_walk(
            $paths,
            fn (object $response) => $context->factory->create(PathItemObject::class, $response, $context),
        );
        return new PathsObject(
            items: $paths,
            x: $this->parsedExtensionObject($data),
        );
    }
}
