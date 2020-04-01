const fs = require('fs');
const path = require('path');
const minify = require('html-minifier').minify;
const sass = require('node-sass');
const cssnano = require('cssnano');

/*const getFiles = (dir, filelist = []) => {
  fs.readdirSync(dir).forEach(file => {

    filelist = fs.statSync(path.join(dir, file)).isDirectory() ?
      getFiles(path.join(dir, file), filelist) :
      filelist.concat(path.join(dir, file));

  });
  return filelist;
}

getFiles('./templates').forEach((val) => {

  if (val.indexOf('DS_Store') == -1) {

    const content = fs.readFileSync(val).toString();
    var contentMinified = minify(content, {
      collapseBooleanAttributes: true,
      collapseWhitespace: true,
      removeAttributeQuotes: true,
      removeComments: true,
      removeStyleLinkTypeAttributes: true,
      sortAttributes: true,
      sortClassName: true,
      useShortDoctype: true
    });

    contentMinified = contentMinified.replace('</html>', '');

    [
      'minified',
      'minified/templates',
      'minified/templates/views',
      'minified/templates/partials',
      'minified/static'
    ].forEach(dir => {
      if (!fs.existsSync(dir))
        fs.mkdirSync(dir, 0744);
    })

    fs.writeFileSync('minified/' + val, contentMinified);
  }
});*/


/*if (!fs.existsSync('../minified')) {
  fs.mkdirSync('./minified')
}

if (!fs.existsSync('./minified/static')) {
  fs.mkdirSync('./minified/static')
} */


var result = sass.renderSync({
  file: './style/styles.scss'
})


var ress = cssnano.process(result.css, {}).then(minified => {
  fs.writeFileSync('../public/s.css', minified.css)
})
