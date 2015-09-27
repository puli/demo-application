A Puli Demo Application
=======================

This repository contains a demo application showing how to use [Puli] in a
[Silex] application together with [Twig] and [Gulp JS].

Run the following commands after cloning the repository:

```
$ npm install
$ gulp
$ composer install
$ vendor/bin/puli publish --install
```

Building your Own
-----------------

If you want to build this demo application from scratch, follow these steps:

1. Create the basic directory layout
2. Copy `composer.json`, `package.json` and `Gulpfile.js` to the project
3. Run `npm install`
4. Run `composer install`
5. Put your SCSS files into `res/scss/`
6. Put your Javascript files into `res/js/`
7. Run `gulp`
8. Download [`puli.phar`]
9. Run `php puli.phar map /app res` to map the Puli path `/app` to the `res` directory
10. Run `php puli.phar server --add localhost web` to add the server "local" for the directory `web`
11. Run `php puli.phar publish /app/public localhost` to publish your public resources to localhost.
12. Run `php puli.phar publish --install` to install the public resources on the server.

[Puli]: http://puli.io
[Silex]: http://silex.sensiolabs.org
[Twig]: http://twig.sensiolabs.org
[Gulp JS]: http://gulpjs.com
[`puli.phar`]: https://github.com/puli/cli/releases
