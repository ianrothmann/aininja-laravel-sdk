<?php

namespace IanRothmann\AINinja\Processors;

use IanRothmann\AINinja\Processors\Traits\OutputsInLanguage;
use IanRothmann\AINinja\Results\AINinjaSummarizeTranscriptionResult;

class SummarizeTranscriptionProcessor extends AINinjaProcessor
{
    use OutputsInLanguage;

    protected function getEndpoint(): string
    {
        return '/summarize_transcription';
    }

    protected function getResultClass(): string
    {
        return AINinjaSummarizeTranscriptionResult::class;
    }

    protected function getMocked()
    {
        return "Ian Rothmann is a data scientist with 15 years of experience who is passionate about applying AI and machine learning solutions to add value to organizations. He has used his skills to solve business problems, such as evaluating customer support calls in real-time to provide developmental feedback. While he didn't provide specific examples, he confirmed his extensive experience in using machine learning and AI to drive business results. If faced with a predictive model that isn't delivering desired outcomes, Ian would first humorously request the model to improve, then gather more data, try different models, and persist with the process. Communication with stakeholders is key in diagnosing and addressing issues with the model. Ian prefers GPT-4 as the better LLM and did not provide a research paper for publication.";
    }

    public function basedOn(string $text): self
    {
        $this->setInputParameter('text', $text);

        return $this;
    }

    public function forName(string $name): self
    {
        $this->setInputParameter('name', $name);

        return $this;
    }

    public function withGender(string $gender): self
    {
        $this->setInputParameter('gender', $gender);

        return $this;
    }

    protected function getValidationRules(): array
    {
        return [
            'text' => 'required|string',
            'name' => 'required|string',
            'gender' => 'sometimes|string',
        ];
    }

    public function get(): AINinjaSummarizeTranscriptionResult
    {
        return parent::get();
    }

    public function stream($callback = null): AINinjaSummarizeTranscriptionResult
    {
        return parent::stream($callback);
    }
}
