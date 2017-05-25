Required installation
=

- apache
- php (7+)
- js (es6)
- mysql (5.7.6+)
- nodejs (7+)
- npm (4+)

Type `npm install` on same directory as this file to install dependency

Coding style
-

- for all files (including php, html, js and css), we would use 4 spaces to indent


To config codeigniter
-

- copy application/config/testing
- to application/config/development
- modify configs inside development folder


To run webpack
-

npm run watch


Javascript and CSS sources locations
-

- css: ./application/src/css
- js: ./application/src/js

Javascript and CSS output locations
-

- css and js: ./assets


Add javascript and css to web pack
-

- css-files.json
- js-files.json

p.s. sources directory and output directory is hard coded

settings files are key(assert folder) => array(of files path on src folder)

```html
{
    "js/folder": ["app/test"]
}

sources file
application/src/js/app/test.js

output to
assets/js/folder/test.js
```

```html
{
    "js": ["abc"]
}

sources file
application/src/js/abc.js

output to
assets/js/abc.js

```
