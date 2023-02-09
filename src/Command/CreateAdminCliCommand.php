<?php

namespace App\Command;

use App\Entity\User;
//use Doctrine\ORM\EntityManager;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;
use Doctrine\ORM\EntityManagerInterface;

class CreateAdminCliCommand extends Command
{
    protected static $defaultName = 'app:create-admin-cli';
    protected static $defaultDescription = 'Adding a Admin by CLI Symfony';
    private EntityManagerInterface $entityManager;


    public function __construct(EntityManagerInterface $entityManager)
    {
        parent::__construct('app:create-admin-cli');
        $this-> entityManager = $entityManager;
        $this->entityManager->flush();
    }

    protected function configure(): void
    {
        $this
        ->addArgument('noms', InputArgument::OPTIONAL, 'Noms: ')
        ->addArgument('prenoms', InputArgument::OPTIONAL, 'Prenoms')
        ->addArgument('login', InputArgument::OPTIONAL, 'Login de l admin')
        ->addArgument('email', InputArgument::OPTIONAL, 'Email')
        ->addArgument('password', InputArgument::OPTIONAL, 'Password');

        //->addOption('option1', null, InputOption::VALUE_NONE, 'Option description')
    ;
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);

        $noms = $input->getArgument('noms');
        $prenoms = $input->getArgument('prenoms');;
        $login = $input->getArgument('login');
        $email = $input->getArgument('email');
        $password = $input->getArgument('password');

        $user = (new User())
                ->setNoms($noms)
                ->setPrenoms($prenoms)        
                ->setLogin($login)
                ->setEmail($email)
                ->setPassword($password)
                ->setRoles(['ROLE_USER', 'ROLE_ADMIN']);


        $this->entityManager ->persist($user);
        $this->entityManager->flush();
       // dd($user);

        $io->success(' new admin registyration is done with SUCCESS ! ');

        return Command::SUCCESS;
    }
}
