<?php

namespace IanRothmann\AINinja\Results\Agent;

use IanRothmann\AINinja\Processors\Agents\Run\AINinjaRunResult;

class AINinjaAgentProfilePictureResult extends AINinjaRunResult
{
    public function getImageUrl(): ?string
    {
        return collect($this->result)->get('image_url');
    }

    public function hasImage(): bool
    {
        return ! empty($this->getImageUrl());
    }

    public function getImageExtension(): ?string
    {
        $imageUrl = $this->getImageUrl();
        if (! $imageUrl) {
            return null;
        }

        $pathInfo = pathinfo(parse_url($imageUrl, PHP_URL_PATH));

        return $pathInfo['extension'] ?? null;
    }

    public function isImageType(string $type): bool
    {
        $extension = $this->getImageExtension();
        if (! $extension) {
            return false;
        }

        $imageTypes = [
            'jpg' => ['jpg', 'jpeg'],
            'png' => ['png'],
            'gif' => ['gif'],
            'webp' => ['webp'],
        ];

        foreach ($imageTypes as $category => $extensions) {
            if ($type === $category && in_array(strtolower($extension), $extensions)) {
                return true;
            }
        }

        return false;
    }
}
