<?php

namespace IanRothmann\AINinja\Processors;

use IanRothmann\AINinja\Results\AINinjaVoiceOverResult;

class VoiceOverProcessor extends AINinjaProcessor
{
    public const VOICE_FITT = 'vgDhLaIMDYDkUp5Yh3mU';

    public const VOICE_UK_MALE = 'lUTamkMw7gOzZbFIwmq4';

    public const VOICE_UK_FEMALE = 'ZtcPZrt9K4w8e1OB9M6w';

    public const VOICE_US_FEMALE = 'uYXf8XasLslADfZ2MB4u';

    public const VOICE_US_MALE = 'TX3LPaxmHKxFdv7VOQHJ';

    public const VOICE_UAE_FEMALE = 'aCChyB4P5WEomwRsOKRh';

    protected function getEndpoint(): string
    {
        return '/generate_voice_over';
    }

    protected function getResultClass(): string
    {
        return AINinjaVoiceOverResult::class;
    }

    protected function getMocked(): array
    {
        return [
            'subtitles' => [
                'subtitles' => [
                    [
                        'text' => 'Hello world',
                        'start' => 0.0,
                        'end' => 2.5,
                    ],
                    [
                        'text' => 'This is a test',
                        'start' => 2.5,
                        'end' => 5.0,
                    ],
                ],
            ],
            'audio_b64' => 'UklGRnoGAABXQVZFZm10IBAAAAABAAEAQB8AAEAfAAABAAgAZGF0YQoGAACBhYqFbF1fdJivrJBhNjVgodDbq2EcBj+a2/LDciUFLIHO8tiJNwgZaLvt559NEAxQp+PwtmMcBjiR1/LMeSwFJHfH8N2QQAoUX7ztvmIeBA==',
        ];
    }

    public function withText(string $text): self
    {
        $this->setInputParameter('text', strip_tags($text));

        return $this;
    }

    public function withVoice(?string $voice): self
    {
        if ($voice !== null) {
            $this->setInputParameter('voice', $voice);
        } else {
            $this->setInputParameter('voice', self::VOICE_FITT);
        }

        return $this;
    }

    public function __construct()
    {
        parent::__construct();
        $this->setInputParameter('voice', self::VOICE_FITT);
    }

    protected function getValidationRules(): array
    {
        $validVoices = [
            self::VOICE_FITT,
            self::VOICE_UK_MALE,
            self::VOICE_UK_FEMALE,
            self::VOICE_US_FEMALE,
            self::VOICE_US_MALE,
            self::VOICE_UAE_FEMALE,
        ];

        return [
            'text' => 'required|string',
            'voice' => 'required|string|in:'.implode(',', $validVoices),
        ];
    }

    public function get(): AINinjaVoiceOverResult
    {
        return parent::get();
    }

    public function stream($callback = null): AINinjaVoiceOverResult
    {
        return parent::stream($callback);
    }
}
