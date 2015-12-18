<?php

namespace Pagekit\User\Event;

use Pagekit\Application as App;
use Pagekit\Auth\Auth;
use Pagekit\Auth\Event\AuthenticateEvent;
use Pagekit\Auth\Event\AuthorizeEvent;
use Pagekit\Auth\Event\LoginEvent;
use Pagekit\Auth\Event\LogoutEvent;
use Pagekit\Auth\Exception\AuthException;
use Pagekit\Event\EventSubscriberInterface;
use Pagekit\User\Auth\UserProvider;

class AuthorizationListener implements EventSubscriberInterface
{
    /**
     * Initialize system.
     */
    public function onSystemInit()
    {
        App::auth()->setUserProvider(new UserProvider(App::get('auth.password')));
    }

    /**
     * Logout blocked users.
     */
    public function onRequest()
    {
        if ($user = App::auth()->getUser() and $user->isBlocked()) {
            App::auth()->logout();
        }
    }

    /**
     * Blocks users that are either not activated or blocked.
     *
     * @param  AuthorizeEvent $event
     * @throws AuthException
     */
    public function onAuthorize(AuthorizeEvent $event)
    {
        if ($event->getUser()->isBlocked()) {
            throw new AuthException($event->getUser()->login ? __('Your account is blocked.') : __('Your account has not been activated.'));
        }
    }

    /**
     * Redirects a user after successful login.
     *
     * @param LoginEvent $event
     * @param bool $auto Auto-login with remember me
     */
    public function onLogin(LoginEvent $event, $auto = false)
    {
<<<<<<< HEAD
        if (!$auto) {
            $event->setResponse(App::response()->redirect(App::request()->get(Auth::REDIRECT_PARAM)));
        }
=======
        App::session()->migrate();

        $event->setResponse(App::redirect(App::request()->get(Auth::REDIRECT_PARAM)));
>>>>>>> develop
    }

    /**
     * Redirects a user after successful logout.
     *
     * @param LogoutEvent $event
     */
    public function onLogout(LogoutEvent $event)
    {
        $event->setResponse(App::redirect(App::request()->get(Auth::REDIRECT_PARAM)));
    }

    public function onSuccess()
    {
        App::session()->remove(Auth::LAST_USERNAME);
    }

    public function onFailure(AuthenticateEvent $event)
    {
        $credentials = $event->getCredentials();
        App::session()->set(Auth::LAST_USERNAME, $credentials['username']);
    }

    /**
     * {@inheritdoc}
     */
    public function subscribe()
    {
        return [
            'request' => [
                ['onRequest', 0],
                ['onSystemInit', 50]
            ],
            'auth.authorize' => 'onAuthorize',
            'auth.login'     => ['onLogin', -8],
            'auth.logout'    => ['onLogout', -8],
            'auth.success'    => 'onSuccess',
            'auth.failure'    => 'onFailure'
        ];
    }
}
