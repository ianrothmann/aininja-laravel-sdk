<?php

namespace IanRothmann\AINinja\Results\Agent;

use IanRothmann\AINinja\Processors\Agents\Run\AINinjaRunResult;
use Illuminate\Support\Collection;

class AINinjaAgentIdpCreatorResult extends AINinjaRunResult
{
    protected function getFinalResult()
    {
        return collect($this->result)->get('output', []);
    }

    public function getDevActions(): Collection
    {
        return collect(collect($this->getFinalResult())->get('dev_actions', []));
    }

    public function getDevActionsByCategory(string $categoryId): Collection
    {
        return $this->getDevActions()->filter(fn ($action) => $action['category_id'] === $categoryId);
    }

    public function getDevActionsByPriority(string $priority): Collection
    {
        return $this->getDevActions()->filter(fn ($action) => $action['priority'] === $priority);
    }

    public function getDevActionsByKeyword(string $keyword): Collection
    {
        return $this->getDevActions()->filter(function ($action) use ($keyword) {
            $keywords = $action['keywords'] ?? [];

            return in_array($keyword, $keywords);
        });
    }

    public function getDevActionByUrl(string $url): ?Collection
    {
        $action = $this->getDevActions()->firstWhere('url', $url);

        return $action ? collect($action) : null;
    }

    public function getDevActionByTitle(string $title): ?Collection
    {
        $action = $this->getDevActions()->firstWhere('title', $title);

        return $action ? collect($action) : null;
    }

    public function getTotalDevActions(): int
    {
        return $this->getDevActions()->count();
    }

    public function getDevActionCategories(): Collection
    {
        return $this->getDevActions()->pluck('category_id')->unique()->values();
    }

    public function getDevActionPriorities(): Collection
    {
        return $this->getDevActions()->pluck('priority')->unique()->values();
    }

    public function getAllKeywords(): Collection
    {
        return $this->getDevActions()->pluck('keywords')->flatten()->unique()->values();
    }

    public function getDevActionsWithThumbnails(): Collection
    {
        return $this->getDevActions()->filter(fn ($action) => ! empty($action['thumbnail_url']));
    }

    public function getDevActionsWithoutThumbnails(): Collection
    {
        return $this->getDevActions()->filter(fn ($action) => empty($action['thumbnail_url']));
    }

    public function getDevActionsWithUrls(): Collection
    {
        return $this->getDevActions()->filter(fn ($action) => ! empty($action['url']));
    }

    public function getDevActionsWithoutUrls(): Collection
    {
        return $this->getDevActions()->filter(fn ($action) => empty($action['url']));
    }
}
