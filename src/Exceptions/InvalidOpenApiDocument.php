<?php

declare(strict_types=1);

namespace TypeSlow\OpenApiParser\Exceptions;

use Exception;

final class InvalidOpenApiDocument extends Exception
{
    /**
     * @param OpenApiValidationError[] $errors
     */
    public function __construct(
        array $errors
    ) {
        parent::__construct(
            implode(
                '. ',
                array_map(fn (OpenApiValidationError $e) => $e->getMessage(), $errors)
            )
        );
    }
}
