<?php

namespace IanRothmann\AINinja\Processors;

use IanRothmann\AINinja\Results\AINinjaTagResult;

class TagProcessor extends AINinjaProcessor
{
    protected function getEndpoint(): string
    {
        return '/tag_assign';
    }

    protected function getResultClass(): string
    {
        return AINinjaTagResult::class;
    }

    protected function getMocked(): array
    {
        $json = <<<'TOC'
{
  "output": [
    {
      "category_id": "2",
      "tag_ids": ["f"]
    }
  ]
}

TOC;

        return json_decode($json, true);
    }

    public function basedOn(string $text): self
    {
        $this->setInputParameter('text', $text);

        return $this;
    }

    public function addCategory($id, $name): self
    {
        $this->addToInputArray('tag_categories', [
            'category_id' => $id,
            'category_name' => $name,
            'tags' => [],
        ]);

        return $this;
    }

    public function addTag($categoryId, $tagId, $tagName): self
    {
        if (! array_key_exists('tag_categories', $this->input)) {
            throw new \Exception('Tag categories must be added before adding actions');
        }
        $categories = collect($this->input['tag_categories'])->where('category_id', $categoryId);

        if ($categories->count() == 0) {
            throw new \Exception('Tag category with id '.$categoryId.' not found');
        }

        $categoryKey = $categories->keys()->first();
        $category = $categories->first();

        $category['tags'][] = [
            'tag_id' => $tagId,
            'tag_name' => $tagName,
        ];

        $this->input['tag_categories'][$categoryKey] = $category;

        return $this;
    }

    protected function getValidationRules(): array
    {
        return [
            'text' => 'required|string',
            'tag_categories' => 'required|array',
            'tag_categories.*.category_id' => 'required',
            'tag_categories.*.category_name' => 'required|string',
            'tag_categories.*.tags' => 'required|array',
            'tag_categories.*.tags.*.tag_id' => 'required',
            'tag_categories.*.tags.*.tag_name' => 'required',
        ];
    }

    public function get(): AINinjaTagResult
    {
        return parent::get();
    }

    public function stream($callback = null): AINinjaTagResult
    {
        return parent::stream($callback);
    }
}
