<?php

namespace Hiera\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Hiera\Hiera;
use Hiera\Scope;
use Hiera\ConfigLoader\YamlConfigLoader;

use RuntimeException;

class LookupCommand extends Command
{
    protected function configure()
    {
        $this
        ->setName('hiera:lookup')
        ->setDescription('Lookup a hiera key')
        ->addArgument(
            'key',
            InputArgument::REQUIRED,
            'key'
        )
        ;
    }

    public function execute(InputInterface $input, OutputInterface $output)
    {
        $key = $input->getArgument('key');
        
        $output->write("Hiera-PHP: looking up key `$key`\n");

        $scope = new Scope();
        $scope->setVariable('::environment', 'production');
        $scope->setVariable('::clientcert', 'web01.dc1.example.webx');
        $scope->setVariable('::country', 'nl');
        $hiera = new Hiera();
        $loader = new YamlConfigLoader();
        $loader->load($hiera, __DIR__ . '/../../examples/hiera.yaml');
        
        $answer = $hiera->lookup($key, '#default#', $scope);
        $output->write("Answer: `$answer`\n");
    }
}
