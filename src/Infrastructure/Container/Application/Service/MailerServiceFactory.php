<?php

declare(strict_types=1);

namespace App\Infrastructure\Container\Application\Service;

use App\Application\Service\MailerServiceInterface;
use Parsedown;
use Psr\Container\ContainerInterface;
use Swift_Mailer;
use Swift_SmtpTransport;
use Zend\Expressive\ZendView\ZendViewRenderer;

class MailerServiceFactory
{
    public function __invoke(ContainerInterface $container): MailerServiceInterface
    {
        $config = $container->get('config');

        $swiftmailer = $config['mail']['swiftmailer'];

        $transport = (new Swift_SmtpTransport($swiftmailer['host'], $swiftmailer['port'], $swiftmailer['encryption']))
            ->setUsername($swiftmailer['username'])
            ->setPassword($swiftmailer['password'])
        ;

        return new MailerService(
            new Parsedown(),
            new Swift_Mailer($transport),
            $config['mail']['app_senders'],
            $container->get(ZendViewRenderer::class)
        );
    }
}
