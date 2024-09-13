<?php

declare(strict_types=1);

namespace Worq\OpenApiParser\Parsing\Factories;

use Worq\OpenApiParser\Model\LicenseObject;
use Worq\OpenApiParser\Parsing\ParseContext;

interface LicenseObjectFactoryInterface
{
    public function create(object $data, ParseContext $context): LicenseObject;
}
