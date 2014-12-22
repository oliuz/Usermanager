<?php

namespace Vrigzalejo\Usermanager\Commands;

use Illuminate\Console\Command;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;
use Sentry;

class InstallCommand extends Command
{

    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'usermanager:install';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Usermanager install command';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return void
     */
    public function fire()
    {
        $this->info('## Usermanager Install ##');

        // publish sentry config
        $this->call('config:publish', array('package' => 'cartalyst/sentry' ) );

        // publish syntara config
        $this->call('config:publish', array('package' => 'vrigzalejo/usermanager' ) );

        // publish syntara assets
        $this->call('asset:publish', array('package' => 'vrigzalejo/usermanager' ) );

        // run migrations
        $this->call('migrate', array('--env' => $this->option('env'), '--package' => 'cartalyst/sentry' ) );
        $this->call('migrate', array('--env' => $this->option('env'), '--package' => 'vrigzalejo/usermanager' ) );

        // create admin group
        try {
            $this->info('Creating "Admin" group...');
            $group = Sentry::getGroupProvider()->create(array(
                'name'        => 'Admin',
                'permissions' => array(
                    'superuser' => 1
                ),
            ));

            $this->info('"Admin" group created with success');
        } catch (\Cartalyst\Sentry\Groups\GroupExistsException $e) {
            $this->info('"Admin" group already exists');
        }
    }
}
