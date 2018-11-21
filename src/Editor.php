<?php
/**
 * Created by PhpStorm.
 * User: jxlwqq
 * Date: 2018/11/20
 * Time: 16:53
 */

namespace Jxlwqq\Quill;


use Encore\Admin\Form\Field;

class Editor extends Field
{
    protected $view = 'laravel-admin-quill::editor';

    protected static $css = [
        'vendor/laravel-admin-ext/quill/monokai-sublime.min.css',
        'vendor/laravel-admin-ext/quill/katex.min.css',
        'vendor/laravel-admin-ext/quill/quill.bubble.css',
        'vendor/laravel-admin-ext/quill/quill.snow.css',
    ];

    protected static $js = [
        'vendor/laravel-admin-ext/quill/highlight.min.js',
        'vendor/laravel-admin-ext/quill/katex.min.js',
        'vendor/laravel-admin-ext/quill/quill.min.js',
    ];

    public function render()
    {
        $options = config('admin.extensions.quill.config');
        // set height
        $height = isset($options['height']) ? $options['height'] : '300px';
        $this->addVariables(['height' => $height]);
        unset($options['height']);
        $options = json_encode($options);
        $this->script = <<<EOT
var options = {$options}
var quill = new Quill("#{$this->id}", options);

$('button[type="submit"]').click(function() {
var content = document.querySelector('#{$this->id}').children[0].innerHTML
$('input[name={$this->id}]').val(content)
})
EOT;
        return parent::render();
    }
}