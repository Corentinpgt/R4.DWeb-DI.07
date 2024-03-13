<?php

namespace App\Command;

use App\Entity\Lego;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;
use Doctrine\ORM\EntityManagerInterface;

#[AsCommand(
    name: 'app:populate-database',
    description: 'Add a short description for your command',
)]
class PopulateDatabaseCommand extends Command
{
    private $entityMana;
    
    public function __construct(EntityManagerInterface $entityManager)
    {
        parent::__construct();
        $this->entityMana = $entityManager;
    }

    protected function configure(): void
    {
        $this
            ->addArgument('arg1', InputArgument::OPTIONAL, 'Argument description')
            ->addOption('option1', null, InputOption::VALUE_NONE, 'Option description')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        // $io = new SymfonyStyle($input, $output);
        // $arg1 = $input->getArgument('arg1');

        // if ($arg1) {
        //     $io->note(sprintf('You passed an argument: %s', $arg1));
        // }

        // if ($input->getOption('option1')) {
        //     // ...
        // }

        // $io->success('You have a new command! Now make it your own! Pass --help to see your options.');

        $json = file_get_contents(__DIR__."/../JSON/".$input->getArgument('arg1'));
        $json=json_decode($json);

        foreach ($json as $obj) {
            $lego = new Lego($obj->id);
            $lego->setName($obj->name);
            $lego->setCollection($obj->collection);
            $lego->setPrice($obj->price);
            $lego->setPieces($obj->pieces);
            $lego->setDescription($obj->description);
            $lego->setLegoImage($obj->images->bg);
            $lego->setBoxImage($obj->images->box);

            $this->entityMana->persist($lego);
            $this->entityMana->flush();
        }

        return Command::SUCCESS;
    }
}
