<?php

declare(strict_types=1);

namespace Worq\OpenApiParser\Parsing\Factories;

use Worq\OpenApiParser\Model\ServerObject;
use Worq\OpenApiParser\Model\ServerVariablesObject;
use Worq\OpenApiParser\Parsing\ParseContext;

final class ServerObjectFactory implements ServerObjectFactoryInterface
{
    use SpecificationExtensionFactoryTrait;

    public function create(object $data, ParseContext $context): ServerObject
    {
        return new ServerObject(
            url: $data->url,
            description: $data->description ?? null,
            variables: $context->factory->create(ServerVariablesObject::class, $data->variables ?? null, $context),
            x: $this->parsedExtensionObject($data),
        );
    }
}
