<?php

namespace IanRothmann\AINinja\Processors;

use IanRothmann\AINinja\Processors\Traits\OutputsInLanguage;
use IanRothmann\AINinja\Results\AINinjaResult;
use Illuminate\Support\Collection;

class InterviewReportProcessor extends AINinjaProcessor
{
    use OutputsInLanguage;

    protected function getEndpoint(): string
    {
        return 'get_interview_report';
    }

    protected function getResultClass(): string
    {
        return AINinjaResult::class;
    }

    public function withContext($context): self
    {
        if(is_array($context)){
            $context=json_encode($context);
        }

        $this->setInputParameter('context',$context);
        return $this;
    }

    public function forInterviewTranscript(array $questionsAndAnswersArray): self
    {
        $transcript=json_encode($questionsAndAnswersArray);
        $this->setInputParameter('transcript',$transcript);
        return $this;
    }

    public function givenRequirements(string $requirements): self
    {
        $this->setInputParameter('job_description',$requirements);
        return $this;
    }

    public function get(): AINinjaResult
    {
        return parent::get();
    }

    protected function getMocked(): string
    {
        return 'Ian Rothmann, a candidate for the Data Scientist position, brings a notable 15 years of experience in the field, emphasizing his passion for leveraging artificial intelligence (AI) and machine learning (ML) to enhance business value. His introduction during the asynchronous interview via a chatbot underscores his enthusiasm for applying his expertise to solve complex business problems, providing a brief insight into his professional demeanor and communication skills. Ian mentioned a specific instance where he utilized his skills to analyze customer support calls in real-time, which helped a company provide valuable feedback to their support agency. This example, although briefly touched upon, hints at his capability to drive results and add value through practical applications of AI and ML in a business context.';
    }
}
