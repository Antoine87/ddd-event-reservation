<?php

declare(strict_types=1);

namespace App\Infrastructure\Container\Application\Service;

use App\Application\Service\MailerServiceInterface;
use Parsedown;
use Swift_Mailer;
use Swift_Message;
use Zend\Expressive\ZendView\ZendViewRenderer;

class MailerService implements MailerServiceInterface
{
    private $parsedown;
    private $mailer;
    private $appSenders;
    private $renderer;

    /**
     * @param Parsedown        $parsedown
     * @param Swift_Mailer     $mailer
     * @param string|string[]  $appSenders
     * @param ZendViewRenderer $renderer
     */
    public function __construct(Parsedown $parsedown, Swift_Mailer $mailer, $appSenders, ZendViewRenderer $renderer)
    {
        $this->parsedown = $parsedown;
        $this->mailer = $mailer;
        $this->appSenders = $appSenders;
        $this->renderer = $renderer;
    }

    public function sendMarkdown(string $markdownContent, $to, string $subject): void
    {
        $html = $this->renderer->render('mail::styled-content', [
            'layout' => 'layout::mail',
            'content' => $this->parsedown->text($markdownContent)
        ]);

        $text = $markdownContent;

        $message = (new Swift_Message($subject))
            ->setFrom($this->appSenders)
            ->setTo($to)
            ->setBody($html, 'text/html')
            ->addPart($text, 'text/plain')
        ;
        $this->mailer->send($message);
    }
}
