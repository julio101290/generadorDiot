<?php

namespace App\Commands;

use CodeIgniter\CLI\BaseCommand;
use CodeIgniter\CLI\CLI;
use Config\Database;

class Install extends BaseCommand
{
    /**
     * The Command's Group
     *
     * @var string
     */
    protected $group = 'generaDIOT';

    /**
     * The Command's Name
     *
     * @var string
     */
    protected $name = 'install';

    /**
     * The Command's Description
     *
     * @var string
     */
    protected $description = '';

    /**
     * The Command's Usage
     *
     * @var string
     */
    protected $usage = 'install [arguments] [options]';

    /**
     * The Command's Arguments
     *
     * @var array
     */
    protected $arguments = [];

    /**
     * The Command's Options
     *
     * @var array
     */
    protected $options = [];

    /**
     * Actually execute a command.
     *
     * @param array $params
     */
    public function run(array $params)
    {
        try {
            //$this->call('ci4jcpos:publish');
            // migrate all first
            $this->call('migrate');
            // then seed data
            $seeder = Database::seeder();
            $seeder->call('App\Database\Seeds\installation');
        } catch (\Exception $e) {
            $this->showError($e);
        }
    }
}
