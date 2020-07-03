<?php namespace CI4Xpander_AssetsManager\Commands\Asset;

class Publish extends \CodeIgniter\CLI\BaseCommand
{
    protected $group = 'Xpander Asset';
    protected $name = 'xpander:asset:publish';
    protected $description = 'Publish xpander assets';
    protected $usage = 'xpander:asset:publish [name]';
    protected $arguments = [
        'name' => 'CodeIgniter 4 Xpander Asset Package Name'
    ];
    protected $options = [];

    public function run(array $params = [])
    {
        $name = array_shift($params);

        if (empty($name)) {
            \CodeIgniter\CLI\CLI::error('Empty asset package name');
            return;
        }

        $name = preg_replace_callback('/[A-Z]/', function ($match) {
            return '-' . strtolower($match[0]);
        }, $name);

        $composerJson = json_decode(file_get_contents(realpath(ROOTPATH . "vendor/{$name}/composer.json")));

        if (property_exists($composerJson, 'extra')) {
            if (property_exists($composerJson->extra, 'ci4xpander')) {
                if (property_exists($composerJson->extra->ci4xpander, 'asset')) {
                    $rule = $composerJson->extra->ci4xpander->asset;

                    if (property_exists($rule, 'dir')) {
                        \CI4Xpander\Helpers\File::get(ROOTPATH . "vendor/{$name}/{$rule->dir}")->copy(ROOTPATH . "public/assets/vendor/{$name}");
                    }

                    if (property_exists($rule, 'copy')) {
                        foreach ((array) $rule->copy as $source => $target) {
                            \CI4Xpander\Helpers\File::get(ROOTPATH . $source)->copy(ROOTPATH . $target);
                        }
                    }
                }
            }
        }
    }
}
