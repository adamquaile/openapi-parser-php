<?php

declare(strict_types=1);

namespace AdamQ\OpenApiParser\Parsing\Factories;

use AdamQ\OpenApiParser\Exceptions\OpenApiValidationError;
use AdamQ\OpenApiParser\Model\ComponentsObject;
use AdamQ\OpenApiParser\Model\InfoObject;
use AdamQ\OpenApiParser\Model\OpenApiObject;
use AdamQ\OpenApiParser\Model\PathsObject;
use AdamQ\OpenApiParser\Model\ServersList;
use AdamQ\OpenApiParser\Model\SecurityRequirementsList;
use AdamQ\OpenApiParser\Model\TagsList;
use AdamQ\OpenApiParser\Model\ExternalDocumentationObject;
use AdamQ\OpenApiParser\Model\Version;
use AdamQ\OpenApiParser\Parsing\ParseContext;

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
