<?php

declare(strict_types=1);

namespace AdamQ\OpenApiParser\Model;

final class ServersList
{
    /**
     * @param array<ServerObject> $items
     */
    public function __construct(public array $items)
    {

    }
}
