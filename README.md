![Symfony](https://img.shields.io/badge/symfony-%23000000.svg?style=for-the-badge&logo=symfony&logoColor=white)
![PhpStorm](https://img.shields.io/badge/phpstorm-143?style=for-the-badge&logo=phpstorm&logoColor=black&color=black&labelColor=darkorchid)

Ip Field Type Symfony Bundle 
===================

Provide an ip field for symfony forms.

Requirements
------------

* Symfony >= 5.4
* PHP >= 7.4

## Installation

### Composer

``` json
composer require evotodi/ip-field-type-bundle
```

## Usage

### Create your form:

```php
$form = $this->createFormBuilder()
	->add('ip', IpType::class) // Defaults to ipV4
	->add('send', 'submit')->getForm();
```

Examples:
```php
	->add('ip', IpType::class, array('version' => 'ipv4', 'readonly' => true, 'clear' => false));
```

```php
	->add('ip', IpType::class, array('version' => 'ipv6', 'disabled' => true))
```

```php
	->add('ip', IpType::class, array('version' => 'mac', 'required' => false))
```

### Options:
| Type   | Option   | Values (defaults are bold) | Description                       |
|--------|----------|----------------------------|-----------------------------------|
| string | version  | **ipv4**, ipv6, mac        | Sets the layout and type of input |
| bool   | disabled | true, **false**            | Disables the input                |
| bool   | readonly | true, **false**            | Makes the input readonly          |
| bool   | required | **true**, false            | Makes the input required          |
| bool   | clear    | **true**, false            | Display a clear input link        | 

### View:

```html
{{ form_start(form) }}
    {{ form_errors(form) }}
		{{ form_widget(form.ip, { 'id': 'my_ip_field', 'class': 'form-control' }) }}
		{{ form_widget(form.mac, { 'id': 'my_mac_field' }) }}
		{{ form_widget(form.gw, { 'id': 'my_gw_field' }) }}
		{{ form_widget(form.netmask) }}
	{{ form_rest(form) }}
{{ form_end(form) }}
```

### Value validity:
The submitted values are not validated. You need to validate them.   
Javascript tries to ensure that the values typed are valid but this is not guaranteed.

Licence
-------

This bundle is under the [MIT Licence](http://opensource.org/licenses/MIT).
