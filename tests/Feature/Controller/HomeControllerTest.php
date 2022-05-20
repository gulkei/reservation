<?php

namespace Tests\Feature\Controller;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class HomeControllerTest extends TestCase
{
    /**
     * カレンダーを取得してviewを返す
     *
     * @return view
     */
    public function test_index()
    {
        $response = $this->get(route('home'));

        $response->assertStatus(200);
    }
}
