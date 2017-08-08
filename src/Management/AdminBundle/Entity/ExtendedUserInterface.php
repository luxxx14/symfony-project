<?php

namespace Management\AdminBundle\Entity;

use Symfony\Component\Security\Core\User\AdvancedUserInterface;
use Symfony\Component\Security\Core\Exception\AccountStatusException;
use Symfony\Component\Security\Core\Exception\AccountExpiredException;
use Symfony\Component\Security\Core\Exception\LockedException;
use Symfony\Component\Security\Core\Exception\CredentialsExpiredException;
use Symfony\Component\Security\Core\Exception\DisabledException;

/**
 * Adds extra features to a user class related to account status flags.
 *
 * This interface can be implemented in place of AdvancedUserInterface
 * if you'd like the authentication system to consider different account
 * status flags during authentication and compare users by their E-Mail
 * addresses. If any of the methods in this interface return false,
 * authentication will fail.
 *
 * If you need to perform custom logic for any of these situations, then
 * you will need to register an exception listener and watch for the specific
 * exception instances thrown in each case. All exceptions are a subclass
 * of AccountStatusException
 *
 * @see AdvancedUserInterface
 * @see AccountStatusException
 */
interface ExtendedUserInterface extends AdvancedUserInterface {
    /**
     * Returns the E-Mail address of the user.
     *
     * @return string
     */
    public function getEmail();
}