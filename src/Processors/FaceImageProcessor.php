<?php

namespace IanRothmann\AINinja\Processors;

use IanRothmann\AINinja\Processors\Traits\OutputsInLanguage;
use IanRothmann\AINinja\Results\AINinjaFaceImageResult;

class FaceImageProcessor extends AIninjaProcessor
{
    use OutputsInLanguage;

    protected function getEndpoint(): string
    {
        return '/face_image';
    }

    protected function getResultClass(): string
    {
        return AINinjaFaceImageResult::class;
    }

    protected function getMocked(): mixed
    {
        return [
            'error' => null,
            'description' => 'The person is a man who appears muscular and fit, photographed against a neutral background. He has short, textured hair and a neatly groomed beard. He is wearing a green and gold rugby jersey, which suggests he might be an athlete, possibly linked to a team represented by these colors. His expression is serious and poised, conveying a sense of confidence and determination.',
            'complement' => 'You look incredibly strong and focused, definitely someone who brings his A-game on and off the field! Keep shining with that confidence!',
        ];
    }

    public function forUrl(string $url): self
    {
        $this->setInputParameter('url', $url);

        return $this;
    }

    public function withContext(bool $value = true): self
    {
        $this->setInputParameter('context', $value);

        return $this;
    }

    public function withDescription(bool $value = true): self
    {
        $this->setInputParameter('describe', $value);

        return $this;
    }

    public function withComplement(bool $value = true): self
    {
        $this->setInputParameter('complement', $value);

        return $this;
    }

    public function getValidationRules(): array
    {
        return [
            'url' => 'required|url',
        ];
    }

    public function get(): AINinjaFaceImageResult
    {
        return parent::get();
    }

    public function stream($callback = null): AINinjaFaceImageResult
    {
        return parent::stream($callback);
    }
}
