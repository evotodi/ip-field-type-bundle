VxIpFieldTypeBundle
===================

Provide an ip field for symfony forms.

Requirements
------------

* Symfony2.*

## Installation

### Composer

Add VxJsUploadBundle in your composer.json:

``` json
{
    "require": {
        "vx/ip-field-bundle": "dev-master"
    }
}
```

Now you can download the bundle with composer:

``` bash
$ php composer.phar update vx/ip-field-bundle
```

### AppKernel

Enable the bundle in the kernel:

``` php
<?php
// app/AppKernel.php

public function registerBundles()
{
    $bundles = array(
        // ...
        new Vx\IpFieldTypeBundle\VxIpFieldTypeBundle(),
    );
}
```

## Usage

### Create field

Create your form :

``` php
$form = $this->createFormBuilder()
	->add('ip', 'ipfield')
	->add('send', 'submit')->getForm();
```

You can specify the ip version (`ipv4` or `ipv6`) :
``` php
	->add('ip', 'ipfield', array('version' => 'ipv4'))
```

``` php
	->add('ip', 'ipfield', array('version' => 'ipv6'))
```

### View

``` html
{{ form_start(form) }}
    {{ form_errors(form) }}

	<div class="control-group">
		<label class="control-label" for="ip">IP</label>
		<div class="controls">
			{{ form_widget(form.ip, { 'my_ip_field', 'class': 'form-control' }) }}
		</div>
	</div>
	{{ form_rest(form) }}
{{ form_end(form) }}
```

Licence
-------

This bundle is under the [MIT Licence](http://opensource.org/licenses/MIT).
