<?php

namespace HammamZarefa\RapidRanker\Tests\Unit;

use HammamZarefa\RapidRanker\Tests\TestCase;
use HammamZarefa\RapidRanker\Traits\HasLevel;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;

class LevelTest extends TestCase
{
    use RefreshDatabase;
    use WithFaker;
    use HasLevel;

    public function testGetCurrentLevel()
    {
        $userMock = $this->createMock(User::class);
        $level =$this->getLevel(1);
        $this->assertEquals(1);
    }
}