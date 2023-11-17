<?php

namespace HammamZarefa\RapidRanker\Interfaces;

interface Level
{
    public function currentLevel();

    public function nextLevel();

    public function getPoints();
    public function addPoints();
}