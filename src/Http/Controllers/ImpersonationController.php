<?php

namespace NycuCsit\Impersonation\Http\Controllers;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class ImpersonationController extends Controller
{
    public function __construct()
    {
        $this->middleware('web');
    }

    /**
     * Show the user list.
     */
    public function listUser()
    {
        Gate::authorize('impersonate', Auth::user());

        $users = $this->getUsers();
        $columns = $this->getTableColumns();
        $authIdentifierName = Auth::user()->getAuthIdentifierName();

        return view('impersonation::list', [
            'users' => $users,
            'columns' => $columns,
            'authIdentifierName' => $authIdentifierName,
        ]);
    }

    /**
     * Start impersonating the user.
     */
    public function impersonateUser(Request $request)
    {
        Gate::authorize('impersonate', Auth::user());

        $id = $request->input('id');
        Auth::loginUsingId($id);

        return redirect(config('impersonation.post_impersonation_route', '/'));
    }

    /**
     * Get user model from `config('auth.provideres.users.model')`.
     *
     * @return Model
     */
    public function getUserModel(): Model
    {
        $userModelName = config('auth.providers.users.model');
        return new $userModelName();
    }

    /**
     * Get users from databases.
     *
     * @return Collection List of users.
     */
    public function getUsers(): Collection
    {
        $userModel = $this->getUserModel();
        return $userModel::all();
    }

    /**
     * Get the columns that is going to be displayed.
     *
     * @return array
     */
    public function getTableColumns(): array
    {
        $displayColumns = config('impersonation.display_columns');
        if (is_array($displayColumns) && count($displayColumns) > 0) {
            return $displayColumns;
        }

        $userModel = $this->getUserModel();
        $sampleUser = $userModel::first();
        return array_keys($sampleUser->getAttributes());
    }
}
