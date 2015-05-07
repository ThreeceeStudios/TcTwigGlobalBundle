Tc Twig Global Bundle
=====================

Provides some useful twig tags for global variables.


Installation
------------

```
composer require tc/twig-global-bundle
```


Usage
------

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


License
-------

TcTwigGlobalBundle is licensed with the MIT license.

See LICENSE for more details.
