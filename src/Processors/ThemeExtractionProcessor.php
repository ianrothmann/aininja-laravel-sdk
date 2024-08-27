<?php

namespace IanRothmann\AINinja\Processors;

use IanRothmann\AINinja\Results\AINinjaThemeExtractionResult;

class ThemeExtractionProcessor extends AINinjaProcessor
{

    public function __construct()
    {
        parent::__construct();
        $this->input['num_dimensions'] = 10;
        $this->input['upper_bound_clusters'] = 20;
        $this->input['lower_bound_clusters'] = 2;
    }

    protected function getEndpoint(): string
    {
        return '/theme_extractor';
    }

    protected function getResultClass(): string
    {
        return AINinjaThemeExtractionResult::class;
    }

    public function fromText($text)
    {
        $this->setInputParameter('input_type','string');
        $this->setInputParameter('input',$text);
        return $this;
    }

    public function fromUrl($url)
    {
        $this->setInputParameter('input_type','url');
        $this->setInputParameter('input',$url);
        return $this;
    }

    public function fromDocuments(array $documents=null)
    {
        $this->setInputParameter('input_type','json');
        $this->setInputParameter('input',[
            'docs' => $documents
        ]);
        return $this;
    }

    public function extractNumberOfClustersBetween($min, $max)
    {
        $this->setInputParameter('lower_bound_clusters',$min);
        $this->setInputParameter('upper_bound_clusters',$max);
        return $this;
    }

    public function overrideDimensionReductionTo($num_dimensions)
    {
        $this->setInputParameter('num_dimensions',$num_dimensions);
        return $this;
    }

    protected function getValidationRules(): array
    {
        $rules = [
            'input_type' => 'required|in:string,url,json',
            'num_dimensions' => 'required|numeric',
            'upper_bound_clusters' => 'required|numeric|gte:lower_bound_clusters',
            'lower_bound_clusters' => 'required|numeric|lte:upper_bound_clusters',
            'input' => 'required'
        ];

        return $rules;
    }

    public function get(): AINinjaThemeExtractionResult
    {
        return parent::get();
    }

    public function stream($callback = null): AINinjaThemeExtractionResult
    {
        return parent::stream($callback);
    }

    protected function getMocked()
    {
        return json_decode(<<<TOC
{
  "themes": [
    {
      "name": "Missed Collaborations",
      "summary": "Freeman J. Dyson highlights the historical separation between mathematics and physics, emphasizing missed opportunities that could have advanced theoretical physics. He advocates for better interdisciplinary communication to avoid past mistakes and accelerate progress, citing influential figures like Hilbert and Minkowski."
    },
    {
      "name": "Interdisciplinary Progress",
      "summary": "Dyson discusses how poor communication between mathematicians and physicists has hindered progress in both fields, using personal anecdotes and historical examples like the T-function. He emphasizes the potential for future discoveries through collaboration."
    },
    {
      "name": "Academic Opportunities",
      "summary": "The text highlights missed opportunities in mathematics and physics due to their separation. Dyson reflects on personal experiences and historical examples, stressing the need for interdisciplinary communication to advance both fields."
    }
  ],
  "overall_summary": "Freeman J. Dyson's lecture emphasizes the missed collaborative opportunities between mathematics and physics that could have advanced theoretical physics. He underscores the importance of interdisciplinary communication to avoid past mistakes and foster significant discoveries."
}
TOC
,true);
    }
}
