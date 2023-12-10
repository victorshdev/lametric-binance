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
        ];
    }
}
