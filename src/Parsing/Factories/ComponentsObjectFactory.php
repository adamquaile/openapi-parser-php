<?php

declare(strict_types=1);

namespace Worq\OpenApiParser\Parsing\Factories;

use Worq\OpenApiParser\Model\ComponentsObject;
use Worq\OpenApiParser\Model\ResponsesObject;
use Worq\OpenApiParser\Model\SchemasObject;
use Worq\OpenApiParser\Parsing\ParseContext;

final class ComponentsObjectFactory
{
    public function create(array $data, ParseContext $context): ComponentsObject
    {
        return new ComponentsObject(
            schemas: array_key_exists('schemas', $data)
                ? $context->factory->create(SchemasObject::class, $data['schemas'], $context)
                : null,
            responses: array_key_exists('responses', $data)
                ? $context->factory->create(ResponsesObject::class, $data['responses'], $context)
                : null,
        );
    }
}
