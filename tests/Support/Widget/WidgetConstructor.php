<?php

declare(strict_types=1);

namespace PHPForge\Widget\Tests\Support\Widget;

use PHPForge\Widget\AbstractWidget;
use PHPForge\Widget\Attribute;
use Yii\Html\Helper\Attributes;

final class WidgetConstructor extends AbstractWidget
{
    use Attribute\Custom\HasAttributes;
    use Attribute\Custom\HasContent;
    use Attribute\Custom\HasData;
    use Attribute\Custom\HasItems;
    use Attribute\Custom\HasTagName;
    use Attribute\Custom\HasTemplate;
    use Attribute\HasAutocomplete;
    use Attribute\HasCols;
    use Attribute\HasCrossorigin;
    use Attribute\HasDownload;
    use Attribute\HasGroup;
    use Attribute\HasHref;
    use Attribute\HasHreflang;
    use Attribute\HasId;
    use Attribute\HasIsmap;
    use Attribute\HasLoading;
    use Attribute\HasPing;
    use Attribute\HasReferrerpolicy;
    use Attribute\HasRel;
    use Attribute\HasRows;
    use Attribute\HasSizes;
    use Attribute\HasSrcset;
    use Attribute\HasTarget;
    use Attribute\HasWrap;

    protected array $attributes = [];
    protected string $template = '';

    public function __construct(private Attributes $attributesHelper, array $definitions = [])
    {
        parent::__construct($definitions);
    }

    public function addAttribute(string $attribute, string $value): self
    {
        $new = clone $this;
        $new->attributes[$attribute] = $value;

        return $new;
    }

    protected function beforeRun(): bool
    {
        if (isset($this->attributes['id']) && $this->attributes['id'] === 'beforerun') {
            return false;
        }

        return parent::beforeRun();
    }

    protected function afterRun(string $result): string
    {
        $result = parent::afterRun($result);

        if (isset($this->attributes['id']) && $this->attributes['id'] === 'afterrun') {
            $result = '<div>' . $result . '</div>';
        }

        return $result;
    }

    protected function run(): string
    {
        $html = '';

        if ($this->tagName !== '') {
            $html = $this->tagName;
        }

        $html .= trim($this->attributesHelper->render($this->attributes));

        if ($this->content !== '' && $html !== '') {
            $html .= $this->content . ' ' . $html;
        } elseif ($this->content !== '') {
            $html .= $this->content;
        }

        return '<' . $html . '>';
    }
}
