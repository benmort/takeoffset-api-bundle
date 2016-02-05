# TakeOffset API Bundle

## Introduction 
A symfony2 bundle API client for restful calls to TakeOffset Carbon Offset API. 

##Installation

### Step 1: Using Composer

Install it with Composer!

```json
// composer.json
{
    // ...
    require: {
        // ...
        "benmort/takeoffset-api-bundle": "dev-master",
    }
}
```

Then, you can install the new dependencies by running Composer's ``update``
command from the directory where your ``composer.json`` file is located:

```bash
$ php composer.phar update
```

### Step 2: Register the bundle

To register the bundles with your kernel:

```php
<?php

// in AppKernel::registerBundles()
$bundles = array(
    // ...
    new Takeoffset\ApiBundle\TakeoffetApiBundle(),
    // ...
);
```

### Step 3: Configure the bundle

```yaml
# app/config/config.yml
# you will get these parameters form your takeoffset admin panel
takeoffset_api:
  application_name: MySite
  oauth2_client_id: XXXX
  oauth2_client_secret: XXXX
  oauth2_redirect_uri: XXXXX
  developer_key: XXXXX
  site_name: mysite.com
```

## Todo
- Log management
- Tests

> Owned and operated by TakeOffset Pty. Ltd. Corporation
