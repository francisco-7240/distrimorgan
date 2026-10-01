<?php

namespace Tests\Feature\View;

use Tests\TestCase;

class NosotrosTest extends TestCase
{
    public function test_can_render(): void
    {
        $response = $this->get('/nosotros');

        $response->assertOk();
        $response->assertSee('Conoce a');
    }
}
