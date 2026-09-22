<?php

namespace Tests\Feature;

use Tests\TestCase;

class PublicAccessTest extends TestCase
{
    public function test_public_page_opens_without_a_browser_verification_gate(): void
    {
        $this->get('/biaya-kuliah')
            ->assertOk()
            ->assertDontSee('google.com/recaptcha', false)
            ->assertDontSee('challenges.cloudflare.com', false)
            ->assertDontSee('verifycaptcha', false);
    }

    public function test_login_uses_existing_production_assets(): void
    {
        $response = $this->get('/login')->assertOk();
        $response->assertDontSee(':5173', false);

        preg_match_all('~(?:href|src)="[^"]*/build/(assets/[^"?]+)~', $response->getContent(), $matches);
        $this->assertNotEmpty($matches[1]);

        foreach ($matches[1] as $asset) {
            $this->assertFileExists(public_path('build/'.$asset));
        }
    }

    public function test_admin_still_requires_authentication(): void
    {
        $this->get('/admin')->assertRedirect(route('login'));
    }
}
