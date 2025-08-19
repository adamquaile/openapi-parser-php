<?php

declare(strict_types=1);

namespace AdamQ\OpenApiParser\Model;

final class TagsList
{
    /**
     * @param array<TagObject> $items
     */
    public function __construct(public array $items)
    {
    }
}