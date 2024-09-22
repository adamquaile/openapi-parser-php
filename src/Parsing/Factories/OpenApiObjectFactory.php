<?php

declare(strict_types=1);

namespace TypeSlow\OpenApiParser\Parsing\Factories;

use TypeSlow\OpenApiParser\Exceptions\OpenApiValidationError;
use TypeSlow\OpenApiParser\Model\ComponentsObject;
use TypeSlow\OpenApiParser\Model\InfoObject;
use TypeSlow\OpenApiParser\Model\OpenApiObject;
use TypeSlow\OpenApiParser\Model\PathsObject;
use TypeSlow\OpenApiParser\Model\ServerObject;
use TypeSlow\OpenApiParser\Model\Version;
use TypeSlow\OpenApiParser\Parsing\ParseContext;

final class OpenApiObjectFactory
{
    public function create(object $data, ParseContext $context): OpenApiObject
    {
        if ($context->version === Version::V3_0 && !isset($data->paths)) {
            throw new OpenApiValidationError(
                $context->path,
                'OpenAPI 3.0 documents must contain a `paths` property',
            );
        }

        $info = $context->factory->create(InfoObject::class, $data->info, $context);
        return new OpenApiObject(
            openapi: $data->openapi,
            info: $info,
            components: $context->factory->create(ComponentsObject::class, $data->components ?? null, $context),
            paths: $context->factory->create(PathsObject::class, $data->paths ?? null, $context),
            servers: isset($data->servers)
                ? array_map(
                    fn ($server) => $context->factory->create(ServerObject::class, $server, $context),
                    $data->servers ?? []
                )
                : null,
        );
    }
}
