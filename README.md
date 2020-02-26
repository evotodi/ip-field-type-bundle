Ip Field Type Symfony Bundle 
===================

Provide an ip field for symfony forms.

Fork of https://github.com/Vixys/VxIpFieldTypeBundle

Requirements
------------

* Symfony 4.*

## Installation

### Composer

``` json
composer require evotodi/ip-field-type-bundle
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
	->add('ip', 'ipfield', array('version' => 'ipv4', 'readonly' => true))
```

``` php
	->add('ip', 'ipfield', array('version' => 'ipv6', 'disabled' => true))
```

``` php
	->add('ip', 'ipfield', array('version' => 'mac'))
```

### View

``` html
{% form_theme form '@EvotodiIpFieldType/Form/ipfield_widget.html.twig' %}
{{ form_start(form) }}
    {{ form_errors(form) }}
		{{ form_widget(form.ip, { 'id': 'my_ip_field', 'class': 'form-control' }) }}
		{{ form_widget(form.mac, { 'id': 'my_mac_field' }) }}
		{{ form_widget(form.gw, { 'id': 'my_gw_field' }) }}
	{{ form_rest(form) }}
{{ form_end(form) }}

{% block javascripts %}
    {{ parent() }}
    <script src="{{ asset('bundles/evotodiipfieldtype/js/IpFieldType.js') }}"></script>
{% endblock %}
```

Licence
-------

This bundle is under the [MIT Licence](http://opensource.org/licenses/MIT).
