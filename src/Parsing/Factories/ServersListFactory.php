<?php

declare(strict_types=1);

namespace TypeSlow\OpenApiParser\Parsing\Factories;

use TypeSlow\OpenApiParser\Model\ServerObject;
use TypeSlow\OpenApiParser\Model\ServersList;
use TypeSlow\OpenApiParser\Parsing\ParseContext;

final class ServersListFactory implements ServersListFactoryInterface
{
    use ListFactoryTrait;

    public function create(array $data, ParseContext $context): ServersList
    {
        self::modifyEveryObjectProperty(
            $data,
            fn (object $server) => $context->factory->create(ServerObject::class, $server, $context)
        );
        return new ServersList(items: $data);
    }
}
