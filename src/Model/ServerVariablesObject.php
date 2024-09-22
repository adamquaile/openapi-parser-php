<?php

declare(strict_types=1);

namespace TypeSlow\OpenApiParser\Model;

final class ServerVariablesObject implements MapInterface
{
    use MapTrait;

    public function __construct(
        /** @var \Traversable<string, ServerVariableObject> */
        public object $items
    ) {
    }}
