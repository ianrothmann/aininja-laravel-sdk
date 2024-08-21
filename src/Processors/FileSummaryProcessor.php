<?php

namespace IanRothmann\AINinja\Processors;

use IanRothmann\AINinja\Processors\Traits\OutputsInLanguage;
use IanRothmann\AINinja\Results\AINinjaFileSummaryResult;

class FileSummaryProcessor extends AINinjaProcessor
{
    use OutputsInLanguage;

    protected function getEndpoint(): string
    {
        return '/get_file_summary';
    }

    protected function getResultClass(): string
    {
        return AINinjaFileSummaryResult::class;
    }

    protected function getMocked()
    {
        return [
            'summary' => "The document discusses missed opportunities in the field of mathematics, focusing on instances where mathematicians and physicists failed to collaborate effectively. It highlights examples such as the lack of interest among mathematicians in James Clerk Maxwell's laws of electromagnetism and the failure to unify concepts like quaternions and vectors. The paper also presents open opportunities, including creating a mathematical structure preserving the main features of Haag-Kastler axioms but possessing general coordinate invariance, and achieving a rigorous definition of Feynman sums in nontrivial P-invariant theories.",
            'complement' => 'You are challenged to address the open opportunities in mathematics to advance the field, such as creating a mathematical structure with general coordinate invariance and achieving a rigorous definition of Feynman sums in nontrivial P-invariant theories.',
        ];
    }

    public function forUrl(string $url): self
    {
        $this->setInputParameter('url', $url);

        return $this;
    }

    public function withContext(string $context): self
    {
        $this->setInputParameter('context', $context);

        return $this;
    }

    public function getValidationRules(): array
    {
        return [
            'url' => 'required|url',
        ];
    }

    public function get(): AINinjaFileSummaryResult
    {
        return parent::get();
    }

    public function stream($callback = null): AINinjaFileSummaryResult
    {
        return parent::stream($callback);
    }
}
