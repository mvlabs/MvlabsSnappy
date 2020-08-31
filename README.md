MvlabsSnappy
=========
[![Build Status](https://travis-ci.org/mvlabs/MvlabsSnappy.svg?branch=master)](https://travis-ci.org/mvlabs/MvlabsSnappy)
[![Latest Stable Version](https://poser.pugx.org/mvlabs/mvlabs-snappy/v/stable)](https://packagist.org/packages/mvlabs/mvlabs-snappy)
[![Total Downloads](https://poser.pugx.org/mvlabs/mvlabs-snappy/downloads)](https://packagist.org/packages/mvlabs/mvlabs-snappy)
[![License](https://poser.pugx.org/mvlabs/mvlabs-snappy/license)](https://packagist.org/packages/mvlabs/mvlabs-snappy)

MvlabsSnappy is a Laminas 3 module that allow easy to thumbnail, snapshot or PDF generation from a url or a html page using Snappy PHP (5.6+) wrapper for the [wkhtmltopdf][wkhtmltopdf] conversion utility.

Installation
------------
#### With composer

    php composer.phar require mvlabs/mvlabs-snappy

#### Post installation

1. Enabling it in your `application.config.php`file.

    ```php
    <?php
    return [
        'modules' => [
            // ...
            'MvlabsSnappy',
        ],
        // ...
    ];
    ```

Configuration
-------------
After installing MvlabsSnappy, copy
`./vendor/mvlabs/MvlabsSnappy/config/mvlabs-snappy.local.php.dist` to
`./config/autoload/mvlabs-snappy.local.php` and change the binaries path  and add options as desired.


    # /config/autoload/mvlabs-snappy.local.php
```php
<?php
return [
    'mvlabs-snappy' => [
        'pdf' => [
           'binary'  => '/usr/local/bin/wkhtmltopdf',
           'options' => [], // Type wkhtmltopdf -H to see the list of options
        ],
        'image' => [
            'binary'  => '/usr/local/bin/wkhtmltoimage',
            'options' => [], // Type wkhtmltoimage -H to see the list of options
         ]
     ]
];
```

## wkhtmltopdf binary as composer dependencies

If you want to download wkhtmltopdf with composer you add to `composer.json`:

```json
{
    "require": {
        "h4cc/wkhtmltopdf-i386": "0.12.4"
    }
}
```

Or require the package for _i386_ with:

    php composer.phar require h4cc/wkhtmltopdf-i386 "0.12.4"

If you are in 64 bit based system:

```json
{
    "require": {
        "h4cc/wkhtmltopdf-amd64": "0.12.4"
    }
}
```

Or require the package for _amd64_ with:

    php composer.phar require h4cc/wkhtmltopdf-amd64 "0.12.4"

The binary will then be located at:

    vendor/h4cc/wkhtmltopdf-i386/bin/wkhtmltopdf-i386

Also a symlink will be created in your configured bin/ folder, for example:

    vendor/bin/wkhtmltopdf-i386

Usage
-----

The module registers two services:

 - the `mvlabssnappy.image.service` service allows you to generate images;
 - the `mvlabssnappy.pdf.service` service allows you to generate pdf files.

### Generate an image from an URL

     $mvlabsSnappyImage = $container->get('mvlabssnappy.image.service'),
     $mvlabsSnappyImage->generate('http://www.mvlabs.it', '/path/to/myapp/data/image.jpg');

### Generate a pdf document from an URL

     $mvlabsSnappyPdf = $container->get('mvlabssnappy.pdf.service'),
     $mvlabsSnappyPdf->generate('http://www.mvlabs.it', '/path/to/myapp/data/document.pdf');


### Render a pdf document as response from a controller

```php

class IndexController extends AbstractActionController
{
    /**
     * @var Knp\Snappy\Pdf;
     */
    protected $mvlabsSnappyPdf;

    /**
     * @var Laminas\View\Renderer\RendererInterface
     */
    protected $renderer;

    public function __construct(Pdf $mvlabsSnappyPdf, RendererInterface $renderer)
    {
        $this->mvlabsSnappyPdf = $mvlabsSnappyPdf;
        $this->renderer = $renderer;
    }

    public function testPdfAction()
    {
        $now = new \DateTime();

        $layoutViewModel = $this->layout();
        $layoutViewModel->setTemplate('layout/pdf-layout');

        $viewModel = new ViewModel([
            'vars' => $vars,
        ]);

        $viewModel->setTemplate('myModule/myController/pdf-template');

        $layoutViewModel->setVariables([
            'content' => $this->renderer->render($viewModel),
        ]);

        $htmlOutput = $this->renderer->render($layoutViewModel);

        $output = $this->mvlabsSnappyPdf->getOutputFromHtml($htmlOutput);

        $response = $this->getResponse();
        $headers  = $response->getHeaders();
        $headers->addHeaderLine('Content-Type', 'application/pdf');
        $headers->addHeaderLine('Content-Disposition', "attachment; filename=\"export-" . $now->format('d-m-Y H:i:s') . ".pdf\"");

        $response->setContent($output);

        return $response;
    }
}
```


Credits
-------

MvlabsSnappy and [Snappy][snappy] are based on the awesome [wkhtmltopdf][wkhtmltopdf].
MvlabsSnappy has been developed by [mvlabs][mvlabs].

[snappy]: https://github.com/KnpLabs/snappy
[wkhtmltopdf]: http://code.google.com/p/wkhtmltopdf/
[mvlabs]: http://www.mvlabs.it
[mvassociati]: http://www.mvassociati.it/en



