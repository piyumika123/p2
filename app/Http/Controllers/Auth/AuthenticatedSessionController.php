<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use App\Models\User;
use Illuminate\Support\Facades\Log;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        $request->authenticate();

        $request->session()->regenerate();

        $user = Auth::user();
        $positionId = $user->position_id;

        Log::info('User ID: ' . $user->id);
        Log::info('User email: ' . $user->email);
        Log::info('User position ID: ' . $positionId);

        // Convert position ID to integer if it's a string
        $positionId = match ($positionId) {
            'MGR' => 1,
            'WH' => 2,
            'SM' => 3,
            default => (int) $positionId,
        };

        if (!in_array($positionId, [1, 2, 3])) {
            Log::error('Unhandled position ID: ' . $positionId);
            throw new \Exception("Unhandled match case '$positionId'");
        }

        $dashboardRoute = match ($positionId) {
            1 => 'manager.dashboard',
            2 => 'warehouse.dashboard',
            3 => 'supermarket.dashboard',
        };

        Log::info('Redirecting to route: ' . $dashboardRoute);

        return redirect()->intended(route($dashboardRoute));
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
