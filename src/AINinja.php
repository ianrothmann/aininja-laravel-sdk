<?php

namespace IanRothmann\AINinja;

use IanRothmann\AINinja\Processors\FaceImageProcessor;
use IanRothmann\AINinja\Processors\FileSummaryProcessor;
use IanRothmann\AINinja\Processors\GenerateJsonProcessor;
use IanRothmann\AINinja\Processors\GenerateTextProcessor;
use IanRothmann\AINinja\Processors\ImageDescribeProcessor;
use IanRothmann\AINinja\Processors\InterviewQualityProcessor;
use IanRothmann\AINinja\Processors\InterviewQuestionProbingProcessor;
use IanRothmann\AINinja\Processors\InterviewQuestionProcessor;
use IanRothmann\AINinja\Processors\InterviewReportProcessor;
use IanRothmann\AINinja\Processors\JobDescriptionCreateProcessor;
use IanRothmann\AINinja\Processors\QuestionChatNavigatorProcessor;
use IanRothmann\AINinja\Processors\RefineConversationSummaryProcessor;
use IanRothmann\AINinja\Processors\SlugProcessor;
use IanRothmann\AINinja\Processors\SummarizeContextProcessor;
use IanRothmann\AINinja\Processors\SummarizeTextProcessor;
use IanRothmann\AINinja\Processors\SummarizeTranscriptionProcessor;
use IanRothmann\AINinja\Processors\TLDRProcessor;
use IanRothmann\AINinja\Processors\TranscribeURLProcessor;
use IanRothmann\AINinja\Processors\TranslateProcessor;
use IanRothmann\AINinja\Traits\CanRunBatches;

class AINinja
{
    use CanRunBatches;

    public function generateJson(): GenerateJsonProcessor
    {
        return new GenerateJsonProcessor();
    }

    public function writeInterviewReport(): InterviewReportProcessor
    {
        return new InterviewReportProcessor();
    }

    public function generateJobDescription(): JobDescriptionCreateProcessor
    {
        return new JobDescriptionCreateProcessor();
    }

    public function summarizeTLDR(): TLDRProcessor
    {
        return new TLDRProcessor();
    }

    public function summarizeTranscription(): SummarizeTranscriptionProcessor
    {
        return new SummarizeTranscriptionProcessor();
    }

    public function summarizeText(): SummarizeTextProcessor
    {
        return new SummarizeTextProcessor();
    }

    public function summarizeContext(): SummarizeContextProcessor
    {
        return new SummarizeContextProcessor();
    }

    public function translate(): TranslateProcessor
    {
        return new TranslateProcessor();
    }

    public function transcribeURL(): TranscribeURLProcessor
    {
        return new TranscribeURLProcessor();
    }

    public function generateSlug(): SlugProcessor
    {
        return new SlugProcessor();
    }

    public function refineConversationSummary(): RefineConversationSummaryProcessor
    {
        return new RefineConversationSummaryProcessor();
    }

    public function navigateQuestionChat(): QuestionChatNavigatorProcessor
    {
        return new QuestionChatNavigatorProcessor();
    }

    public function probeInterviewQuestion(): InterviewQuestionProbingProcessor
    {
        return new InterviewQuestionProbingProcessor();
    }

    public function generateInterviewQuestions(): InterviewQuestionProcessor
    {
        return new InterviewQuestionProcessor();
    }

    public function reviewInterviewQuality(): InterviewQualityProcessor
    {
        return new InterviewQualityProcessor();
    }

    public function describeImage(): ImageDescribeProcessor
    {
        return new ImageDescribeProcessor();
    }

    public function generateText(): GenerateTextProcessor
    {
        return new GenerateTextProcessor();
    }

    public function summarizeFile(): FileSummaryProcessor
    {
        return new FileSummaryProcessor();
    }

    public function processFaceImage(): FaceImageProcessor
    {
        return new FaceImageProcessor();
    }
}
