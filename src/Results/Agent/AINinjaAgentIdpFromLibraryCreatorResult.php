<?php

namespace IanRothmann\AINinja\Results\Agent;

use IanRothmann\AINinja\Processors\Agents\Run\AINinjaRunResult;
use Illuminate\Support\Collection;

class AINinjaAgentIdpFromLibraryCreatorResult extends AINinjaRunResult
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

    public function getDevAction(int $devActionId): ?Collection
    {
        $action = $this->getDevActions()->firstWhere('dev_action_id', $devActionId);

        return $action ? collect($action) : null;
    }

    public function getDevelopmentThemes(): Collection
    {
        return collect(collect($this->getFinalResult())->get('development_themes', []));
    }

    public function getDevelopmentTheme(int $priority): ?Collection
    {
        $theme = $this->getDevelopmentThemes()->firstWhere('priority', $priority);

        return $theme ? collect($theme) : null;
    }

    public function getHighestPriorityTheme(): ?Collection
    {
        $theme = $this->getDevelopmentThemes()->sortBy('priority')->first();

        return $theme ? collect($theme) : null;
    }

    public function getThemesByTag(string $tag): Collection
    {
        return $this->getDevelopmentThemes()->filter(fn ($theme) => in_array($tag, $theme['tags'] ?? []));
    }

    public function getTotalDevActions(): int
    {
        return $this->getDevActions()->count();
    }

    public function getTotalDevelopmentThemes(): int
    {
        return $this->getDevelopmentThemes()->count();
    }

    public function getDevActionCategories(): Collection
    {
        return $this->getDevActions()->pluck('category_id')->unique()->values();
    }

    public function getDevActionPriorities(): Collection
    {
        return $this->getDevActions()->pluck('priority')->unique()->values();
    }

    public function getAllThemeTags(): Collection
    {
        return $this->getDevelopmentThemes()->pluck('tags')->flatten()->unique()->values();
    }

    public function getThemeCompetencies(int $priority): Collection
    {
        $theme = $this->getDevelopmentTheme($priority);

        return $theme ? collect($theme->get('linked_competencies', [])) : collect([]);
    }

    public function getThemeQuickDiagnostics(int $priority): Collection
    {
        $theme = $this->getDevelopmentTheme($priority);

        return $theme ? collect($theme->get('quick_diagnostics', [])) : collect([]);
    }

    public function getThemeEvidence(int $priority): Collection
    {
        $theme = $this->getDevelopmentTheme($priority);

        return $theme ? collect($theme->get('evidence', [])) : collect([]);
    }

    public function getThemeSuggestedModalities(int $priority): Collection
    {
        $theme = $this->getDevelopmentTheme($priority);

        return $theme ? collect($theme->get('suggested_modality_focus', [])) : collect([]);
    }
}
