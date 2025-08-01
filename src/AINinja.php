<?php

namespace IanRothmann\AINinja;

use IanRothmann\AINinja\Processors\AssessLanguageProcessor;
use IanRothmann\AINinja\Processors\AssessmentMatrixProcessor;
use IanRothmann\AINinja\Processors\CandidateStrengthShortcomingProcessor;
use IanRothmann\AINinja\Processors\DetectSpeechProcessor;
use IanRothmann\AINinja\Processors\DevelopmentPlanProcessor;
use IanRothmann\AINinja\Processors\EmbeddingsProcessor;
use IanRothmann\AINinja\Processors\ExtractCompetenciesProcessor;
use IanRothmann\AINinja\Processors\FaceImageProcessor;
use IanRothmann\AINinja\Processors\FileSummaryProcessor;
use IanRothmann\AINinja\Processors\GenerateJsonProcessor;
use IanRothmann\AINinja\Processors\GenerateTextProcessor;
use IanRothmann\AINinja\Processors\IdealResponseMultipleProcessor;
use IanRothmann\AINinja\Processors\IdealResponseRatingProcessor;
use IanRothmann\AINinja\Processors\ImageDescribeProcessor;
use IanRothmann\AINinja\Processors\IndexFileProcessor;
use IanRothmann\AINinja\Processors\IndustryClassificationProcessor;
use IanRothmann\AINinja\Processors\InterviewQualityProcessor;
use IanRothmann\AINinja\Processors\InterviewQuestionProbingProcessor;
use IanRothmann\AINinja\Processors\InterviewQuestionProcessor;
use IanRothmann\AINinja\Processors\InterviewReportProcessor;
use IanRothmann\AINinja\Processors\InterviewRequirementsCreateProcessor;
use IanRothmann\AINinja\Processors\JobDescriptionCreateProcessor;
use IanRothmann\AINinja\Processors\KeywordProcessor;
use IanRothmann\AINinja\Processors\MapDerivedCompetenciesProcessor;
use IanRothmann\AINinja\Processors\MenuBrandProcessor;
use IanRothmann\AINinja\Processors\MergeListProcessor;
use IanRothmann\AINinja\Processors\MultiTranscriptObservationsProcessor;
use IanRothmann\AINinja\Processors\NameSplitProcessor;
use IanRothmann\AINinja\Processors\OccupationClassificationProcessor;
use IanRothmann\AINinja\Processors\QueryCollectionProcessor;
use IanRothmann\AINinja\Processors\QuestionChatNavigatorProcessor;
use IanRothmann\AINinja\Processors\RefineConversationSummaryProcessor;
use IanRothmann\AINinja\Processors\ResumeProcessor;
use IanRothmann\AINinja\Processors\RoleProfileCreateProcessor;
use IanRothmann\AINinja\Processors\ScoringGuideCriteriaProcessor;
use IanRothmann\AINinja\Processors\ScoringGuideItemCreateProcessor;
use IanRothmann\AINinja\Processors\ScoringGuideItemRefineProcessor;
use IanRothmann\AINinja\Processors\ScoringGuideRatingProcessor;
use IanRothmann\AINinja\Processors\SearchCollectionProcessor;
use IanRothmann\AINinja\Processors\SlugProcessor;
use IanRothmann\AINinja\Processors\SuccessProfileProcessor;
use IanRothmann\AINinja\Processors\SummarizeContextProcessor;
use IanRothmann\AINinja\Processors\SummarizeTextProcessor;
use IanRothmann\AINinja\Processors\SummarizeTranscriptionProcessor;
use IanRothmann\AINinja\Processors\TagProcessor;
use IanRothmann\AINinja\Processors\TechnicalCompetencyQuestionProcessor;
use IanRothmann\AINinja\Processors\ThemeExtractionProcessor;
use IanRothmann\AINinja\Processors\TLDRProcessor;
use IanRothmann\AINinja\Processors\TranscribeURLProcessor;
use IanRothmann\AINinja\Processors\TranslateProcessor;
use IanRothmann\AINinja\Traits\CanRunBatches;

class AINinja
{
    use CanRunBatches;

    public function agent(): AINinjaAgent
    {
        return new AINinjaAgent;
    }

    public function generateJson(): GenerateJsonProcessor
    {
        return new GenerateJsonProcessor;
    }

    public function extractKeywords(): KeywordProcessor
    {
        return new KeywordProcessor;
    }

    public function writeInterviewReport(): InterviewReportProcessor
    {
        return new InterviewReportProcessor;
    }

    public function generateJobDescription(): JobDescriptionCreateProcessor
    {
        return new JobDescriptionCreateProcessor;
    }

    public function createSuccessProfile(): SuccessProfileProcessor
    {
        return new SuccessProfileProcessor;
    }

    public function generateRoleProfile(): RoleProfileCreateProcessor
    {
        return new RoleProfileCreateProcessor;
    }

    public function generateInterviewRequirements(): InterviewRequirementsCreateProcessor
    {
        return new InterviewRequirementsCreateProcessor;
    }

    public function embeddings(): EmbeddingsProcessor
    {
        return new EmbeddingsProcessor;
    }

