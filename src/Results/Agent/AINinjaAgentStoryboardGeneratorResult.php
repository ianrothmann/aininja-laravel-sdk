<?php

namespace IanRothmann\AINinja\Results\Agent;

use IanRothmann\AINinja\Processors\Agents\Run\AINinjaRunResult;
use Illuminate\Support\Collection;

class AINinjaAgentStoryboardGeneratorResult extends AINinjaRunResult
{
    protected function getFinalResult()
    {
        return collect($this->result)->get('output', []);
    }

    public function getAudio(): ?string
    {
        return collect($this->getFinalResult())->get('audio');
    }

    public function getScript(): ?string
    {
        return collect($this->getFinalResult())->get('script');
    }

    public function getSubtitles(): Collection
    {
        return collect(collect($this->getFinalResult())->get('subtitles', []));
    }

    public function getCoverContent(): Collection
    {
        return collect(collect($this->getFinalResult())->get('cover_content', []));
    }

    public function getScenes(): Collection
    {
        return collect(collect($this->getFinalResult())->get('scenes', []));
    }

    public function getSceneCount(): int
    {
        return $this->getScenes()->count();
    }

    public function getTotalDuration(): float
    {
        return $this->getScenes()->sum(fn ($scene) => $scene['duration'] ?? 0.0);
    }
}
