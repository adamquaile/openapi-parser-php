<?php

declare(strict_types=1);

namespace AdamQ\OpenApiParser\Model;

final class LinkObjectParametersMap implements MapInterface
{
    use MapTrait;

    public function __construct(
        /** @var \Traversable<string, mixed|RuntimeExpression> */
        public object $items
    ) {
    }
}
