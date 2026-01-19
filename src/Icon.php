<?php

namespace yii\mdi;

use yii\helpers\Html;
use function array_filter;
use function array_merge;
use function array_unique;
use function implode;
use function str_starts_with;
use function strlen;
use function strtolower;
use function substr;

/**
 * @method self size18()
 * @method self size24()
 * @method self size36()
 * @method self size48()
 * @method self flipV()
 * @method self flipH()
 * @method self rotate45()
 * @method self rotate90()
 * @method self rotate135()
 * @method self rotate180()
 * @method self rotate225()
 * @method self rotate270()
 * @method self rotate315()
 * @method self colorDark()
 * @method self colorLight()
 * @method self tagI()
 * @method self tagSpan()
 */
abstract class Icon
{
    public const TAG_I = 'i';
    public const TAG_SPAN = 'span';
    protected const BASE_CLASS = 'mdi';
    public const SIZE_18 = 18;
    public const SIZE_24 = 24;
    public const SIZE_36 = 36;
    public const SIZE_48 = 48;
    private const ROTATE_CLASS = 'rotate';
    public const DEGREES_45 = 45;
    public const DEGREES_90 = 90;
    public const DEGREES_135 = 135;
    public const DEGREES_180 = 180;
    public const DEGREES_225 = 225;
    public const DEGREES_270 = 270;
    public const DEGREES_315 = 315;
    private const SPIN_CLASS = 'spin';
    private const FLIP_CLASS = 'flip';
    private const SIZE_CLASS = 'size';
    private const COLOR_CLASS = 'color';
    private const TAG_CLASS = 'tag';
    private const FLIP_V = 'v';
    private const FLIP_H = 'h';
    public const COLOR_LIGHT = 'light';
    public const COLOR_DARK = 'dark';
    private const INACTIVE_CLASS = 'inactive';

    private string $tag = self::TAG_I;
    private ?int $size = null;
    private ?int $rotateDegrees = null;
    private ?string $flip = null;
    private bool $spin = false;
    private bool $inactive = false;
    private ?string $color = null;

    private array $addClasses = [];

    public function __construct(
        private string  $icon,
        private ?string $content = null,
        ?int            $size = null,
        ?int            $rotate = null,
        ?string         $flip = null,
        ?string         $color = null,
        bool            $inactive = false,
        bool            $spin = false)
    {
        $this->size($size);
        $this->rotate($rotate);
        $this->flip($flip);
        $this->color($color);
        $this->inactive($inactive);
        $this->spin($spin);
    }

    public function __call(string $name, array $arguments): static
    {
        if (str_starts_with($name, self::FLIP_CLASS)) {
            return $this->flip(substr($name, strlen(self::FLIP_CLASS)));
        } elseif (str_starts_with($name, self::ROTATE_CLASS)) {
            return $this->rotate(substr($name, strlen(self::ROTATE_CLASS)));
        } elseif (str_starts_with($name, self::SIZE_CLASS)) {
            return $this->size(substr($name, strlen(self::SIZE_CLASS)));
        } elseif (str_starts_with($name, self::COLOR_CLASS)) {
            return $this->color(substr($name, strlen(self::COLOR_CLASS)));
        } elseif (str_starts_with($name, self::TAG_CLASS)) {
            return $this->tag(substr($name, strlen(self::TAG_CLASS)));
        }

        return $this;
    }

    public function __toString(): string
    {
        $classArray = [
            self::BASE_CLASS,
            implode('-', [
                self::BASE_CLASS,
                $this->icon,
            ]),
        ];

        if ($this->size) {
            $classArray[] = implode('-', [
                self::BASE_CLASS,
                $this->size . 'px',
            ]);
        }

        if ($this->rotateDegrees) {
            $classArray[] = implode('-', [
                self::BASE_CLASS,
                self::ROTATE_CLASS,
                $this->rotateDegrees,
            ]);
        }

        if ($this->spin) {
            $classArray[] = implode('-', [
                self::BASE_CLASS,
                self::SPIN_CLASS,
            ]);
        }

        if ($this->flip) {
            $classArray[] = implode('-', [
                self::BASE_CLASS,
                self::FLIP_CLASS,
                $this->flip,
            ]);
        }

        if ($this->color) {
            $classArray[] = implode('-', [
                self::BASE_CLASS,
                $this->color,
            ]);
        }

        if ($this->inactive) {
            $classArray[] = implode('-', [
                self::BASE_CLASS,
                self::INACTIVE_CLASS,
            ]);
        }

        $classArray = array_merge($classArray, $this->addClasses);

        return Html::tag($this->tag, $this->content, ['class' => array_filter(array_unique($classArray))]);
    }

    public function size(?int $size = null): static
    {
        $this->size = match ($size) {
            self::SIZE_18 => self::SIZE_18,
            self::SIZE_24 => self::SIZE_24,
            self::SIZE_36 => self::SIZE_36,
            self::SIZE_48 => self::SIZE_48,
            default => null,
        };

        return $this;
    }

    public function rotate(?int $degree = null): static
    {
        $this->rotateDegrees = match ($degree) {
            self::DEGREES_45 => self::DEGREES_45,
            self::DEGREES_90 => self::DEGREES_90,
            self::DEGREES_135 => self::DEGREES_135,
            self::DEGREES_180 => self::DEGREES_180,
            self::DEGREES_225 => self::DEGREES_225,
            self::DEGREES_270 => self::DEGREES_270,
            self::DEGREES_315 => self::DEGREES_315,
            default => null,
        };

        /** Prevent conflict */
        if ($this->rotateDegrees) {
            $this->flip();
        }

        return $this;
    }

    public function flip(?string $direction = null): static
    {
        $this->flip = match (strtolower($direction ?? '')) {
            self::FLIP_V => self::FLIP_V,
            self::FLIP_H => self::FLIP_H,
            default => null,
        };

        /** Prevent conflict */
        if ($this->flip) {
            $this->rotate();
        }

        return $this;
    }

    public function spin(bool $value = true): static
    {
        $this->spin = $value;
        return $this;
    }

    public function inactive(bool $value = true): static
    {
        $this->inactive = $this->color && $value;
        return $this;
    }

    public function color(?string $color = null): static
    {
        $this->color = match (strtolower($color ?? '')) {
            self::COLOR_LIGHT => self::COLOR_LIGHT,
            self::COLOR_DARK => self::COLOR_DARK,
            default => null,
        };

        return $this;
    }

    public function tag(?string $tag = null): static
    {
        $this->tag = match (strtolower($tag ?? '')) {
            self::TAG_SPAN => self::TAG_SPAN,
            default => self::TAG_I,
        };

        return $this;
    }

    public function addClass(string $class): static
    {
        $this->addClasses[] = $class;

        return $this;
    }

    public function addClasses(array $classes = []): static
    {
        $this->addClasses = array_merge($this->addClasses, $classes);

        return $this;
    }
}

