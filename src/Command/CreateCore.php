<?php
namespace Geosan\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputOption;


use Geosan\Manipulate\CreateManipulate;

class CreateCore extends Command{

	protected $extendsAvailable = [
		'benchmark',
		'config',
		'controller',
		'exceptions',
		'hooks',
		'input',
		'language',
		'loader',
		'log',
		'output',
		'router',
		'security',
		'uri',
		'utf8'
	];

	protected function configure(){
		$this->setName("create:core")
		->setDescription('Create new Core')
		->setHelp("This command is used to create new Core");

		$this->addArgument('name', InputArgument::REQUIRED, 'The model name')
		->addArgument('extends', InputArgument::OPTIONAL, 'The class that will extend the Core');

		$this->addOption('prefix', null,  InputOption::VALUE_OPTIONAL, 'The prefix of Core, default is CI', 1);
	}

	protected function execute(InputInterface $input, OutputInterface $output){
		$name = $input->getArgument('name');
		$extends = (is_null($input->getArgument('extends'))) ? false : $input->getArgument('extends');
		$prefix = (strlen($input->getOption('prefix')) > 1) ? $input->getOption('prefix') : false;

		if($extends !== false and !in_array($extends, $this->extendsAvailable))
			return $output->writeln("<error>{$extends} is not a valid class to be extended</error>");

		$createManipulate = new CreateManipulate();
		$createManipulate->successCreate = "<info>Core created with success!</info>";

		return $output->writeln($createManipulate->createCore($name, $extends, $prefix));
	}

}