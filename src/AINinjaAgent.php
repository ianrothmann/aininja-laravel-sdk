<?php

namespace IanRothmann\AINinja;

use IanRothmann\AINinja\Processors\Agents\AssessmentMatrixAgent;
use IanRothmann\AINinja\Processors\Agents\CareerAspirationExtractorAgent;
use IanRothmann\AINinja\Processors\Agents\CompetencyDevelopmentCuratorAgent;
use IanRothmann\AINinja\Processors\Agents\CreateDubAgent;
use IanRothmann\AINinja\Processors\Agents\DevelopmentAreasExtractorAgent;
use IanRothmann\AINinja\Processors\Agents\ExperienceDriversScriptGeneratorAgent;
use IanRothmann\AINinja\Processors\Agents\FittGrowInitialisationAgent;
use IanRothmann\AINinja\Processors\Agents\GenerateFeedbackVideoAgent;
use IanRothmann\AINinja\Processors\Agents\IdpCreatorAgent;
use IanRothmann\AINinja\Processors\Agents\IdpFromLibraryCreatorAgent;
use IanRothmann\AINinja\Processors\Agents\ImageGeneratorAgent;
use IanRothmann\AINinja\Processors\Agents\InstrumentInterpretationProcessorAgent;
use IanRothmann\AINinja\Processors\Agents\NewsGeneratorAgent;
use IanRothmann\AINinja\Processors\Agents\PersonalityScriptGeneratorAgent;
use IanRothmann\AINinja\Processors\Agents\ProfileInfoExtractorAgent;
use IanRothmann\AINinja\Processors\Agents\ProfilePictureAgent;
use IanRothmann\AINinja\Processors\Agents\ProfileStrengthExtractorAgent;
use IanRothmann\AINinja\Processors\Agents\StoryboardGeneratorAgent;
use IanRothmann\AINinja\Processors\Agents\SuccessProfileMatcherAgent;

class AINinjaAgent
{
    public function generateFeedbackVideo(): GenerateFeedbackVideoAgent
    {
        return new GenerateFeedbackVideoAgent;
    }

    public function createDub(): CreateDubAgent
    {
        return new CreateDubAgent;
    }

    public function generateNews(): NewsGeneratorAgent
    {
        return new NewsGeneratorAgent;
    }

    public function generateImage(): ImageGeneratorAgent
    {
        return new ImageGeneratorAgent;
    }

    public function createAssessmentMatrix(): AssessmentMatrixAgent
    {
        return new AssessmentMatrixAgent;
    }

    public function generateProfilePicture(): ProfilePictureAgent
    {
        return new ProfilePictureAgent;
    }

    public function curateCompetencyDevelopment(): CompetencyDevelopmentCuratorAgent
    {
        return new CompetencyDevelopmentCuratorAgent;
    }

    public function createIdpFromLibrary(): IdpFromLibraryCreatorAgent
    {
        return new IdpFromLibraryCreatorAgent;
    }

    public function createIdp(): IdpCreatorAgent
    {
        return new IdpCreatorAgent;
    }

    public function matchSuccessProfiles(): SuccessProfileMatcherAgent
    {
        return new SuccessProfileMatcherAgent;
    }

    public function extractCareerAspirations(): CareerAspirationExtractorAgent
    {
        return new CareerAspirationExtractorAgent;
    }

    public function extractDevelopmentAreas(): DevelopmentAreasExtractorAgent
    {
        return new DevelopmentAreasExtractorAgent;
    }

    public function extractProfileStrengths(): ProfileStrengthExtractorAgent
    {
        return new ProfileStrengthExtractorAgent;
    }

    public function extractProfileInfo(): ProfileInfoExtractorAgent
    {
        return new ProfileInfoExtractorAgent;
    }

    public function generateExperienceDriversScript(): ExperienceDriversScriptGeneratorAgent
    {
        return new ExperienceDriversScriptGeneratorAgent;
    }

    public function generatePersonalityScript(): PersonalityScriptGeneratorAgent
    {
        return new PersonalityScriptGeneratorAgent;
    }

    public function interpretInstruments(): InstrumentInterpretationProcessorAgent
    {
        return new InstrumentInterpretationProcessorAgent;
    }

    public function initialiseFittGrow(): FittGrowInitialisationAgent
    {
        return new FittGrowInitialisationAgent;
    }

    public function generateStoryboard(): StoryboardGeneratorAgent
    {
        return new StoryboardGeneratorAgent;
    }
}
