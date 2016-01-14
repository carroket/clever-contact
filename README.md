# Clever Contact

**The Humble Contact Form, Reconsidered**

## Overview

Clever Contact includes everything one needs to add a simple, clean, and modern contact form to a PHP-powered Web site:
* an HTML5 form, including a demo page that can be customized and deployed in full if desired
* CSS 3 style sheets
* JavaScript to handle form-submission and response-handling
* PHP to handle form-processing

Clever Contact was made with current and developing standards, browsers, and techniques in mind, including the following:
* HTML5, including browser-provided input validation
* CSS 3
* XMLHttpRequest level 2
* FormData
* single-page applications (SPAs) and form submission via API
* modern, evergreen browsers - no legacy cruft
* easy customization and deployment
* clean and valid code, preferably free of unnecessary and possibly conflicting IDs

## Room for Improvement

Yes, there is plenty. :)

* User input is currently passed to PHP's [mail](http://php.net/manual/en/function.mail.php) function with minimal processing. The form-processor should probably have a full security audit a bit of input validation.
* As Clever Contact is specifically intended to be a modern system, no effort has been made to provide fallback functionality or graceful degradation for old browsers. Supporting obsolete browsers whose ubiquity slows the modernization of the Web is not a particularly compelling use case for me as I do not think of it as an actual improvement, but if you disagree, you can fork Clever Contact and corrupt it to your evil purposes between eating babies or not using turn signals or whatever it is you do to express the darkness in your heart.
* I made several themes and a theme switcher, but I removed them to focus on completing and delivering a minimum viable product. I will likely restore and further develop them later.

There is much more room for improvement, but I am presently more inclined to sleep than to write documentation, so I recommend either embracing the mystery, looking through the code, or just trying things out to see what you think.

## Known Issues

* Things look great on some mobile devices, but not very good on others. I may refine the demo appearance and responsiveness soon, although appearance is really secondary to functionality since library users can implement their own user interfaces and styles.
* As alluded to above, I am not asleep. This issue will be addressed as soon as I post this documentation.

## Security Notes

You might want to put that form-processor PHP script at a different origin (domain and/or port) from your main site, especially if you are using a crossdomain.xml file.

I am not a security expert, but I do recommend looking into both [crossdomain.xml security](https://www.youtube.com/watch?v=v_5dTJYjSMA) and [CORS](http://www.w3.org/TR/cors/) to get some idea of the kinds of vulnerabilities and challenges that can arise when using APIs.

## Why "Clever Contact"?
Because "Susan" would be a silly name for a contact-form library.

## Who made this?
Clever Contact was made by [Brian Sexton](http://briansexton.com/), the leading mobile device and notebook computer rapid descent initiator at [Carroket, Inc.](http://carroket.com/)
