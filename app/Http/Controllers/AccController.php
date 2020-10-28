<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Session;
use App\Models\Employee;
use App\Models\TextMessage;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;


class AccController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('managers')->except(['currentUser', 'deleteSession']);
    }

    public function allUsers()
    {
        $users = User::query();
        $users = $users->where('type', '!=', 'admin');
        if (user()->isManager()) {
            $agency = currentAgency();
            $ids = Employee::where('agency_id', $agency->id)->pluck('user_id')->toArray();
            $users = $users->whereIn('id', $ids);
        }
        return $users->with('sessions')->get();
    }

    public function changeActivationStatus(User $user)
    {
        checkIfManagerHasAccessToThisUser($user);
        $user->active = !$user->active;
        $user->save();
        return ['success' => true, 'active' => $user->active];
    }

    public function changePasswordByAdmin(User $user)
    {
        // access check
        checkIfManagerHasAccessToThisUser($user);

         // change user password
        $newPassword = rand(100000,999999);
        $user->password = bcrypt($newPassword);
        $user->save();

        // text message
        if ($user->phone) {
            $body = __('PASSWORD_CHANGED_SMS', ['pass' => $newPassword]);
            TextMessage::make($user->phone, $body);
            return ['success' => true, 'pass' => $newPassword];
        }else {
            return ['nophone' => true, 'pass' => $newPassword];
        }

    }

    public function currentUser()
    {
        return User::where('id', auth()->id())->with(['sessions', 'employee'])->first();
    }

    public function getUser(User $user)
    {
        checkIfManagerHasAccessToThisUser($user);
        return $user;
    }

    public function updatePassword(User $user, Request $request)
    {
        // access check
        checkIfManagerHasAccessToThisUser($user);

        $errors = [];
        if (!Hash::check($request->old, $user->password)) {
            $errors []= __('WRONG_OLD_PASSWORD');
        }
        if ($request->new != $request->confirm) {
            $errors []= __('PASSWORDS_ARE_NOT_SAME');
        }
        if (strlen($request->new) < 6) {
            $errors []= __('AT_LEAST_6_CHARACTERES_REQUIRED_FOR_NEW_PASSWORD');
        }
        if (count($errors)) {
            return ['success' => false, 'errors' => $errors];
        }else {
            $user = auth()->user();
            $user->password = bcrypt($request->new);
            $user->save();
            return ['success' => true, 'errors' => $errors];
        }
    }

    public function updateUser(User $user, Request $request)
    {
        // access check
        checkIfManagerHasAccessToThisUser($user);

        $currentLoggedInUser = auth()->user();
        $data = $request->validate([
            "name" => "required|string",
            "email" => "required|string|unique:users,email,$user->id",
            "phone" => "nullable",
        ]);
        if ($currentLoggedInUser->isAdmin() || $currentLoggedInUser->isManager() || $currentLoggedInUser->id == $user->id) {
            $user->update($data);
            return ['success' => true];
        }else {
            abort(403);
        }
    }

    public function deleteSession(Request $request)
    {
        $session = Session::where('user_id', $request->user_id)->where('user_agent', $request->user_agent)->firstOrFail();
        $currentLoggedInUser = auth()->user();
        if ($currentLoggedInUser->id == $session->user_id) {
            $session->delete();
            return ['success' => true];
        }else {
            abort(403);
        }
    }
}
