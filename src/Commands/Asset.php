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
        helper('filesystem');

        $mapDir = directory_map(ROOTPATH . 'vendor/', 2);

        \CodeIgniter\CLI\CLI::write("Available Assets:");

        foreach ($mapDir as $k1 => $d1) {
            if (is_array($d1)) {
                $vendor = rtrim($k1, '/');
                foreach ($d1 as $k2 => $d2) {
                    if (is_dir(realpath(ROOTPATH . "vendor/{$vendor}/$d2"))) {
                        $package = rtrim($d2, '/');

                        $composerJson = json_decode(file_get_contents(realpath(ROOTPATH . "vendor/{$vendor}/{$package}/composer.json")));

                        if (property_exists($composerJson, 'extra')) {
                            if (property_exists($composerJson->extra, 'ci4xpander')) {
                                if (property_exists($composerJson->extra->ci4xpander, 'asset')) {
                                    \CodeIgniter\CLI\CLI::write("{$vendor}/{$package}");
                                }
                            }
                        }
                    }
                }
            }
        }
    }
}
