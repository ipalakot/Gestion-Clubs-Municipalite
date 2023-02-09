<?php

namespace App\Command;

use App\Entity\User;
//use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Question\Question;
use Symfony\Component\Console\Style\SymfonyStyle;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;


class CreateAdminCliCommand extends Command
{
    protected static $defaultName = 'app:create-admin-cli';
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
        
        ->setDescription('Adding a Admin by CLI Symfony')
        ->setHelp('Adding a Admin by CLI Symfony')
        ->addOption('myOption', null, InputOption::VALUE_NONE, 'La Description de mon Option?')

        ->addArgument('noms', InputArgument::OPTIONAL, 'Noms: ')
        ->addArgument('prenoms', InputArgument::OPTIONAL, 'Prenoms')
        ->addArgument('login', InputArgument::OPTIONAL, 'Login de l admin')
        ->addArgument('email', InputArgument::OPTIONAL, 'Email')
        ->addArgument('password', InputArgument::OPTIONAL, 'Password')
        


        ;

        //->addOption('option1', null, InputOption::VALUE_NONE, 'Option description')
    ;
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $helper = $this->getHelper('question');
        $io = new SymfonyStyle($input, $output);

        $noms = $input->getArgument('noms');

            if (!$noms) {
                $question = new Question('Nom de l\'admin : ');
                $noms = $helper->ask($input, $output, $question);
            }

        $prenoms = $input->getArgument('prenoms');
            if (!$prenoms) {
                $question = new Question('Prenoms de l\'admin : ');
                $prenoms = $helper->ask($input, $output, $question);
            }

        $login = $input->getArgument('login');
            if (!$login) {
                $question = new Question('Login de l\'admin : ');
                $login = $helper->ask($input, $output, $question);
            }
        $email = $input->getArgument('email');
            if (!$email) {
                $question = new Question('Email de l\'admin : ');
                $email = $helper->ask($input, $output, $question);
            }
        $password = $input->getArgument('password');
            if (!$password) {
                $question = new Question('Le Password de l\'admin : ');
                $password= $helper->ask($input, $output, $question);
            }

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
