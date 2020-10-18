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

    public function sendBulkMail()
    {
        $index = 0;
        $mail = $this->getMail(0);
        $data = $this->getData(0);

        $this->mailingStartCallback();

        while ($mail) {

            $index++;
            $this->info("Sending {$index} to {$mail}");

            if (gettype($data) != "array") {

                if ($data == false) {
                    return $this->error('Insufficient data to continue operation');
                }

                return $this->error('Data in "$data" must be at least, 2-dimensional array or that returned by "getData($index) must be at least 1-dimensional"');
            }

            if ($this->sendMail($mail, $data)) {
                $this->mailSentCallback($index - 1, $mail, $data);
            } else {
                $this->mailFailedCallback($index - 1, $mail, $data);
            }

            sleep(2);

            $mail = $this->getMail($index);
            $data = $this->getData($index);
        }

        $this->mailingCompleteCallback();

    }

    public function sendMail()
    {
        foreach ($this->addresses() as $address) {
            $this->mail->addAddress($address);
        }
        $this->mail->Subject = $this->subject();
        $this->mail->loadBodyFromView($this->view(), $data);

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

    public function __destruct()
    {
    }

}