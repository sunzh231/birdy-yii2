module.exports = {
	min: {
      files: [{
          expand: true,
          cwd: 'ui/tpl/',
          src: ['*.html', '**/*.html'],
          dest: 'web/tpl/',
          ext: '.html',
          extDot: 'first'
      }]
  }
}
