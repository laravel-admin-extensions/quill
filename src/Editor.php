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
// solved the conflict
Quill.register("modules/htmlEditButton", htmlEditButton);

// init last editor for adding
var options = {$options},  
    editorClass = 'quill-{$this->id}', 
    editors = $('.' + editorClass),
    lastEditor = editors.last(),
    editorLength = editors.length,
    editorMark = editorClass+editorLength; 

// add a mark to the last editor
lastEditor.addClass(editorMark);
new Quill('.' + editorMark, options);

// init editors that don't include the last one
$('.' + editorClass).each(function(index, item) {
    
    if(index !== editorLength - 1) {
        index++;
        $(this).addClass(editorClass+index);
        new Quill('.' + editorClass + index, options);
    }
});

$('button[type="submit"]').click(function() {

    $('.' + editorClass).each(function(index, item) {
        var editorConent = item.children[0].innerHTML;
        $(this).siblings('input[type="hidden"]').val(editorConent);
    });

});
EOT;
        return parent::render();
    }
}
