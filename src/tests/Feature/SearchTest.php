<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class SearchTest extends TestCase
{
    use RefreshDatabase;

    protected $seed = true;

    /**
     * A basic feature test example.
     */
    public function testSearch(): void
    {
        // 「商品名」で部分一致検索ができる
        $response = $this->get('/', ['keyword' => 'コーヒー']);
        $response->assertStatus(200);
        $response->assertSee('コーヒー');
    }
}
