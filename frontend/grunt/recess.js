module.exports = {
	less: {
    files: {
      'ui/css/app.css': [
        'ui/css/less/app.less'
      ],
      'ui/css/md.css': [
        'ui/css/less/md.less'
      ],
      'ui/css/app.rtl.css': [
        'ui/css/less/app.rtl.less'
      ]
    },
    options: {
      compile: true
    }
  }
}
