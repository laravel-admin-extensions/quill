# Quill Editor extension for laravel-admin


This is a `laravel-admin` extension that integrates [Quill](https://github.com/quilljs/quill) into the `laravel-admin` form.
## Screenshot

<img alt="quill" src="https://user-images.githubusercontent.com/2421068/48820356-89a1f900-ed8f-11e8-864c-5804347fb02e.png">

## Installation

```bash
composer require jxlwqq/quill

php artisan vendor:publish --tag=laravel-admin-quill
```

## Configuration

In the `extensions` section of the `config/admin.php` file, add some configuration that belongs to this extension.
```php
'extensions' => [
    'quill' => [
        // If the value is set to false, this extension will be disabled
        'enable' => true,
        'config' => [
            'modules' => [
                'syntax' => true,
                'toolbar' =>
                    [
                        ['size' => []],
                        ['header' => []],
                        'bold',
                        'italic',
                        'underline',
                        'strike',
                        ['script' => 'super'],
                        ['script' => 'sub'],
                        ['color' => []],
                        ['background' => []],
                        'blockquote',
                        'code-block',
                        ['list' => 'ordered'],
                        ['list' => 'bullet'],
                        ['indent' => '-1'],
                        ['indent' => '+1'],
                        'direction',
                        ['align' => []],
                        'link',
                        'image',
                        'video',
                        'formula',
                        'clean'
                    ],
                    "htmlEditButton" => ["syntax" => true, "debug" => true]
            ],
            'theme' => 'snow',
            'height' => '200px',
        ]
    ]
]
```

The configuration of the editor can be found in [Quill Documentation](https://quilljs.com/docs/quickstart/).

* [How to insert images by uploading to the server instead of Base64 encoding the images?](https://github.com/quilljs/quill/issues/1089)

## Usage

Use it in the form form:
```php
$form->quill('content');
```

## More resources

[Awesome Laravel-admin](https://github.com/jxlwqq/awesome-laravel-admin)

License
------------
Licensed under [The MIT License (MIT)](LICENSE).
