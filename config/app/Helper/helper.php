<?php

use App\Models\User;
use Illuminate\Support\Facades\Auth;

/**
 * @return bool
 * @since 17/01/2024
 * @author Surinder rana < Sindu.97@gmail.com>
 * Check user is company admin or gym owner
 */
if (!function_exists('isCompanyAdmin')) {
    function isCompanyAdmin(): bool
    {
        return user() && user()->roleUser->roleName->slug == COMPANY_ADMIN;
    }
}

/**
 * @return bool
 * @since 17/01/2024
 * @author Surinder rana < Sindu.97@gmail.com>
 * Check user is company subscriber or gym subscriber
 */
if (!function_exists('isCompanyUser')) {
    function isCompanyUser(): bool
    {
        return user()->roleUser->roleName->slug == USER;
    }
}

/**
 * @return bool
 * @since 17/01/2024
 * @author Surinder rana < Sindu.97@gmail.com>
 * Set the Authenticate user in the function user()
 */

if (!function_exists('user')) {
    function user(): ?User
    {
        return  Auth::user();
    }
}
