<?php

namespace IanRothmann\AINinja\Processors;

use IanRothmann\AINinja\Processors\Traits\OutputsAsHtml;
use IanRothmann\AINinja\Processors\Traits\OutputsInLanguage;
use IanRothmann\AINinja\Results\AINinjaInterviewReportResult;

class InterviewReportProcessor extends AINinjaProcessor
{
    use OutputsAsHtml;
    use OutputsInLanguage;

    protected function getEndpoint(): string
    {
        return '/get_interview_report';
    }

    protected function getResultClass(): string
    {
        return AINinjaInterviewReportResult::class;
    }

    public function withContext(string $context): self
    {
        $this->setInputParameter('context', $context);

        return $this;
    }

    public function givenQuestionAndAnswer(string $question, ?string $answer = null): self
    {
        $this->addToInputArray('transcript', [
            $question => $answer,
        ]);

        return $this;
    }

    public function givenRequirements(string $requirements): self
    {
        $this->setInputParameter('job_description', $requirements);

        return $this;
    }

    public function transformInputForTransport(): array
    {
        $input = parent::transformInputForTransport();
        $input['transcript'] = json_encode($input['transcript']);

        return $input;
    }

    protected function getValidationRules(): array
    {
        return [
            'job_description' => 'required|string',
            'context' => 'required|string',
            'transcript' => 'required|array',
        ];
    }

    public function get(): AINinjaInterviewReportResult
    {
        return parent::get();
    }

    public function stream($callback = null): AINinjaInterviewReportResult
    {
        return parent::stream($callback);
    }

    protected function getMocked(): string
    {
        return 'Ian Rothmann, a candidate for the Data Scientist position, brings a notable 15 years of experience in the field, emphasizing his passion for leveraging artificial intelligence (AI) and machine learning (ML) to enhance business value. His introduction during the asynchronous interview via a chatbot underscores his enthusiasm for applying his expertise to solve complex business problems, providing a brief insight into his professional demeanor and communication skills. Ian mentioned a specific instance where he utilized his skills to analyze customer support calls in real-time, which helped a company provide valuable feedback to their support agency. This example, although briefly touched upon, hints at his capability to drive results and add value through practical applications of AI and ML in a business context.';
    }
}
