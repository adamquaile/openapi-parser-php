<?php

declare(strict_types=1);

namespace Worq\OpenApiParser\Model;

/**
 * @implements MapInterface<ResponseObject>
 */
final class ResponsesObject implements MapInterface
{
    use MapTrait;

    public function __construct(
        /** @var array<string, ResponseObject> */
        public array $items
    ) {
    }
}
