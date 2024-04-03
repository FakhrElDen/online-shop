<?php

namespace App\Http\Controllers;

use App\User;
use App\Status;
use App\BrandSetting;
use App\Mail\SendMail;
use App\Mail\ForgotPassword;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class UserController extends Controller
{
    public function register(Request $request)
    {
        $input = $request->all();

        if (User::getUser($input['email'])) {
            return Status::mergeStatus(['data' => $input], 4016);
        }

        if ($input['password'] !== $input['confirm_password']) {
            return Status::mergeStatus(['data' => $input], 5013);
        }

        $input['password'] = Hash::make($input['password']);
        $user = User::create($input);

        Mail::to($input['email'])->send(new SendMail(['name' => $input['name'], 'email' => $input['email']]));

        return Status::mergeStatus(['data' => ['name' => $input['name'], 'email' => $input['email']]], 200);
    }

    public function login(Request $request)
    {
        $email = $request->email;
        $password = $request->password;
        $user = User::getUser($email);

        if (!$user || !Hash::check($password, $user['password'])) {
            return Status::mergeStatus(['data' => ['email' => $email, 'password' => $password]], 5013);
        }

        return Status::mergeStatus(['data' => $user], 200);
    }

    public function activeUser($email)
    {
        User::activeUser($email);
        return redirect('http://localhost:4200/');
    }

    public function resendConfirmationEmail($email)
    {
        $user = User::getUserByEmail($email);
        Mail::to($user['email'])->send(new SendMail(['name' => $user['name'], 'email' => $user['email']]));

        return Status::mergeStatus(['data' => ['name' => $user['name'], 'email' => $user['email']]], 200);
    }

    public function checkEmail(Request $request)
    {
        $user = User::getUser($request['email']);

        if ($user) {
            Mail::to($user['email'])->send(new ForgotPassword(['id' => $user['id'], 'name' => $user['name'], 'email' => $user['email']]));
            return Status::mergeStatus(['data' => $user['email']], 200);
        }

        return Status::mergeStatus([], 5017);
    }

    public function resetPassword(Request $request, $email)
    {
        $input = $request->all();
        $user = User::getUser($email);

        if ($input['password'] !== $input['confirm_password']) {
            return Status::mergeStatus(['password' => $input['password'], 'confirm_password' => $input['confirm_password']], 5013);
        }

        $password = Hash::make($input['password']);
        User::updatePassword($user['id'], $password);

        return Status::mergeStatus(['data' => $input['password']], 200);
    }

    public function resendMailForResetPassword($email)
    {
        $user = User::getUser($email);
        Mail::to($user['email'])->send(new ForgotPassword(['id' => $user['id'], 'name' => $user['name'], 'email' => $user['email']]));

        return Status::mergeStatus(['data' => $user['email']], 200);
    }

    public function addToCartCheck($user_id)
    {
        $user = User::checkActive($user_id);
        return Status::mergeStatus(['data' => $user], 200);
    }

    public function updateUserData(Request $request)
    {
        $input = $request->all();
        User::saveUserData($input);

        return Status::mergeStatus(['data' => $input], 200);
    }

    public function getBrandSetting()
    {
        $brandSetting = BrandSetting::getBrandSetting();
        return Status::mergeStatus(['data' => $brandSetting], 200);
    }
}
