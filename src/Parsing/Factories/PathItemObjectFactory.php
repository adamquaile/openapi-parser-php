<?php

declare(strict_types=1);

namespace Worq\OpenApiParser\Parsing\Factories;

use Worq\OpenApiParser\Model\OperationObject;
use Worq\OpenApiParser\Model\PathItemObject;
use Worq\OpenApiParser\Model\PathsObject;
use Worq\OpenApiParser\Model\ResponseObject;
use Worq\OpenApiParser\Model\ResponsesObject;
use Worq\OpenApiParser\Parsing\ParseContext;

final class PathItemObjectFactory implements PathItemObjectFactoryInterface
{
    public function create(array $data, ParseContext $context): PathItemObject
    {
        return new PathItemObject(
            get: array_key_exists('get', $data)
                ? $context->factory->create(OperationObject::class, $data['get'], $context)
                : null,
        );
    }
}
