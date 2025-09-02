<?php

namespace IanRothmann\AINinja;

use IanRothmann\AINinja\Processors\Agents\AssessmentMatrixAgent;
use IanRothmann\AINinja\Processors\Agents\CreateDubAgent;
use IanRothmann\AINinja\Processors\Agents\GenerateFeedbackVideoAgent;
use IanRothmann\AINinja\Processors\Agents\ImageGeneratorAgent;
use IanRothmann\AINinja\Processors\Agents\NewsGeneratorAgent;
use IanRothmann\AINinja\Processors\Agents\ProfilePictureAgent;

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
}
