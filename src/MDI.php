<?php

namespace yii\mdi;

class MDI extends Icon
{
    public static function i(
        string  $icon,
        ?string $content = null,
        ?int    $size = null,
        ?int    $rotate = null,
        ?string $flip = null,
        ?string $color = null,
        bool    $inactive = false,
        bool    $spin = false,
    ): self
    {
        return new self($icon, $content, $size, $rotate, $flip, $color, $inactive, $spin);
    }

    public static function icon(
        string  $icon,
        ?string $content = null,
        ?int    $size = null,
        ?int    $rotate = null,
        ?string $flip = null,
        ?string $color = null,
        bool    $inactive = false,
        bool    $spin = false,
    ): self
    {
        return self::i($icon, $content, $size, $rotate, $flip, $color, $inactive, $spin);
    }

    public static function s(
        string  $icon,
        ?string $content = null,
        ?int    $size = null,
        ?int    $rotate = null,
        ?string $flip = null,
        ?string $color = null,
        bool    $inactive = false,
        bool    $spin = false,
    ): self
    {
        $icon = new self($icon, $content, $size, $rotate, $flip, $color, $inactive, $spin);
        $icon->tagSpan();
        return $icon;
    }

    public static function span(
        string  $icon,
        ?string $content = null,
        ?int    $size = null,
        ?int    $rotate = null,
        ?string $flip = null,
        ?string $color = null,
        bool    $inactive = false,
        bool    $spin = false,
    ): self
    {
        return self::s($icon, $content, $size, $rotate, $flip, $color, $inactive, $spin);
    }


}