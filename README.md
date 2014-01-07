smarty-ipsum
============

Ipsum lorem plugin for the PHP Smarty templating engine. Designed to generate placeholder text of any size to test your templates.

This plugin will also insert random HTML for you

Usage
-----

```smarty
{ipsum words=300 paragraphs=3}
```

```smarty
<ul>{ipsum words=300 paragraphs=50 break_start="<li>" break_end=".</li>" html=true random=true}</ul>
```

Parameters
----------


Installation
------------

Place in your Smarty plugins directory. It will immediately be available for use.

Notes
-----

Tested with Smarty 3, but there is no reason it won't work in Smarty 2.
