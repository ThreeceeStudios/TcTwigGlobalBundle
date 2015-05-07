Tc Twig Global Bundle
=====================

[![Latest Stable Version](https://poser.pugx.org/tc/twig-global-bundle/v/stable)](https://packagist.org/packages/tc/twig-global-bundle)

[![SensioLabsInsight](https://insight.sensiolabs.com/projects/a1664a0d-7f13-49ae-8085-ef83f3e4baf8/big.png)](https://insight.sensiolabs.com/projects/a1664a0d-7f13-49ae-8085-ef83f3e4baf8)

Provides some useful twig tags for global variables.


Installation
------------

```
composer require tc/twig-global-bundle
```

Enable the bundle in your `AppKernel.php`

```php
$bundles = array(
    // ...
    
    new Tc\Bundle\TwigGlobal\TcTwigGlobalBundle(),
    
    // ...
);
```


Usage
------

Usage in Twig:

```twig

{# set a global #}
{% global title = 'My Title' %}

{# get a global #}
{% global title %}

{# merging #}
{% global title ~ ' | My Title Suffix' %}

{# set defaults #}
{% global title 'My Title' default %}
{# this can be overwritten in a child template #}
{% global title 'My Other Title' %}

{# working with arrays #}
{% global colors = ['red', 'green', 'blue'] %}
{% global colors ~ 'purple' %} {# red, green, blue, purple #}
{% global colors ~ ['red', 'blue', 'yellow'] unique %} {# red, green, blue, purple, yellow #}

{# access globals outside of tag #}
{{ _tc_global.get('title', 'some default value') }}
{{ _tc_global.set('title', 'value', true /* default */) }}
{{ _tc_global.merge('colors', 'purple', false /* default */, false /* unique */) }}

```

Usage in PHP via the `tc.twig_global` service:

```php
$container->get('tc.twig_global')->set('title', 'something');
$container->get('tc.twig_global')->get('title');
$container->get('tc.twig_global')->merge('colors', 'blue');
// etc
```


License
-------

TcTwigGlobalBundle is licensed with the MIT license.

See LICENSE for more details.
