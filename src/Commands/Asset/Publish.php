<?php namespace CI4Xpander_AssetsManager\Commands\Asset;

class Publish extends \CodeIgniter\CLI\BaseCommand
{
    protected $group = 'Xpander Asset';
    protected $name = 'xpander:asset:publish';
    protected $description = 'Publish xpander assets';
    protected $usage = 'xpander:asset:publish';
    protected $arguments = [];
    protected $options = [];

    public function run(array $params = [])
    {}
}
