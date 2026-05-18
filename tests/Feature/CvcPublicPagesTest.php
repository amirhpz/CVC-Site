<?php

namespace Tests\Feature;

use Tests\TestCase;

class CvcPublicPagesTest extends TestCase
{
    public static function cvcPageProvider(): array
    {
        return [
            ['cvc.home', '/'],
            ['cvc.home3', '/home3'],
            ['cvc.about', '/about'],
            ['cvc.contact', '/contact'],
            ['cvc.faq', '/faq'],
            ['cvc.investment', '/investment'],
            ['cvc.investment-process', '/investment-process'],
            ['cvc.news', '/news'],
            ['cvc.portfolio', '/portfolio'],
            ['cvc.team', '/team'],
            ['cvc.career', '/career'],
            ['cvc.domains', '/domains'],
        ];
    }

    /**
     * @dataProvider cvcPageProvider
     */
    public function test_cvc_public_pages_are_accessible_and_named(string $routeName, string $uri): void
    {
        $this->assertSame($uri, route($routeName, [], false));

        $response = $this->get($uri);

        $response->assertOk();
    }
}
