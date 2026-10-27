<?php

declare(strict_types=1);

namespace Flexi\Modules\Ui\Tests\Infrastructure\Ui;

use Flexi\Modules\Ui\Infrastructure\Ui\Template;
use PHPUnit\Framework\TestCase;

class TemplateTest extends TestCase
{
    private Template $template;
    private string $path;
    public function setUp(): void
    {
        $this->path = dirname(__DIR__, 2).'/TestData/Assets/test.html';

        $this->template = new Template($this->path);
    }

    public function testInvalidPath(): void
    {
        $path = dirname(__DIR__, 2).'/invalid/path/test/file.html';
        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage('Template file not found: '.$path);

        new Template($path);
    }

    public function testGetContent(): void
    {
        $content = $this->template->getContent();
        $this->assertNotEmpty($content);
    }

    public function testGetTemplatePath(): void
    {
        $this->assertEquals($this->path, $this->template->getTemplatePath());
    }

    public function testGetTemplateName(): void
    {
        $this->assertEquals('test.html', $this->template->getTemplateName());
    }

    public function testGetTemplateExtension(): void
    {
        $this->assertEquals('html', $this->template->getTemplateExtension());
    }
}