    public function summarizeTLDR(): TLDRProcessor
    {
        return new TLDRProcessor;
    }

    public function createAssessmentMatrix(): AssessmentMatrixProcessor
    {
        return new AssessmentMatrixProcessor;
    }

    public function extractCompetencies(): ExtractCompetenciesProcessor
    {
        return new ExtractCompetenciesProcessor;
    }

    public function mapDerivedCompetencies(): MapDerivedCompetenciesProcessor
    {
        return new MapDerivedCompetenciesProcessor;
    }

    public function extractThemes(): ThemeExtractionProcessor
    {
        return new ThemeExtractionProcessor;
    }

    public function mergeLists(): MergeListProcessor
    {
        return new MergeListProcessor;
    }

    public function classifyIndustry(): IndustryClassificationProcessor
    {
        return new IndustryClassificationProcessor;
    }

    public function classifyOccupation(): OccupationClassificationProcessor
    {
        return new OccupationClassificationProcessor;
    }

    public function splitNamesAndSurnames(): NameSplitProcessor
    {
        return new NameSplitProcessor;
    }

    public function generateTechnicalCompetencyQuestions(): TechnicalCompetencyQuestionProcessor
    {
        return new TechnicalCompetencyQuestionProcessor;
    }

    public function summarizeTranscription(): SummarizeTranscriptionProcessor
    {
        return new SummarizeTranscriptionProcessor;
    }

    public function summarizeText(): SummarizeTextProcessor
    {
        return new SummarizeTextProcessor;
    }

    public function summarizeContext(): SummarizeContextProcessor
    {
        return new SummarizeContextProcessor;
    }

    public function translate(): TranslateProcessor
    {
        return new TranslateProcessor;
    }

    public function transcribeURL(): TranscribeURLProcessor
    {
        return new TranscribeURLProcessor;
    }

    public function detectSpeech(): DetectSpeechProcessor
    {
        return new DetectSpeechProcessor;
    }

    public function scoringGuideCreateRatingItems(): ScoringGuideItemCreateProcessor
    {
        return new ScoringGuideItemCreateProcessor;
    }

    public function scoringGuideRefineRatingItems(): ScoringGuideItemRefineProcessor
    {
        return new ScoringGuideItemRefineProcessor;
    }

    public function scoringGuideGenerateCriteria(): ScoringGuideCriteriaProcessor
    {
        return new ScoringGuideCriteriaProcessor;
    }

    public function scoringGuideRating(): ScoringGuideRatingProcessor
    {
        return new ScoringGuideRatingProcessor;
    }

    public function createDevelopmentPlan(): DevelopmentPlanProcessor
    {
        return new DevelopmentPlanProcessor;
    }

    public function assignTags(): TagProcessor
    {
        return new TagProcessor;
    }

    public function indexForQuery(): IndexFileProcessor
    {
        return new IndexFileProcessor;
    }

    public function queryCollections(): QueryCollectionProcessor
    {
        return new QueryCollectionProcessor;
    }

    public function searchCollections(): SearchCollectionProcessor
    {
        return new SearchCollectionProcessor;
    }

    public function assessLanguage(): AssessLanguageProcessor
    {
        return new AssessLanguageProcessor;
    }

    public function generateSlug(): SlugProcessor
    {
        return new SlugProcessor;
    }

    public function observationsFromTranscripts(): MultiTranscriptObservationsProcessor
    {
        return new MultiTranscriptObservationsProcessor;
    }

    public function refineConversationSummary(): RefineConversationSummaryProcessor
    {
        return new RefineConversationSummaryProcessor;
    }

    public function navigateQuestionChat(): QuestionChatNavigatorProcessor
    {
        return new QuestionChatNavigatorProcessor;
    }

    public function probeInterviewQuestion(): InterviewQuestionProbingProcessor
    {
        return new InterviewQuestionProbingProcessor;
    }

    public function generateInterviewQuestions(): InterviewQuestionProcessor
    {
        return new InterviewQuestionProcessor;
    }

    public function reviewInterviewQuality(): InterviewQualityProcessor
    {
        return new InterviewQualityProcessor;
    }

    public function describeImage(): ImageDescribeProcessor
    {
        return new ImageDescribeProcessor;
    }

    public function generateText(): GenerateTextProcessor
    {
        return new GenerateTextProcessor;
    }

    public function summarizeFile(): FileSummaryProcessor
    {
        return new FileSummaryProcessor;
    }

    public function analyzeResume(): ResumeProcessor
    {
        return new ResumeProcessor;
    }

    public function processFaceImage(): FaceImageProcessor
    {
        return new FaceImageProcessor;
    }

    public function processMenusForBrands(): MenuBrandProcessor
    {
        return new MenuBrandProcessor;
    }

    public function generateIdealResponses(): IdealResponseMultipleProcessor
    {
        return new IdealResponseMultipleProcessor;
    }

    public function generateIdealResponseRating(): IdealResponseRatingProcessor
    {
        return new IdealResponseRatingProcessor;
    }

    public function generateStrengthShortcomingsForRatedInterview(): CandidateStrengthShortcomingProcessor
    {
        return new CandidateStrengthShortcomingProcessor;
    }
}
