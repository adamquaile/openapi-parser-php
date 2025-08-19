<?php

declare(strict_types=1);

namespace AdamQ\OpenApiParser\Parsing\Factories;

use AdamQ\OpenApiParser\Model\ServerObject;
use AdamQ\OpenApiParser\Model\ServersList;
use AdamQ\OpenApiParser\Parsing\ParseContext;

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
