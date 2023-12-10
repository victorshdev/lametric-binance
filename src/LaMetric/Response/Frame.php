<?php

declare(strict_types=1);

namespace LaMetric\Response;

class Frame implements IFrame
{
    /**
     * @var string
     */
    private string $icon = '';

    private string $text = '';
    private int $index = 0;

    public function getIcon(): string
    {
        return $this->icon;
    }

    public function setIcon(string $icon): Frame
    {
        $this->icon = $icon;
        return $this;
    }

    public function getText(): string
    {
        return $this->text;
    }

    public function setText(string $text): Frame
    {
        $this->text = $text;
        return $this;
    }

    public function toArray(): array
    {
        return [
            'icon' => $this->getIcon(),
            'text' => $this->getText(),
            'index' => $this->getIndex(),
        ];
    }

    public function setIndex(int $index): static
    {
        $this->index = $index;
        return $this;
    }

    public function getIndex(): int
    {
        return $this->index;
    }
}
