<?php
namespace src\Service;

use App\Entity\Produits;
use Twig\Environment;

class MailTestServices{
    private $mailer;
    private $render;

    public function __construct(\Swift_Mailer $mailer, Environment $render)
    {
        $this->mailer = $mailer;
        $this->render = $render;
    }

    public function sendProduit(Produits $produit){
        $message = (new \Swift_Message('Mail Auto'))
            ->setFrom('flierville@cesi.fr')
            ->setTo('flierville@cesi.fr')
            ->setReplyTo('flierville@cesi.fr')
            ->setBody($this->render->render('mail.html.twig', [
                'produit' => $produit
            ]));

        $this->mailer->send($message);

    }

}