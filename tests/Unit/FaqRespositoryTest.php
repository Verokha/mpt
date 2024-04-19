<?php

namespace Tests\Unit;

use App\Models\Faq;
use App\Models\User;
use App\Repositories\client\FaqRepository;
use Illuminate\Support\Collection;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class FaqRespositoryTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic unit test example.
     */
    public function test_list(): void
    {
        Faq::factory()->count(20)->create();
        $result = FaqRepository::activeList()->toArray();
        $this->assertIsArray($result);
    }
}
