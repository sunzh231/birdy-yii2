<?php
namespace Deployer;
require 'recipe/yii.php';

// Configuration
set('ssh_type', 'native');
set('ssh_multiplexing', true);

set('repository', 'git@github.com:sunzh231/birdy-yii2.git');
set('default_stage', 'staging');

add('shared_files', []);
add('shared_dirs', []);

add('writable_dirs', []);

// Servers
server('staging', 'birdycloud.com')
    ->user('root')
    ->identityFile()
    ->set('deploy_path', '/www')
    ->set('branch', 'develop')
    ->pty(true);

// Servers
server('production', 'birdycloud.com')
    ->user('root')
    ->identityFile()
    ->set('deploy_path', '/www')
    ->set('branch', 'master')
    ->pty(true);

// Tasks
desc('Restart PHP-FPM service');
task('php-fpm:restart', function () {
    // The user must have rights for restart service
    // /etc/sudoers: username ALL=NOPASSWD:/bin/systemctl restart php-fpm.service
    run('service php5-fpm restart');
});
after('deploy:symlink', 'php-fpm:restart');

// [Optional] if deploy fails automatically unlock.
after('deploy:failed', 'deploy:unlock');
