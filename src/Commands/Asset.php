<?php namespace CI4Xpander_AssetsManager\Commands;

class Asset extends \CodeIgniter\CLI\BaseCommand
{
    protected $group = 'Xpander Asset';
    protected $name = 'xpander:asset';
    protected $description = 'List xpander assets';
    protected $usage = 'xpander:asset';
    protected $arguments = [];
    protected $options = [];

    public function run(array $params = [])
    {
        $autoloader = \Config\Services::autoloader();

        d($autoloader);
    }
}
