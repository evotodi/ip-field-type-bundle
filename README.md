Ip Field Type Symfony 3 Bundle 
===================

Provide an ip field for symfony 3 forms.

Fork of https://github.com/Vixys/VxIpFieldTypeBundle

Requirements
------------

* Symfony 3.*

## Installation

### Composer

Add evotodi/ip-field-bundle in your composer.json:

``` json
{
    "require": {
        "evotodi/ip-field-symfony3-bundle": "dev-master"
    }
}
```

Now you can download the bundle with composer:

``` bash
$ php composer.phar update evotodi/ip-field-symfony3-bundle
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
        new Evotodi\IpFieldTypeBundle\EvotodiIpFieldTypeBundle(),
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

You can specify the ip version (`ipv4`, `ipv6` or `mac`) :
``` php
	->add('ip', 'ipfield', array('version' => 'ipv4'))
```

``` php
	->add('ip', 'ipfield', array('version' => 'ipv6'))
```

``` php
	->add('ip', 'ipfield', array('version' => 'mac'))
```

### View

``` html
{{ form_start(form) }}
    {{ form_errors(form) }}

	<div class="control-group">
		<label class="control-label" for="ip">IP</label>
		<div class="controls">
			{{ form_widget(form.ip, { 'id': 'my_ip_field', 'class': 'form-control' }) }}
		</div>
	</div>
	{{ form_rest(form) }}
{{ form_end(form) }}
```

Licence
-------

This bundle is under the [MIT Licence](http://opensource.org/licenses/MIT).
