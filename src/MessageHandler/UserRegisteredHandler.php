<?php


namespace App\MessageHandler;


use App\Message\UserMessage;
use App\Repository\UserRepository;
use Psr\Log\LoggerInterface;
use Symfony\Bridge\Twig\Mime\NotificationEmail;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Messenger\Handler\MessageHandlerInterface;

class UserRegisteredHandler implements MessageHandlerInterface
{
    private LoggerInterface $logger;
    private UserRepository $userRepository;
    private MailerInterface $mailer;
    private string $adminEmail;

    public function __construct(LoggerInterface $logger, UserRepository $userRepository, MailerInterface $mailer, string $adminEmail)
    {
        $this->logger = $logger;
        $this->userRepository = $userRepository;
        $this->mailer = $mailer;
        $this->adminEmail = $adminEmail;
    }

    public function __invoke(UserMessage $message)
    {
        $user = $this->userRepository->find($message->getId());

        $this->logger->info('User '.$user->getUsername().' registered');

        $this->mailer->send((new NotificationEmail())
                     ->subject('Welcome to the site')
                     ->htmlTemplate('emails/welcome.html.twig')
                     ->from($this->adminEmail)
                     ->to($user->getEmail())
                     ->context(['user' => $user])
        );
    }
}