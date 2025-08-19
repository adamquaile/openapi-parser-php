<?php

declare(strict_types=1);

namespace AdamQ\OpenApiParser\Tests\Feature;

use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\TestCase;
use AdamQ\OpenApiParser\Model\ContactObject;
use AdamQ\OpenApiParser\Model\InfoObject;
use AdamQ\OpenApiParser\Model\OpenApiObject;
use AdamQ\OpenApiParser\Model\PathsObject;
use AdamQ\OpenApiParser\Model\ServerObject;
use AdamQ\OpenApiParser\Model\ServersList;
use AdamQ\OpenApiParser\Model\ServerVariableObject;
use AdamQ\OpenApiParser\Model\ServerVariableObjectMap;
use AdamQ\OpenApiParser\OpenApiParser;

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
                servers: new ServersList(items: [
                    new ServerObject(
                        url: 'http://localhost',
                        description: 'Local development server',
                    ),
                    new ServerObject(
                        url: 'https://{environment}.example.com',
                        description: 'Live server',
                        variables: new ServerVariableObjectMap(
                            items: (object) [
                                'environment' => new ServerVariableObject(
                                    default: 'prod',
                                    enum: ['prod', 'staging']
                                ),
                            ]
                        )
                    ),
                ])
            ),
            $openapi
        );
    }
}
