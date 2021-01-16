<?php

namespace Aujicini\Moderation\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class ImpersonationController extends BaseController
{
    /**
     * Impersonate another user.
     *
     * @param string $id The user to impersonate.
     *
     * @return \Illuminate\Http\RedirectResponse Returns the impersonation response.
     */
    public function take($id)
    {
        $user = User::find($id);
        if (!$user) {
            abort(403);
        }
        if (!$user->canBeImpersonated() || !Auth::user()->canImpersonate()) {
            abort(403);
        }
        Auth::user()->impersonate($user);
        return redirect()->to(config('moderation.impersonation_take_location'));
    }

    /**
     * Leave user impersonation.
     *
     * @return \Illuminate\Http\RedirectResponse Returns the impersonation response.
     */
    public function leave()
    {
        if (!Auth::user()->isImpersonating()) {
            abort(403);
        }
        Auth::user()->leaveImpersonation();
        return redirect()->to(config('moderation.impersonation_leave_location'));
    }
}
