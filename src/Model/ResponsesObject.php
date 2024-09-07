<?php

declare(strict_types=1);

namespace Worq\OpenApiParser\Model;

/**
 * @implements MapTrait<ResponseObject>
 */
final class ResponsesObject implements \IteratorAggregate, \ArrayAccess
{
    use MapTrait;

    public function __construct(
        /** @var array<string, ResponseObject> */
        public array $items
    ) {
    }
}
