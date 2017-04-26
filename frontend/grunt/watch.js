module.exports = {
  less: {
    files: ['ui/css/less/*.less'],
    tasks: ['recess'],
  },
  build: {
    files: ['ui/*', 'ui/**/*'],
    tasks: ['build:ui'],
  }
}
