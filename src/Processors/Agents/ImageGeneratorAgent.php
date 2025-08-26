<?php

namespace IanRothmann\AINinja\Processors\Agents;

use IanRothmann\AINinja\Processors\Agents\Run\AINinjaAgentRun;
use IanRothmann\AINinja\Results\Agent\AINinjaAgentImageGeneratorResult;

class ImageGeneratorAgent extends AINinjaAgent
{
    public const STYLE_PHOTOREALISTIC = 'photorealistic';

    public const STYLE_CINEMATIC = 'cinematic';

    public const STYLE_HYPERREALISTIC = 'hyperrealistic';

    public const STYLE_SURREAL = 'surreal';

    public const STYLE_DAYLIGHT_REALISM = 'daylight realism';

    protected function getEndpoint(): string
    {
        return '/agent_image_generator';
    }

    public function getResultClass(): string
    {
        return AINinjaAgentImageGeneratorResult::class;
    }

    public function getMocked(): array
    {
        return [
            'image_url' => 'https://example.com/generated-image.jpg',
        ];
    }

    public function withInstruction(string $instruction): self
    {
        $this->setInputParameter('instruction', strip_tags($instruction));

        return $this;
    }

    public function withStyle(string $style): self
    {
        $this->setInputParameter('style', $style);

        return $this;
    }

    public function addInputImage(string $url, string $context): self
    {
        $inputImage = [
            'url' => $url,
            'context' => strip_tags($context),
        ];

        $this->addToInputArray('input_images', $inputImage);

        return $this;
    }

    public function withInputImages(?array $inputImages): self
    {
        if ($inputImages !== null) {
            $this->setInputParameter('input_images', $inputImages);
        }

        return $this;
    }

    protected function transformInputForTransport(): array
    {
        $input = $this->input;

        if (! isset($input['input_images'])) {
            $input['input_images'] = [];
        }

        return $input;
    }

    protected function getValidationRules(): array
    {
        $validStyles = [
            self::STYLE_PHOTOREALISTIC,
            self::STYLE_CINEMATIC,
            self::STYLE_HYPERREALISTIC,
            self::STYLE_SURREAL,
            self::STYLE_DAYLIGHT_REALISM,
        ];

        return [
            'instruction' => 'required|string',
            'style' => 'required|string|in:'.implode(',', $validStyles),
            'input_images' => 'nullable|array',
            'input_images.*.url' => 'required_with:input_images|string|url',
            'input_images.*.context' => 'required_with:input_images|string',
        ];
    }

    public function runAndWait($waitIntervalSeconds = null): AINinjaAgentImageGeneratorResult
    {
        return parent::runAndWait($waitIntervalSeconds);
    }

    public function retrieveRunResult(AINinjaAgentRun $run): AINinjaAgentImageGeneratorResult
    {
        return parent::retrieveRunResult($run);
    }
}
