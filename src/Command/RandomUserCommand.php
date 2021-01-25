<?php

namespace App\Command;

use App\Repository\UserRepository;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;

class RandomUserCommand extends Command
{
    protected static $defaultName = 'app:random-user';
    private UserRepository $userRepository;
    private UrlGeneratorInterface $url;

    public function __construct(UserRepository $userRepository, UrlGeneratorInterface $url)
    {
        $this->userRepository = $userRepository;
        $this->url = $url;
        parent::__construct();
    }

    protected function configure()
    {
        $this
            ->setDescription('Get random registered user')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);

        $user = $this->userRepository->findAll();
        $user = $user[random_int(0, count($user)-1)];


        $io->text('Random username in database: ' . $user->getUsername());

        return Command::SUCCESS;
    }
}
