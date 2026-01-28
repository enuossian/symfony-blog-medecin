<?php

namespace App\Command;

use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;

#[AsCommand(name: 'app:test-email')]
class TestEmailCommand extends Command
{
    public function __construct(private MailerInterface $mailer)
    {
        parent::__construct();
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        try {
            $email = (new Email())
                ->from('test@example.com')
                ->to('test@example.com')
                ->subject('Test Mailtrap')
                ->text('Si vous voyez ceci, ça fonctionne !');

            $this->mailer->send($email);
            $output->writeln('✅ Email envoyé avec succès !');
            return Command::SUCCESS;
        } catch (\Exception $e) {
            $output->writeln('❌ ERREUR : ' . $e->getMessage());
            $output->writeln('Trace : ' . $e->getTraceAsString());
            return Command::FAILURE;
        }
    }
}