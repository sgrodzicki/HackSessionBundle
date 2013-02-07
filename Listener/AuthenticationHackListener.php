<?php

namespace Gilles\Bundle\HackSessionBundle\Listener;

use Symfony\Component\HttpKernel\Event\GetResponseEvent;
use Symfony\Component\HttpFoundation\Session\Session;

class AuthenticationHackListener
{
    protected $session;
    
    public function __construct(Session $session)
    {
        $this->session = $session;
    }
    
    public function onKernelRequest(GetResponseEvent $event)
    {
        $request = $event->getRequest();
        if (!$request->hasPreviousSession()) {
            $request->cookies->set(session_name(), 'tmp');
            $request->setSession($this->session);
        }
    }
}
