<?php

declare(strict_types=1);

namespace Worq\OpenApiParser\Parsing\Factories;

use Worq\OpenApiParser\Exceptions\OpenApiValidationError;
use Worq\OpenApiParser\Model\ComponentsObject;
use Worq\OpenApiParser\Model\InfoObject;
use Worq\OpenApiParser\Model\OpenApiObject;
use Worq\OpenApiParser\Model\PathsObject;
use Worq\OpenApiParser\Model\Version;
use Worq\OpenApiParser\Parsing\ParseContext;

final class OpenApiObjectFactory
{
    public function create(array $data, ParseContext $context): OpenApiObject
    {
        if ($context->version === Version::V3_0 && !array_key_exists('paths', $data)) {
            throw new OpenApiValidationError(
                $context->path,
                'OpenAPI 3.0 documents must contain a `paths` property',
            );
        }

        $info = $context->factory->create(InfoObject::class, $data['info'], $context);
        return new OpenApiObject(
            openapi: $data['openapi'],
            info: $info,
            components: array_key_exists('components', $data)
                ? $context->factory->create(ComponentsObject::class, $data['components'], $context)
                : null,
            paths: array_key_exists('paths', $data)
                ? $context->factory->create(PathsObject::class, $data['paths'], $context)
                : null,
        );
    }
}
