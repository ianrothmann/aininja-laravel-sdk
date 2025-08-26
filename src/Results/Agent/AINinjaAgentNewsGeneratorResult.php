<?php

namespace IanRothmann\AINinja\Results\Agent;

use IanRothmann\AINinja\Processors\Agents\Run\AINinjaRunResult;
use Illuminate\Support\Collection;

class AINinjaAgentNewsGeneratorResult extends AINinjaRunResult
{
    public function getTopics(): Collection
    {
        $topics = collect($this->result)->get('topics', []);

        return collect($topics);
    }

    public function getTopicTitles(): Collection
    {
        return $this->getTopics()->pluck('title');
    }

    public function getTopicSummaries(): Collection
    {
        return $this->getTopics()->pluck('summary');
    }

    public function getFirstTopic(): ?array
    {
        return $this->getTopics()->first();
    }

    public function getTopicsCount(): int
    {
        return $this->getTopics()->count();
    }
}
