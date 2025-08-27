<?php

declare(strict_types=1);

namespace AdamQ\OpenApiParser\Parsing\Factories;

use AdamQ\OpenApiParser\Model\PathItemObject;
use AdamQ\OpenApiParser\Model\PathsObject;
use AdamQ\OpenApiParser\Model\ResponseObject;
use AdamQ\OpenApiParser\Model\ResponsesObject;
use AdamQ\OpenApiParser\Parsing\ParseContext;

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
