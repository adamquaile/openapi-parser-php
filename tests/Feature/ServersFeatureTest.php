<?php

declare(strict_types=1);

namespace Worq\OpenApiParser\Tests\Feature;

use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\TestCase;
use Worq\OpenApiParser\Model\ContactObject;
use Worq\OpenApiParser\Model\InfoObject;
use Worq\OpenApiParser\Model\OpenApiObject;
use Worq\OpenApiParser\Model\PathsObject;
use Worq\OpenApiParser\Model\ServerObject;
use Worq\OpenApiParser\Model\ServerVariableObject;
use Worq\OpenApiParser\Model\ServerVariablesObject;
use Worq\OpenApiParser\OpenApiParser;

#[CoversClass(OpenApiParser::class)]
final class ServersFeatureTest extends TestCase
{
    public function testSpecificationExample(): void
    {
        $openapiParser = new OpenApiParser();
        $openapi = $openapiParser->parseYamlString(
            file_get_contents(__DIR__ . '/../Support/examples/servers.openapi.yaml')
        );

        $this->assertEquals(
            new OpenApiObject(
                openapi: '3.1.0',
                info: new InfoObject(
                    title: 'Servers Example',
                    version: '1.0.0',
                ),
                paths: new PathsObject(items: (object) []),
                servers: [
                    new ServerObject(
                        url: 'http://localhost',
                        description: 'Local development server',
                    ),
                    new ServerObject(
                        url: 'https://{environment}.example.com',
                        description: 'Live server',
                        variables: new ServerVariablesObject(
                            items: (object) [
                                'environment' => new ServerVariableObject(
                                    default: 'prod',
                                    enum: ['prod', 'staging']
                                ),
                            ]
                        )
                    ),
                ]
            ),
            $openapi
        );
    }
}
