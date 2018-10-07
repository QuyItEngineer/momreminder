<?php

namespace Deployer;

require 'recipe/laravel.php';
require 'vendor/deployer/recipes/recipe/slack.php';

inventory('hosts.yml');

// Project name
set('application', 'momremind');

// Project repository
set('repository', 'git@bitbucket.org:aliostek/new-momremind.git');

// [Optional] Allocate tty for git clone. Default value is false.
set('git_tty', true);

set('default_stage', 'dev');

// Setup notification
set('slack_webhook', 'https://hooks.slack.com/services/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');
set('slack_text', '_{{user}}_ deploying `{{branch}}` to *{{target}}*');
set('slack_success_text', 'Deploy to *{{target}}* successful');
set('slack_failure_text', 'Deploy to *{{target}}* failed');

// Shared files/dirs between deploys 
add('shared_files', [
    '.env'
]);
add('shared_dirs', []);

// Writable dirs by web server 
add('writable_dirs', []);


// Hosts

host('momremind.prod')
    ->set('deploy_path', '~/{{application}}');

// Tasks

task('build', function () {
    run('cd {{release_path}} && build');
});

task(
    'cronjob:install',
    function () {
        run('echo "* * * * * cd {{release_path}} && php artisan schedule:run >> /dev/null 2>&1" | crontab -');
    }
)
    ->onStage('production')
    ->desc('Install cronjobs');

// [Optional] if deploy fails automatically unlock.
after('deploy:failed', 'deploy:unlock');

// Migrate database before symlink new release.

before('deploy:symlink', 'artisan:migrate');

// Slack notification
before('deploy', 'slack:notify');
after('success', 'slack:notify:success');
after('deploy:failed', 'slack:notify:failure');

// Setup cron
after('artisan:migrate', 'cronjob:install');

