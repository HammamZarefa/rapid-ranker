<?php

namespace HammamZarefa\RapidRanker\Traits;

use HammamZarefa\RapidRanker\Models\Level;
use HammamZarefa\RapidRanker\Models\LevelAudit;

trait HasLevel
{
    public function currentLevel()
    {
        return $this->level;
    }

    public function nextLevel()
    {
        if (!$this->lock_level && $this->level != (Level::orderBy('level', 'desc')->first())->level) {
            $currentLevel = $this->getLevel($this->level);
            $data['remain_points'] =
                $currentLevel->next_level_points - $this->points;
            $data['progress'] = $this->points * 100 / $currentLevel->next_level_points;
            if ($this->level == 1)
                $data['remain_days'] = 1000;
            else
                $data['remain_days'] =
                    $currentLevel->points_reach_duration - now()
                        ->diffInDays($this->getLastLevelChange($this)->created_at);
        } else {
            $data['remain_points'] = 1000000;
            $data['remain_days'] = 1000;
            $data['progress'] = 0;
        }
        return $data;
    }

    public function getPoints($user = null)
    {
        return $this->points;
    }

    public function addPoints(float $points)
    {
        $this->points += $points;
        $this->save();
        if ($this->shouldUserLevelUp())
            $this->userLevelUp();
    }


    public function deductPoints(float $points)
    {
        $this->points -= $points;
        $this->save();
    }

    public function getLastLevelChange($user)
    {
        $levelAudit = LevelAudit::where('user_id', $user->id)->latest()->first();
        return $levelAudit;
    }

    public function getLevel($id)
    {
        return Level::where('level', $id)->first();
    }

    public function shouldUserLevelUp()
    {
        $data = $this->nextLevel();
        if ($data['remain_points'] <= 0 && $data['remain_days'] >= 0)
            return true;
        return false;
    }

    public function shouldUserLevelDown()
    {
        $data = $this->nextLevel();
        if ($data['remain_points'] > 0 && $data['remain_days'] < 0)
            return true;
        return false;
    }

    public function checkLevelChanges()
    {
        if ($this->shouldUserLevelUp()) {
            $this->userLevelUp();
        } elseif ($this->shouldUserLevelDown()) {
            $this->userLevelDown();
        }
    }

    public function userLevelUp()
    {
        $this->level += 1;
        $this->points = 0;
        $this->save();
        LevelAudit::create([
            "user_id" => $this->id,
            "level_to" => $this->level
        ]);
    }

    public function userLevelDown()
    {
        $this->level -= 1;
        $this->points = 0;
        $this->save();
        LevelAudit::create([
            "user_id" => $this->id,
            "level_to" => $this->level
        ]);
    }

    public function lockLevel($level)
    {
        $this->lock_level = $level;
        $this->level = $level;
        $this->points = 0;
        $this->save();
        return $this->lock_level;
    }

    public function unlockLevel($level = null)
    {
        $this->lock_level = null;
        if ($level)
            $this->level = $level;
        $this->points = 0;
        $this->save();
        return $this->lock_level;
    }
}