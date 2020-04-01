<?php
namespace Deployer;

require 'recipe/laravel.php';

// Project name
set('application', 'help4u.ch');

// Project repository
set('repository', 'git@github.com:impetris/help4u.git');

// [Optional] Allocate tty for git clone. Default value is false.
set('git_tty', true);

// Shared files/dirs between deploys
add('shared_files', []);
add('shared_dirs', []);

// Writable dirs by web server
add('writable_dirs', []);


// Hosts

host('prod')
    ->hostname('cloud-impetris-01.nine.ch')
    ->user('ubuntu')
    ->forwardAgent(true)
    ->multiplexing(true)
    ->set('branch', 'master')
    ->set('deploy_path', '/var/www/{{application}}');

// Tasks

before('deploy:symlink', 'build');

task('build', function () {
//    run('cd {{release_path}} && build');
    run('export PATH=$PATH:~/.nvm/versions/node/v12.16.1/bin && cd {{release_path}} && npm install && npm run prod');
});

// [Optional] if deploy fails automatically unlock.
after('deploy:failed', 'deploy:unlock');

// Migrate database before symlink new release.

before('deploy:symlink', 'artisan:migrate');

