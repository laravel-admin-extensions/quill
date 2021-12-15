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
        'vendor/laravel-admin-ext/quill/quill.htmlEditButton.min.js',
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
Quill.register("modules/htmlEditButton", htmlEditButton);

// init last editor for adding
var options = {$options};

$('.quill-{$this->id}').each(function(index, item) {
    if( false === $(this).data('initialed') ) { // prevent initialed twice
        new Quill(item, options);
        $(this).data('initialed', true); // mark the editor as initialed
    }
    
});

$('button[type="submit"]').click(function() {
    $('.quill-{$this->id}').each(function(index, item) {
        editorConent = item.children[0].innerHTML;
        $(this).siblings('input[type="hidden"]').val(editorConent);
    });

});
EOT;
        return parent::render();
    }
}
