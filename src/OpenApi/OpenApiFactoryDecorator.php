<?php

namespace App\OpenApi;

use ApiPlatform\OpenApi\Factory\OpenApiFactoryInterface;
use ApiPlatform\OpenApi\Model\Components;
use ApiPlatform\OpenApi\Model\SecurityScheme;
use ApiPlatform\OpenApi\OpenApi;

final class OpenApiFactoryDecorator implements OpenApiFactoryInterface
{
    public function __construct(
        private readonly OpenApiFactoryInterface $decorated
    ) {}

    public function __invoke(array $context = []): OpenApi
    {
        $openApi = ($this->decorated)($context);
        $components = $openApi->getComponents() ?? new Components();

        $securitySchemes = new \ArrayObject([
            'bearerAuth' => new SecurityScheme(
                type: 'http',
                description: 'JWT token authentication',
                scheme: 'bearer',
                bearerFormat: 'JWT'
            ),
        ]);

        $components = $components->withSecuritySchemes($securitySchemes);

        $openApi = $openApi->withComponents($components)
            ->withSecurity([['bearerAuth' => []]]);

        return $openApi;
    }
}
