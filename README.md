# TakeOffset API Bundle

## Introduction 
A symfony2 bundle API client for restful calls to TakeOffset Carbon Offset API. 

##Installation

### Step 1: Using Composer

Install it with Composer

- composer.json
```json
{
    require: {
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

To register the bundles with your kernel inside the AppKernel::registerBundles():

- app.kernal
```php
<?php

$bundles = array(
    new TakeOffset\ApiBundle\TakeoffetApiBundle(),
);
```

### Step 3: Configure the bundle

# You will get these parameters form your takeoffset admin panel:

- app/config/config.yml
```yaml

takeoffset_api:
  key: XXXXXXXXXXXXXXX
```

## Todo
- Log management
- Tests

> Owned and operated by TakeOffset Pty. Ltd. Corporation
