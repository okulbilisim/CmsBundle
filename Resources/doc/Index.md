Getting Started With OkulbilisimCMSBundle
==================================


## Prerequisites

This version of the bundle requires Symfony 2.3+.

## Installation

Installation is a quick (I promise!) 5 step process:

1. Download OkulbilisimCMSbundle using composer
2. Enable the Bundle
3. Configure the CMSBundle
4. Import CMSBundle routing
5. Update your database schema

### Step 1: Download CMSBundle using composer

Add CMSBundle by running the command:

``` bash
$ php composer.phar require okulbilisim/CmsBundle "*"
```

Composer will install the bundle to your project's `vendor/okulbilisim` directory.

### Step 2: Enable the bundle

Enable the bundle in the kernel:

``` php
<?php
// app/AppKernel.php

public function registerBundles()
{
    $bundles = array(
        // ...
        new Okulbilisim\CmsBundle\OkulbilisimCmsBundle(),
    );
}
```

### Step 3: Configure the CMSBundle

Add the following configuration to your `config.yml` file according to which type
of datastore you are using.

``` yaml
# app/config/config.yml
            
# Twig Configuration    
twig:
    globals:
        admin_base_view: "::base.html.twig"

```

This configuration required for generate admin views extending from your base layout.

And add the following configuration to your `parameters.yml` file.

``` yaml
# app/config/parameters.yml

parameters: 
    post_types:
        default: Default
        staticpage: Static Page
        aboutus: About Us
        #and what you want as page type
        
```

### Step 4: Import CMS routing files

Now that you have activated and configured the bundle, all that is left to do is
import the CMSBundle routing files.

In YAML:

``` yaml
# app/config/routing.yml
okulbilisim_cms:
    resource: "@OkulbilisimCmsBundle/Resources/config/routing/all.xml"
```

Or if you prefer XML:

``` xml
<!-- app/config/routing.xml -->
<import resource="@OkulbilisimCmsBundle/Resources/config/routing/all.xml"/>
```

### Step 5: Update your database schema

Now that the bundle is configured, the last thing you need to do is update your
database schema because you have added a new entity.

For ORM run the following command.

``` bash
$ php app/console doctrine:schema:update --force
```

For MongoDB users you can run the following command to create the indexes.

``` bash
$ php app/console doctrine:mongodb:schema:create --index
```

You now can manage pages at `http://app.com/app_dev.php/admin/cms`!

### Next Steps

Now that you have completed the basic installation and configuration of the
CMSBundle, you are ready to learn about more advanced features and usages
of the bundle.

The following documents are available:

- [Adding create button for custom object types](add-button.md)
