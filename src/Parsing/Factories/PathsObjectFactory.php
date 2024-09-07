<?php

declare(strict_types=1);

namespace Worq\OpenApiParser\Parsing\Factories;

use Worq\OpenApiParser\Model\PathItemObject;
use Worq\OpenApiParser\Model\PathsObject;
use Worq\OpenApiParser\Model\ResponseObject;
use Worq\OpenApiParser\Model\ResponsesObject;
use Worq\OpenApiParser\Parsing\ParseContext;

final class PathsObjectFactory implements PathsObjectFactoryInterface
{
    public function create(array $data, ParseContext $context): PathsObject
    {
        return new PathsObject(
            items: array_map(
                fn (array $response) => $context->factory->create(PathItemObject::class, $response, $context),
                $data
            )
        );
    }
}
