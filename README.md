MvlabsSnappy
=========

MvlabsSnappy is a ZF2 module that allow easy to thumbnail, snapshot or PDF generation from a url or a html page using Snappy PHP (5.3+) wrapper for the [wkhtmltopdf][wkhtmltopdf] conversion utility.

Installation
------------
#### With composer

1. Add to your `composer.json`:

    ```json
    "require": {
        "mvlabs/mvlabs-snappy": "dev-master"
    }
    ```

2. Now tell composer to download MvlabsSnappy by running the command:

    ```bash
    $ php composer.phar update
    ```

#### Or just clone the repos:
    
    # Install snappy library
    git clone https://github.com/KnpLabs/snappy.git vendor/snappy

    # Install ZF2 Module
    git clone https://github.com/mvlabs/MvlabsSnappy.git vendor/mvlabs/mvlabs-snappy
    

#### Post installation

1. Enabling it in your `application.config.php`file.

    ```php
    <?php
    return array(
        'modules' => array(
            // ...
            'MvlabsSnappy',            
        ),
        // ...
    );
    ```

Configuration
-------------
After installing MvlabsSnappy, copy
`./vendor/mvlabs/MvlabsSnappy/config/mvlabs-snappy.local.php.dist` to
`./config/autoload/mvlabs-snappy.local.php` and change the binaries path  and add options as desired.


    # /config/autoload/mvlabs-snappy.local.php
```php    
<?php
return array(
    'mvlabs-snappy' => array(
        'pdf' => array(
           'binary'  => '/usr/local/bin/wkhtmltopdf',
           'options' => array(), // Type wkhtmltopdf -H to see the list of options
        ),   
        'image' => array(
            'binary'  => '/usr/local/bin/wkhtmltoimage',
            'options' => array(), // Type wkhtmltoimage -H to see the list of options
         )
     )   
);
```

## wkhtmltopdf binary as composer dependencies

If you want to download wkhtmltopdf with composer you add to `composer.json`:

```json
{
    "require": {
        "google/wkhtmltopdf-i386": "0.11.0-RC1"
    }
}
```

or this if you are in 64 bit based system:

```json
{
    "require": {
        "google/wkhtmltopdf-amd64": "0.11.0-RC1"
    }
}
```

> __NOTE__: to be able to use those custom defined packages you need to copy into your `composer.json` following code:

```json
{
    "repositories": [
        {
            "type": "package",
            "package": {
                "name": "google/wkhtmltopdf-amd64",
                "version": "0.11.0-RC1",
                "dist": {
                    "url": "http://wkhtmltopdf.googlecode.com/files/wkhtmltopdf-0.11.0_rc1-static-amd64.tar.bz2",
                    "type": "tar"
                }
            }
        },
        {
            "type": "package",
            "package": {
                "name": "google/wkhtmltopdf-i386",
                "version": "0.11.0-RC1",
                "dist": {
                    "url": "http://wkhtmltopdf.googlecode.com/files/wkhtmltopdf-0.11.0_rc1-static-i386.tar.bz2",
                    "type": "tar"
                }
            }
        }
    ]
}
```

Usage
-----

The module registers two services:  

 - the `mvlabssnappy.image.service` service allows you to generate images;
 - the `mvlabssnappy.pdf.service` service allows you to generate pdf files.

### Generate an image from an URL

     $this->serviceLocator->get('mvlabssnappy.image.service')->generate('http://www.mvlabs.it', '/path/to/myapp/data/image.jpg');

### Generate a pdf document from an URL

     $this->serviceLocator->get('mvlabssnappy.pdf.service')->generate('http://www.mvlabs.it', '/path/to/myapp/data/document.pdf');
     

### Render a pdf document as response from a controller

```php
    public function testPdfAction() {
    
        $now = new \DateTime();
        $viewRenderer = $this->serviceLocator->get('view_manager')->getRenderer();
         
        $layoutViewModel = $this->layout();
        $layoutViewModel->setTemplate('layout/pdf-layout');
    
        $viewModel = new ViewModel(array(
            'vars' => $vars,            
        ));
    
        $viewModel->setTemplate('myModule/myController/pdf-template');
            
        $layoutViewModel->setVariables(array(
            'content' => $viewRenderer->render($viewModel),
        ));
    
        $htmlOutput = $viewRenderer->render($layoutViewModel);
        
        $output = $this->serviceLocator->get('mvlabssnappy.pdf.service')->getOutputFromHtml($htmlOutput);
        
        $response = $this->getResponse();
        $headers  = $response->getHeaders();
        $headers->addHeaderLine('Content-Type', 'application/pdf');
        $headers->addHeaderLine('Content-Disposition', "attachment; filename=\"export-" . $now->format('d-m-Y H:i:s') . ".pdf\"");
        
        $response->setContent($output);
        
        return $response;
    
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

    
    
