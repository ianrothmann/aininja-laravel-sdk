<?php

namespace IanRothmann\AINinja\Processors;

use IanRothmann\AINinja\Results\AINinjaSuccessProfileResult;

class SuccessProfileProcessor extends AINinjaProcessor
{
    public function __construct()
    {
        parent::__construct();
    }

    protected function getEndpoint(): string
    {
        return '/create_success_profile_alt';
    }

    protected function getResultClass(): string
    {
        return AINinjaSuccessProfileResult::class;
    }

    public function basedOn($text): self
    {
        $this->setInputParameter('job_description', $text);

        return $this;
    }

    public function addCompetency($id, $name, $description): self
    {
        $this->addToInputArray('competencies', [
            'competency_id' => (string) $id,
            'competency_name' => $name,
            'description' => $description ?? '',
        ]);

        return $this;
    }

    protected function getValidationRules(): array
    {
        $rules = [
            'job_description' => 'required|string',
            'competencies' => 'required|array',
            'competencies.*.competency_id' => 'required',
            'competencies.*.competency_name' => 'required',
        ];

        return $rules;
    }

    protected function transformInputForTransport(): array
    {
        $input = $this->input;

        return $input;
    }

    public function get(): AINinjaSuccessProfileResult
    {
        return parent::get();
    }

    public function stream($callback = null): AINinjaSuccessProfileResult
    {
        return parent::stream($callback);
    }

    protected function getMocked()
    {
        return json_decode('[
  {
    "id": "F003",
    "name": "Strategic Forecasting",
    "weight": 0.191,
    "themes": [
      {
        "name": "Financial Planning",
        "description": "Crafting financial strategies and overseeing long-term budgets to align with business goals.",
        "importance": "high"
      },
      {
        "name": "Reporting Accuracy",
        "description": "Ensuring precise and compliant financial reports and forecasts.",
        "importance": "medium"
      },
      {
        "name": "Technical Skills",
        "description": "Expertise in financial systems, analysis, and capital management.",
        "importance": "medium"
      },
      {
        "name": "Strategic Problem-Solving",
        "description": "Strong analytical and decision-making abilities for financial strategy.",
        "importance": "medium"
      }
    ]
  },
  {
    "id": "F001",
    "name": "Data Analytics",
    "weight": 0.108,
    "themes": [
      {
        "name": "Reporting and Forecasting",
        "description": "Producing accurate financial reports and forecasts in line with standards.",
        "importance": "medium"
      },
      {
        "name": "Technical Knowledge",
        "description": "Proficiency in analytics tools and financial systems.",
        "importance": "medium"
      }
    ]
  },
  {
    "id": "F002",
    "name": "Leading Change",
    "weight": 0.108,
    "themes": [
      {
        "name": "Strategic Alignment",
        "description": "Driving financial plans that meet business objectives.",
        "importance": "high"
      },
      {
        "name": "Regulatory Compliance",
        "description": "Maintaining adherence to financial laws and audit requirements.",
        "importance": "high"
      }
    ]
  },
  {
    "id": "E002",
    "name": "Decision Making",
    "weight": 0.092,
    "themes": [
      {
        "name": "Financial Analysis",
        "description": "Delivering compliant and accurate financial insights.",
        "importance": "medium"
      },
      {
        "name": "Problem-Solving",
        "description": "Making sound decisions to enhance financial outcomes.",
        "importance": "medium"
      }
    ]
  },
  {
    "id": "L004",
    "name": "Empowering Others",
    "weight": 0.092,
    "themes": [
      {
        "name": "Leadership Skills",
        "description": "Guiding and nurturing the team for continuous growth.",
        "importance": "high"
      },
      {
        "name": "Team Growth",
        "description": "Improving team performance through engagement and development.",
        "importance": "low"
      }
    ]
  },
  {
    "id": "E004",
    "name": "Focus on Quality",
    "weight": 0.077,
    "themes": [
      {
        "name": "Compliance Standards",
        "description": "Ensuring adherence to all regulatory and audit requirements.",
        "importance": "high"
      }
    ]
  },
  {
    "id": "L007",
    "name": "Developing Talent",
    "weight": 0.065,
    "themes": [
      {
        "name": "Leadership",
        "description": "Fostering growth and continuous improvement within the team.",
        "importance": "high"
      },
      {
        "name": "Team Building",
        "description": "Enhancing engagement and meeting development goals.",
        "importance": "low"
      }
    ]
  },
  {
    "id": "C002",
    "name": "Effective Communication",
    "weight": 0.055,
    "themes": [
      {
        "name": "Influence",
        "description": "Strong communication skills to engage across all levels.",
        "importance": "medium"
      }
    ]
  },
  {
    "id": "C005",
    "name": "Information Analysis",
    "weight": 0.055,
    "themes": [
      {
        "name": "Strategic Insight",
        "description": "Analyzing data to align financial strategies with goals.",
        "importance": "high"
      }
    ]
  },
  {
    "id": "E006",
    "name": "Process Delivery",
    "weight": 0.055,
    "themes": [
      {
        "name": "Compliance Oversight",
        "description": "Ensuring effective processes meet regulatory requirements.",
        "importance": "high"
      }
    ]
  },
  {
    "id": "L001",
    "name": "Driving Innovation",
    "weight": 0.055,
    "themes": [
      {
        "name": "Leadership Focus",
        "description": "Inspiring a culture of improvement and innovation.",
        "importance": "high"
      }
    ]
  },
  {
    "id": "C001",
    "name": "Team Collaboration",
    "weight": 0.047,
    "themes": [
      {
        "name": "Communication",
        "description": "Encouraging effective team interaction and influence.",
        "importance": "medium"
      },
      {
        "name": "Team Support",
        "description": "Boosting team performance through shared goals.",
        "importance": "low"
      }
    ]
  }
]
');
    }
}
