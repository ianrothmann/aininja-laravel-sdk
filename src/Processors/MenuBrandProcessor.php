<?php

namespace IanRothmann\AINinja\Processors;

use IanRothmann\AINinja\Results\AINinjaMenuBrandResult;

class MenuBrandProcessor extends AINinjaProcessor
{
    protected function getEndpoint(): string
    {
        return '/menu_brand';
    }

    protected function getResultClass(): string
    {
        return AINinjaMenuBrandResult::class;
    }

    protected function getMocked()
    {
        $content = <<<TOC
{
  "total_brands_found": "20",
  "total_tracked_brands_found": "10",
  "overall_representation": 0.5,
  "tracked_brands_found": [
    {
      "brand_name": "Klipdrift",
      "brand_count": 3
    },
    {
      "brand_name": "Jameson",
      "brand_count": 4
    },
    {
      "brand_name": "Clase Azul",
      "brand_count": 1
    },
    {
      "brand_name": "Johnny Walker",
      "brand_count": 6
    }
  ],
  "all_brands_found": [
    "Johnny Walker Black",
    "Johnny Walker Gold",
    "Johnny Walker Green Label",
    "Johnny Walker Platinum 18 Year Old",
    "Johnny Walker Blue",
    "Jameson",
    "Don Julio",
    "Clase Azul Reposado Tequila"
  ],
  "errors": []
}

TOC;

        return json_decode($content,true);
    }

    public function addUrl(string $url): self
    {
        $this->addToInputArray('image_urls', $url);

        return $this;
    }

    public function trackBrand(string $brandName): self
    {
        $this->addToInputArray('brands', $brandName);

        return $this;
    }

    public function getValidationRules(): array
    {
        return [
            'image_urls' => 'required|array',
            'image_urls.*' => 'url',
            'brands' => 'required|array',
            'brands.*' => 'string',
        ];
    }

    public function get(): AINinjaMenuBrandResult
    {
        return parent::get();
    }

    public function stream($callback = null): AINinjaMenuBrandResult
    {
        return parent::stream($callback);
    }
}
