module.exports = {
  ui: {
    files: [
      {
        expand: true,
        src: ['**'],
        cwd: 'ui/dist/',
        dest: "web/"
      }
    ]
  }
};
