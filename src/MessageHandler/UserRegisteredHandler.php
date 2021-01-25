<?php


namespace App\MessageHandler;


use App\Message\UserMessage;
use App\Repository\UserRepository;
use Psr\Log\LoggerInterface;
use Symfony\Component\Messenger\Handler\MessageHandlerInterface;

class UserRegisteredHandler implements MessageHandlerInterface
{
    private LoggerInterface $logger;
    private UserRepository $userRepository;

    public function __construct(LoggerInterface $logger, UserRepository $userRepository)
    {
        $this->logger = $logger;
        $this->userRepository = $userRepository;
    }

    public function __invoke(UserMessage $message)
    {
        $user = $this->userRepository->find($message->getId());

        $this->logger->info('User '.$user->getUsername().' registered');
    }
}