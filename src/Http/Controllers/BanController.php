<?php

namespace Aujicini\Moderation\Http\Controllers;

use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Auth;

class BanController extends BaseController
{
    /**
     * Ban user.
     *
     * @param string $id The user to ban.
     *
     * @return \Illuminate\Http\RedirectResponse Returns the ban response.
     */
    public function ban($id)
    {
        $user = User::find($id);
        if (!$user) {
            abort(403);
        }
        if (!$user->bannable()
            || !Auth::user()->canBan($user)) {
            abort(403);
        }
        $user->ban();
        return $request->wantsJson()
            ? new JsonResponse('', 200)
            : redirect()->to(config('moderation.ban_location'));
    }

    /**
     * Ipban user.
     *
     * @param string $id The user to ipban.
     *
     * @return \Illuminate\Http\RedirectResponse Returns the ban response.
     */
    public function ipban($id)
    {
        $user = User::find($id);
        if (!$user) {
            abort(403);
        }
        if (!$user->ipBannable()
            || !Auth::user()->canIpBan($user)) {
            abort(403);
        }
        $user->ban(true);
        return $request->wantsJson()
            ? new JsonResponse('', 200)
            : redirect()->to(config('moderation.ipban_location'));
    }

    /**
     * Unban user.
     *
     * @param string $id The user to unban.
     *
     * @return \Illuminate\Http\RedirectResponse Returns the ban response.
     */
    public function unban($id)
    {
        $user = User::find($id);
        if (!$user) {
            abort(403);
        }
        if (!$user->isBanned()) {
            abort(403);
        }
        $user->unban();
        return $request->wantsJson()
            ? new JsonResponse('', 200)
            : redirect()->to(config('moderation.unban_location'));
    }
}
