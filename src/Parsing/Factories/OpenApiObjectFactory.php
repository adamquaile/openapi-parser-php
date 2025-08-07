<?php

declare(strict_types=1);

namespace TypeSlow\OpenApiParser\Parsing\Factories;

use TypeSlow\OpenApiParser\Exceptions\OpenApiValidationError;
use TypeSlow\OpenApiParser\Model\ComponentsObject;
use TypeSlow\OpenApiParser\Model\InfoObject;
use TypeSlow\OpenApiParser\Model\OpenApiObject;
use TypeSlow\OpenApiParser\Model\PathsObject;
use TypeSlow\OpenApiParser\Model\ServersList;
use TypeSlow\OpenApiParser\Model\SecurityRequirementsList;
use TypeSlow\OpenApiParser\Model\TagsList;
use TypeSlow\OpenApiParser\Model\ExternalDocumentationObject;
use TypeSlow\OpenApiParser\Model\Version;
use TypeSlow\OpenApiParser\Parsing\ParseContext;

final class OpenApiObjectFactory implements OpenApiObjectFactoryInterface
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
            jsonSchemaDialect: $data->jsonSchemaDialect ?? null,
            servers: $context->factory->create(ServersList::class, $data->servers ?? null, $context),
            paths: $context->factory->create(PathsObject::class, $data->paths ?? null, $context),
            components: $context->factory->create(ComponentsObject::class, $data->components ?? null, $context),
            security: $context->factory->create(SecurityRequirementsList::class, $data->security ?? null, $context),
            tags: $context->factory->create(TagsList::class, $data->tags ?? null, $context),
            externalDocs: $context->factory->create(ExternalDocumentationObject::class, $data->externalDocs ?? null, $context),
        );
    }
}
