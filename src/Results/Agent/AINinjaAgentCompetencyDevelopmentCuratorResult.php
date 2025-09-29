<?php

namespace IanRothmann\AINinja\Results\Agent;

use IanRothmann\AINinja\Processors\Agents\Run\AINinjaRunResult;
use Illuminate\Support\Collection;

class AINinjaAgentCompetencyDevelopmentCuratorResult extends AINinjaRunResult
{
    protected function getFinalResult()
    {
        return collect($this->result)->get('output', []);
    }

    public function getSummary(): ?string
    {
        return collect($this->getFinalResult())->get('summary');
    }

    public function getCompetency(): Collection
    {
        return collect(collect($this->getFinalResult())->get('competency', []));
    }

    public function getCompetencyName(): ?string
    {
        return $this->getCompetency()->get('name');
    }

    public function getCompetencyDescription(): ?string
    {
        return $this->getCompetency()->get('description');
    }

    public function getCompetencyTargetLevel(): ?string
    {
        return $this->getCompetency()->get('target_level');
    }

    public function getResources(): Collection
    {
        return collect(collect($this->getFinalResult())->get('resources', []));
    }

    public function getResourcesByType(string $type): Collection
    {
        return collect($this->getResources()->get($type, []));
    }

    public function getELearningResources(): Collection
    {
        return $this->getResourcesByType('e_learning');
    }

    public function getVideoResources(): Collection
    {
        return $this->getResourcesByType('video');
    }

    public function getAudioResources(): Collection
    {
        return $this->getResourcesByType('audio');
    }

    public function getReadingResources(): Collection
    {
        return $this->getResourcesByType('reading');
    }

    public function getDevelopment(): Collection
    {
        return collect(collect($this->getFinalResult())->get('development', []));
    }

    public function getDevelopmentByType(string $type): Collection
    {
        return collect($this->getDevelopment()->get($type, []));
    }

    public function getExperienceDevelopment(): Collection
    {
        return $this->getDevelopmentByType('experience');
    }

    public function getExposureDevelopment(): Collection
    {
        return $this->getDevelopmentByType('exposure');
    }

    public function getEducationDevelopment(): Collection
    {
        return $this->getDevelopmentByType('education');
    }

    public function getAllResourceTypes(): Collection
    {
        return $this->getResources()->keys();
    }

    public function getAllDevelopmentTypes(): Collection
    {
        return $this->getDevelopment()->keys();
    }

    public function getTotalResourcesCount(): int
    {
        return $this->getResources()->map(fn ($resources) => count($resources))->sum();
    }

    public function getTotalDevelopmentItemsCount(): int
    {
        return $this->getDevelopment()->map(fn ($items) => count($items))->sum();
    }

    public function hasResourceType(string $type): bool
    {
        return $this->getResources()->has($type) && ! empty($this->getResources()->get($type));
    }

    public function hasDevelopmentType(string $type): bool
    {
        return $this->getDevelopment()->has($type) && ! empty($this->getDevelopment()->get($type));
    }

    public function getResourceItem(string $type, int $index): ?Collection
    {
        $resources = $this->getResourcesByType($type);
        $item = $resources->get($index);

        return $item ? collect($item) : null;
    }

    public function getDevelopmentItem(string $type, int $index): ?Collection
    {
        $development = $this->getDevelopmentByType($type);
        $item = $development->get($index);

        return $item ? collect($item) : null;
    }

    public function getResourceUrls(string $type): Collection
    {
        return $this->getResourcesByType($type)->pluck('url');
    }

    public function getDevelopmentUrls(string $type): Collection
    {
        return $this->getDevelopmentByType($type)->pluck('urls')->flatten();
    }
}