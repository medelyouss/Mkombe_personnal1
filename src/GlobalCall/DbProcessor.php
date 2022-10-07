<?php
namespace App\GlobalCall;

use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\Security\Core\Security;

class DbProcessor{


    private $request;
    private $security;

    public function __construct(RequestStack $requestStack, Security $security)
    {
        $this->request = $requestStack->getCurrentRequest();
        $this->security = $security;
    }

    public function __invoke(array $record)
    {
        //Modification de record pour pour l'ajout de nos infos

        $record['extra']['clientIp'] = $this->request->getClientIp();
        $record['extra']['url'] = $this->request->getBaseUrl();


        $record['extra']['user'] = $this->security->getUser();

        return $record;
    }
}