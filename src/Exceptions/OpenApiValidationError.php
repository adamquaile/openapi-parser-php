<?php

declare(strict_types=1);

namespace TypeSlow\OpenApiParser\Exceptions;

use TypeSlow\OpenApiParser\Parsing\DocumentPath;

final class OpenApiValidationError extends \Exception
{
    public function __construct(
        private DocumentPath $path,
        private string $error,
    ) {
        parent::__construct(sprintf(
            'Error at %s: %s',
            $this->path,
            $this->error,
        ));
    }
}
