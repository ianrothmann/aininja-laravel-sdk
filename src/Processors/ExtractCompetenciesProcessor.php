<?php

namespace IanRothmann\AINinja\Processors;

use IanRothmann\AINinja\Processors\Traits\OutputsInLanguage;
use IanRothmann\AINinja\Results\AINinjaCategorizedCompetenciesResult;

class ExtractCompetenciesProcessor extends AINinjaProcessor
{
    use OutputsInLanguage;

    protected function getEndpoint(): string
    {
        return '/competencies_from_text';
    }

    protected function getResultClass(): string
    {
        return AINinjaCategorizedCompetenciesResult::class;
    }

    public function fromText(string $text): self
    {
        $this->setInputParameter('text', strip_tags($text));

        return $this;
    }

    protected function getValidationRules(): array
    {
        return [
            'text' => 'required|string',
        ];
    }

    public function get(): AINinjaCategorizedCompetenciesResult
    {
        return parent::get();
    }

    public function stream($callback = null): AINinjaCategorizedCompetenciesResult
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
