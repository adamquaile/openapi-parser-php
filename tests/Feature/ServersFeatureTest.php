<?php

declare(strict_types=1);

namespace TypeSlow\OpenApiParser\Tests\Feature;

use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\TestCase;
use TypeSlow\OpenApiParser\Model\ContactObject;
use TypeSlow\OpenApiParser\Model\InfoObject;
use TypeSlow\OpenApiParser\Model\OpenApiObject;
use TypeSlow\OpenApiParser\Model\PathsObject;
use TypeSlow\OpenApiParser\Model\ServerObject;
use TypeSlow\OpenApiParser\Model\ServerVariableObject;
use TypeSlow\OpenApiParser\Model\ServerVariablesObject;
use TypeSlow\OpenApiParser\OpenApiParser;

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
