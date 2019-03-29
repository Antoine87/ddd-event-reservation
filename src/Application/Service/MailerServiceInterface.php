<?php

declare(strict_types=1);

namespace App\Application\Service;

interface MailerServiceInterface
{
    /**
     * Send an email as markdown content (should send both as html and text).
     *
     * @param string          $markdownContent
     * @param string|string[] $to
     * @param string          $subject
     */
    public function sendMarkdown(string $markdownContent, $to, string $subject): void;
}
