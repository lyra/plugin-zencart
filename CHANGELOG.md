1.6.0, 2021-06-22:
- Enable signature algorithm selection (SHA-1 or HMAC-SHA-256).
- Do not use vads\_order\_info, use vads\_ext\_info\_* instead.
- Integration of the payment in installments in the same plugin.
- Module compatibility with ZenCart 1.5.x versions.
- Added German translations.
- Added Spanish translations.
- [prodfaq]Fix notice about shifting the shop to production mode.

1.5.0, 2015-11-16:
- Module upgrade to V2 payment forms.
- Added the 3DS Selective parameter.

1.4c, 2012-08-14:
- Fixed 406 errors when calling the notification URL, related to the presence of the hash parameter.

1.4b, 2012-08-13:
- Passing messages in session rather than in the $error\_message variable to avoid HTTP 406 errors when the size of the message exceeds 43 characters.

1.4a, 2010-10-06:
- Globally increment The order numbers and no more per customer.
- Bug fix: Bug on the return to shop in the checkout\_process\_vads.php file.

1.4, 2010-09-03:
- [multi] Compatibility with the PayZen multi payment plugin.
- Back to the shop in GET mode.
- Improved code for PHP 4 compatibility.

1.0a, 2010-03-16:
- Plugin creation.