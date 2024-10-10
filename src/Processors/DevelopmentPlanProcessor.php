<?php

namespace IanRothmann\AINinja\Processors;

use IanRothmann\AINinja\Processors\Traits\OutputsInLanguage;
use IanRothmann\AINinja\Results\AINinjaDevelopmentPlanResult;

class DevelopmentPlanProcessor extends AINinjaProcessor
{
    use OutputsInLanguage;

    protected function getEndpoint(): string
    {
        return '/create_development_plan';
    }

    protected function getResultClass(): string
    {
        return AINinjaDevelopmentPlanResult::class;
    }

    protected function getMocked(): array
    {
        $json = <<<'TOC'
{
  "dev_actions": [
    {
      "category_id": "experience",
      "dev_action_id": "1121",
      "description": "Improve stakeholder engagement during change.",
      "rationale": "Enhancing stakeholder engagement will strengthen leadership during transitions.",
      "priority": "MediumTerm"
    },
    {
      "category_id": "exposure",
      "dev_action_id": "1145",
      "description": "Empower your team with digital tools.",
      "rationale": "Empowering the team with digital tools enhances efficiency and understanding.",
      "priority": "MediumTerm"
    },
    {
      "category_id": "education",
      "dev_action_id": "1156",
      "description": "Enhance knowledge of specific technologies.",
      "rationale": "Expanding knowledge strengthens advisory capabilities in digital transformation.",
      "priority": "LongTerm"
    }
  ]
}
TOC;

        return json_decode($json, true);
    }

    public function addToPersonContext(string $category, string $text): self
    {
        $this->addToInputArray('person_context', $text, $category);

        return $this;
    }

    public function addToAssessmentContext(string $category, string $text): self
    {
        $this->addToInputArray('assessment_context', $text, $category);

        return $this;
    }

    public function addDevelopmentCategory($id, $name, $numActionsRequired): self
    {
        $this->addToInputArray('development_categories', [
            'id' => $id,
            'name' => $name,
            'num_items_required' => $numActionsRequired,
            'development_actions' => [],
        ]);

        return $this;
    }

    public function addDevelopmentAction($categoryId, $actionId, $actionName, $actionDescription, $rationaleHint = null): self
    {
        if (! array_key_exists('development_categories', $this->input)) {
            throw new \Exception('Development categories must be added before adding actions');
        }
        $categories = collect($this->input['development_categories'])->where('id', $categoryId);

        if ($categories->count() == 0) {
            throw new \Exception('Development category with id '.$categoryId.' not found');
        }

        $categoryKey = $categories->keys()->first();
        $category = $categories->first();

        $category['development_actions'][] = [
            'id' => $actionId,
            'title' => $actionName,
            'description' => $actionDescription,
            'rationale_hint' => $rationaleHint,
        ];

        $this->input['development_categories'][$categoryKey] = $category;

        return $this;
    }

    public function avoidActions($actions): self
    {
        if (is_array($actions)) {
            $actions = json_encode($actions);
        }
        $this->setInputParameter('avoid_actions', $actions);

        return $this;
    }

    protected function getValidationRules(): array
    {
        return [
            'person_context' => 'required|array',
            'person_context.*' => 'required|string',
            'assessment_context' => 'required|array',
            'assessment_context.*' => 'required|string',
            'development_categories' => 'required|array',
            'development_categories.*.id' => 'required|string',
            'development_categories.*.name' => 'required|string',
            'development_categories.*.num_items_required' => 'required|integer',
            'development_categories.*.development_actions' => 'required|array',
            'development_categories.*.development_actions.*.id' => 'required',
            'development_categories.*.development_actions.*.title' => 'required',
            'development_categories.*.development_actions.*.description' => 'sometimes',
        ];
    }

    public function get(): AINinjaDevelopmentPlanResult
    {
        return parent::get();
    }

    public function stream($callback = null): AINinjaDevelopmentPlanResult
    {
        return parent::stream($callback);
    }
}
