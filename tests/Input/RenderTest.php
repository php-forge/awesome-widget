<?php

declare(strict_types=1);

namespace PHPForge\Widget\Tests\Input;

use PHPForge\Widget\Tests\Support\Form\RuleHtmlAttributesForm;
use PHPForge\Widget\Tests\Support\Form\TestForm;
use PHPForge\Widget\Tests\Support\Widget\InputWidget;
use PHPUnit\Framework\TestCase;
use Stringable;
use Yii\Support\Assert;

/**
 * @psalm-suppress PropertyNotSetInConstructor
 */
final class RenderTest extends TestCase
{
    public function testAccept(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <input id="testform-string" name="TestForm[string]" type="text" accept="image/*">
            </div>
            HTML,
            InputWidget::widget(new TestForm(), 'string')->accept('image/*')->render(),
        );
    }

    public function testAutoFocus(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <input id="testform-string" name="TestForm[string]" type="text" autofocus>
            </div>
            HTML,
            InputWidget::widget(new TestForm(), 'string')->autoFocus()->render(),
        );
    }

    public function testAttributes(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <input class="test-class" id="testform-string" name="TestForm[string]" type="text">
            </div>
            HTML,
            InputWidget::widget(new TestForm(), 'string')->attributes(['class' => 'test-class'])->render(),
        );

        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <input class="test-class" id="testform-string" name="TestForm[string]" type="text" disabled>
            </div>
            HTML,
            InputWidget::widget(new TestForm(), 'string', ['attributes()' => [['class' => 'test-class']]])
                ->attributes(['disabled' => true])
                ->render(),
        );
    }

    public function testClass(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <input class="test-class" id="testform-string" name="TestForm[string]" type="text">
            </div>
            HTML,
            InputWidget::widget(new TestForm(), 'string')->class('test-class')->render(),
        );
    }

    public function testContainerClass(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div class="test-class">
            <input id="testform-string" name="TestForm[string]" type="text">
            </div>
            HTML,
            InputWidget::widget(new TestForm(), 'string')->container(true)->containerClass('test-class')->render(),
        );
    }

    public function testDisabled(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <input id="testform-string" name="TestForm[string]" type="text" disabled>
            </div>
            HTML,
            InputWidget::widget(new TestForm(), 'string')->disabled()->render(),
        );
    }

    public function testGetAttribute(): void
    {
        $this->assertSame('string', InputWidget::widget(new TestForm(), 'string')->getAttribute());
    }

    public function testGetErrorsForAttribute(): void
    {
        $inputWidget = InputWidget::widget(new TestForm(), 'string');

        /** @var TestForm $formModel */
        $formModel = $inputWidget->getFormModel();
        $formModel->error()->add('string', 'String its required.');
        $formModel->error()->add('string', 'Error for string.');

        Assert::equalsWithoutLE(
            <<<HTML
            String its required.<br>Error for string.
            HTML,
            $inputWidget->getErrorsForAttribute(),
        );
    }

    public function testGetErrorFirstForAttribute(): void
    {
        $inputWidget = InputWidget::widget(new TestForm(), 'string');

        /** @var TestForm $formModel */
        $formModel = $inputWidget->getFormModel();
        $formModel->error()->add('string', 'Error for string.');

        $this->assertSame('Error for string.', $inputWidget->getErrorFirstForAttribute());
    }

    public function testGetFormModel(): void
    {
        $this->assertInstanceOf(TestForm::class, InputWidget::widget(new TestForm(), 'string')->getFormModel());
    }

    public function testGetId(): void
    {
        $this->assertSame('testform-string', InputWidget::widget(new TestForm(), 'string')->getId());
        $this->assertSame('test-id', InputWidget::widget(new TestForm(), 'string')->id('test-id')->getId());
    }

    public function testGetPlaceholder(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <input id="testform-array" name="TestForm[array]" type="text" placeholder="array">
            </div>
            HTML,
            InputWidget::widget(new TestForm(), 'array')->render(),
        );
    }

    public function testGetRuleHtmlAttributes(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <input id="rulehtmlattributesform-string" name="RuleHtmlAttributesForm[string]" type="text" required>
            </div>
            HTML,
            InputWidget::widget(new RuleHtmlAttributesForm(), 'string')->render(),
        );
    }

    public function testGetValue(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <input id="testform-array" name="TestForm[array]" type="text" value="test-value" placeholder="array">
            </div>
            HTML,
            InputWidget::widget(new TestForm(), 'array')->value('test-value')->render(),
        );
    }

    public function testIsValidated(): void
    {
        $inputWidget = InputWidget::widget(new TestForm(), 'string');

        $this->assertFalse($inputWidget->isValidated());

        /** @var TestForm $formModel */
        $formModel = $inputWidget->getFormModel();
        $formModel->load(['TestForm' => ['string' => 'test']]);

        $this->assertTrue($inputWidget->isValidated());

        $formModel->error()->add('string', 'Error for string.');

        $this->assertFalse($inputWidget->isValidated());
    }

    public function testHasError(): void
    {
        $inputWidget = InputWidget::widget(new TestForm(), 'string');

        $this->assertFalse($inputWidget->hasError());

        /** @var TestForm $formModel */
        $formModel = $inputWidget->getFormModel();
        $formModel->error()->add('string', 'Error for string.');

        $this->assertTrue($inputWidget->hasError());
    }

    public function testHeight(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <input id="testform-string" name="TestForm[string]" type="text" height="100">
            </div>
            HTML,
            InputWidget::widget(new TestForm(), 'string')->height(100)->render(),
        );
    }

    public function testMultiple(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <input id="testform-array" name="TestForm[array]" type="text" multiple placeholder="array">
            </div>
            HTML,
            InputWidget::widget(new TestForm(), 'array')->multiple()->render(),
        );
    }

    public function testLabel(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <label>Test</label>
            <input id="testform-string" name="TestForm[string]" type="text">
            </div>
            HTML,
            InputWidget::widget(new TestForm(), 'string')->label('Test')->render(),
        );
    }

    public function testLabelAttributes(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <label class="test-class">Test</label>
            <input id="testform-string" name="TestForm[string]" type="text">
            </div>
            HTML,
            InputWidget::widget(new TestForm(), 'string')
                ->label('Test')
                ->labelAttributes(['class' => 'test-class'])
                ->render(),
        );
    }

    public function testLabelClass(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <label class="test-class">Test</label>
            <input id="testform-string" name="TestForm[string]" type="text">
            </div>
            HTML,
            InputWidget::widget(new TestForm(), 'string')->label('Test')->labelClass('test-class')->render(),
        );
    }

    public function testNotLabel(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <input id="testform-string" name="TestForm[string]" type="text">
            </div>
            HTML,
            InputWidget::widget(new TestForm(), 'string')->label('Test')->notLabel()->render(),
        );
    }

    public function testPrefix(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <span>prefix</span>
            <input id="testform-string" name="TestForm[string]" type="text">
            </div>
            HTML,
            InputWidget::widget(new TestForm(), 'string')->prefix('<span>prefix</span>')->render(),
        );
    }

    public function testPrefixWithStringable(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <span class="input-group-text"><i class="bi bi-person-fill"></i></span>
            <input id="testform-string" name="TestForm[string]" type="text">
            </div>
            HTML,
            Inputwidget::widget(new TestForm(), 'string')
                ->prefix(
                    new class () implements Stringable {
                        public function __toString(): string
                        {
                            return '<span class="input-group-text"><i class="bi bi-person-fill"></i></span>';
                        }
                    }
                )
                ->render(),
        );
    }

    public function testPrompt(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <select id="testform-array" name="TestForm[array]" type placeholder="array">
            <option value="0">tests</option>
            </select>
            </div>
            HTML,
            InputWidget::widget(new TestForm(), 'array')->prompt('tests', '0')->tagName('select')->type('')->render(),
        );
    }

    public function testReadonly(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <input id="testform-string" name="TestForm[string]" type="text" readonly>
            </div>
            HTML,
            InputWidget::widget(new TestForm(), 'string')->readonly()->render(),
        );
    }

    public function testRequired(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <input id="testform-string" name="TestForm[string]" type="text" required>
            </div>
            HTML,
            InputWidget::widget(new TestForm(), 'string')->required()->render(),
        );
    }

    public function testRender(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <input id="testform-string" name="TestForm[string]" type="text">
            </div>
            HTML,
            InputWidget::widget(new TestForm(), 'string')->render(),
        );
    }

    public function testSrc(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <input id="testform-string" name="TestForm[string]" type="text" src="small.jpg">
            </div>
            HTML,
            InputWidget::widget(new TestForm(), 'string')->src('small.jpg')->render(),
        );
    }

    public function testStyle(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <input id="testform-string" name="TestForm[string]" type="text" style="color: red;">
            </div>
            HTML,
            InputWidget::widget(new TestForm(), 'string')->style('color: red;')->render(),
        );
    }

    public function testSuffix(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <input id="testform-string" name="TestForm[string]" type="text">
            <span>suffix</span>
            </div>
            HTML,
            InputWidget::widget(new TestForm(), 'string')->suffix('<span>suffix</span>')->render(),
        );
    }

    public function testSuffixWithStringable(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <input id="testform-string" name="TestForm[string]" type="text">
            <span class="input-group-text"><i class="bi bi-person-fill"></i></span>
            </div>
            HTML,
            InputWidget::widget(new TestForm(), 'string')->suffix(
                new class () implements Stringable {
                    public function __toString(): string
                    {
                        return '<span class="input-group-text"><i class="bi bi-person-fill"></i></span>';
                    }
                }
            )->render(),
        );
    }

    public function testTemplate(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <input id="testform-string" name="TestForm[string]" type="text">
            </div>
            HTML,
            InputWidget::widget(new TestForm(), 'string')->template('{input}')->render(),
        );
    }

    public function testWidth(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <input id="testform-string" name="TestForm[string]" type="text" width="100">
            </div>
            HTML,
            InputWidget::widget(new TestForm(), 'string')->width(100)->render(),
        );
    }
}
