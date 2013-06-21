MvaSnappy
=========

MvaSnappy is a ZF2 module that allow easy to thumbnail, snapshot or PDF generation from a url or a html page using Snappy PHP (5.3+) wrapper for the [wkhtmltopdf][wkhtmltopdf]conversion utility.

Installation
------------
#### With composer

1. Add this project and [MvaSnappy](https://github.com/drigani/MvaSnappy.git) in your composer.json:

    ```json
    "require": {
        "digani/MvaSnappy": "dev-master"
    }
    ```

2. Now tell composer to download MvaSnappy by running the command:

    ```bash
    $ php composer.phar update
    ```

#### Or just clone the repos:
    
    # Install snappy library
    git clone https://github.com/KnpLabs/snappy.git vendor/snappy

    # Install ZF2 Module
    git clone https://github.com/drigani/MvaSnappy.git vendor/digani/MvaSnappy
    

#### Post installation

1. Enabling it in your `application.config.php`file.

    ```php
    <?php
    return array(
        'modules' => array(
            // ...
            'MvaSnappy',            
        ),
        // ...
    );
    ```

Configuration
-------------
After installing MvaSnappy, copy
`./vendor/drigani/MvaSnappy/config/mva-snappy.local.php.dist` to
`./config/autoload/mva-snappy.local.php` and change the binaries path  and add options as desired.


    # /config/autoload/mva-snappy.local.php
```php    
<?php
return array(
    'mva-snappy' => array(
        'pdf' => array(
           'binary'  => '/usr/local/bin/wkhtmltopdf',
           'options' => array(),
        ),   
        'image' => array(
            'binary'  => '/usr/local/bin/wkhtmltoimage',
            'options' => array(),
         )
     )   
);
```

Usage
-----

The module registers two services:  

 - the `mvasnappy.image.service` service allows you to generate images;
 - the `mvasnappy.pdf.service` service allows you to generate pdf files.

### Generate an image from an URL

     $this->serviceLocator->get('mvasnappy.image.service')->generate('http://www.mvlabs.it', '/path/to/myapp/data/image.jpg');

### Generate a pdf document from an URL

     $this->serviceLocator->get('mvasnappy.pdf.service')->generate('http://www.mvlabs.it', '/path/to/myapp/data/document.pdf');
     

    
    
