<?php

namespace IanRothmann\AINinja\Processors;

use IanRothmann\AINinja\Processors\Traits\OutputsInLanguage;
use IanRothmann\AINinja\Results\AINinjaCategorizedCompetenciesResult;
use IanRothmann\AINinja\Results\AINinjaCompetencyMappingResult;

class MapDerivedCompetenciesProcessor extends AINinjaProcessor
{
    use OutputsInLanguage;

    protected function getEndpoint(): string
    {
        return '/derived_competency_mapping';
    }

    protected function getResultClass(): string
    {
        return AINinjaCompetencyMappingResult::class;
    }

    public function addCompetency($id, $name, $description): self
    {
        $this->addToInputArray('derived_competency_model', [
            'id' => $id,
            'name' => $name,
            'description' => $description,
        ]);

        return $this;
    }

    public function addMappingCompetency($id, $name, $description): self
    {
        $this->addToInputArray('universal_competency_model', [
            'id' => $id,
            'name' => $name,
            'description' => $description,
        ]);

        return $this;
    }

    public function withGuidelines(string $text): self
    {
        $this->setInputParameter('guidelines', $text);

        return $this;
    }

    protected function getValidationRules(): array
    {
        return [
            'derived_competency_model' => 'required|array',
            'derived_competency_model.*.id' => 'required',
            'derived_competency_model.*.name' => 'required',
            'universal_competency_model' => 'required|array',
            'universal_competency_model.*.id' => 'required',
            'universal_competency_model.*.name' => 'required',
            'guidelines' => 'sometimes|string',
        ];
    }

    public function get(): AINinjaCompetencyMappingResult
    {
        return parent::get();
    }

    public function stream($callback = null): AINinjaCompetencyMappingResult
    {
        return parent::stream($callback);
    }

    protected function getMocked(): array
    {
        $json = <<<TOC
{
  "categories": {
    "Motivate": [
      {
        "name": "Inspiring",
        "description": null,
        "id": "inspiring"
      },
      {
        "name": "Purpose Creation",
        "description": null,
        "id": "purpose_creation"
      }
    ],
    "Enable": [
      {
        "name": "Promoting Flexibility",
        "description": null,
        "id": "promoting_flexibility"
      },
      {
        "name": "Cultivating Diverse Talent",
        "description": null,
        "id": "cultivating_diverse_talent"
      }
    ],
    "Connect": [
      {
        "name": "Persuasion",
        "description": null,
        "id": "persuasion"
      },
      {
        "name": "Teamwork",
        "description": null,
        "id": "teamwork"
      }
    ],
    "Develop": [
      {
        "name": "Achieving Outcomes",
        "description": null,
        "id": "achieving_outcomes"
      },
      {
        "name": "Business Growth",
        "description": null,
        "id": "business_growth"
      }
    ]
  }
}
TOC;
        return json_decode($json, true);
    }
}
