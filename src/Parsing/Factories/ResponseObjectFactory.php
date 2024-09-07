<?php

declare(strict_types=1);

namespace Worq\OpenApiParser\Parsing\Factories;

use Worq\OpenApiParser\Model\MediaTypeObjectMap;
use Worq\OpenApiParser\Model\ResponseObject;
use Worq\OpenApiParser\Parsing\ParseContext;

final class ResponseObjectFactory implements ResponseObjectFactoryInterface
{
    public function create(array $data, ParseContext $context): ResponseObject
    {
        return new ResponseObject(
            description: $data['description'],
            content: array_key_exists('content', $data)
                ? $context->factory->create(MediaTypeObjectMap::class, $data['content'], $context)
                : null,
        );
    }
}
