<?php

namespace Sarps;

use Sarps\Mailer\Mailer;

use splitbrain\phpcli\CLI;
use splitbrain\phpcli\Options;

use Sarps\Logger\Logger;
use Sarps\Logger\Moby as MobyLogger;
use Sarps\Logger\Email as EmailLogger;
use Sarps\Logger\FrontDesk as FrontDeskLogger;
use Sarps\Logger\NewsLetter as NewsLetterLogger;
use Sarps\Logger\OnlineBanking as OnlineBankingLogger;

/**
 * @author  Emmanuel Oppong-Sarpong
 * @since   February 8, 2019
 * @link    https://github.com/Sarps/bulk-mailer
 * @version 1.0.0
 */
class LaunchPad
{

    protected $mail;
    protected $subject;
    protected $view;
    /**
     * @var MailRequest $request
     */
    protected $request;

    public function __construct()
    {
        $this->mail = new Mailer;
        $this->mail->From = getenv('FROM_MAIL');
        $this->mail->FromName = getenv('FROM_NAME');
        $this->mail->isHTML(getenv('IS_HTML'));
        if (getenv('IS_SMTP') == 'true') {
            $this->mail->isSMTP();
            $this->mail->Host = getenv('SMTP_HOST');
            $this->mail->SMTPAuth = getenv('SMTP_AUTH');
            $this->mail->Username = getenv('SMTP_USER');
            $this->mail->Password = getenv('SMTP_PASS');
            $this->mail->SMTPSecure = getenv('SMTP_SECURE');
            $this->mail->Port = getenv('TCP_PORT');
        }
    }

    public function sendMail()
    {
        foreach ($this->addresses() as $address) {
            $this->mail->addAddress($address);
        }
        $this->mail->Subject = $this->subject();
        $this->mail->loadBodyFromView($this->view(), $this->request);

        if (!$this->mail->send()) {
            $this->error("Mailer Error: " . $this->mail->ErrorInfo);
            return false;
        }
        $this->success("Message has been sent successfully");
        return true;
    }

    public function email()
    {
        return '';
    }

    public function view()
    {
        return '';
    }

    public function subject()
    {
        return '';
    }

    public function addresses()
    {
        return [];
    }

    public function mailingStartCallback()
    {

    }

    public function mailSentCallback($index, $email, $data)
    {

    }

    public function mailFailedCallback($index, $email, $data)
    {

    }

    public function mailingCompleteCallback()
    {

    }

    public function __destruct(){}

}