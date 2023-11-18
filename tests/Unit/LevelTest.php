<?php

namespace Unit;

use HammamZarefa\RapidRanker\Traits\HasLevel;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use TestCase;

class LevelTest extends TestCase
{
    use RefreshDatabase;
    use WithFaker;
    use HasLevel;

    public function testGetCurrentLevel()
    {

        $level =$this->getLevel(1);
        $this->assertEquals(1);
    }
}