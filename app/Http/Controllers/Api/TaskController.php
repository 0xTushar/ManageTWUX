<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Token;
use App\Models\Twitter;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function reserveAccount(Request $request)
    {
        $account = Twitter::whereStatus("working")
            ->whereUserId($request->user()->id)
            ->first(['password', 'username', 'id']);

        if ($account) {

            return $account;
        }

        Twitter::whereStatus("pending")->limit(1)->update(['status' => 'working', 'user_id' => $request->user()->id]);

        $account = Twitter::whereStatus("working")
            ->whereUserId($request->user()->id)
            ->first(['password', 'username', 'id']);

        if (!$account) {

            return ['msg' => 'stock out'];
        }

        return $account;
    }

    public function bad(Request $request, $username)
    {
        Twitter::whereUsername($username)->update(['status' => 'bad']);

        Twitter::whereStatus("pending")->limit(1)->update(['status' => 'working', 'user_id' => $request->user()->id]);

        return Twitter::whereStatus("working")
            ->whereUserId($request->user()->id)
            ->first(['password', 'username', 'id']);
    }

    public function good(Request $request, $username)
    {
        Twitter::whereUsername($username)->update(['status' => 'good']);

        if ($request->query('ihavetoken')) {
            return ['ok'];
        }

        Token::whereStatus("pending")->limit(1)->update(['status' => 'working', 'user_id' => $request->user()->id]);

        return Token::whereStatus("working")
            ->whereUserId($request->user()->id)
            ->first(['token', 'id']);
    }

    public function connected(Request $request, $tokenId, $twitterId = null)
    {
        if (!$twitterId) {
            Token::whereUserId($request->user()->id)
                ->whereId($tokenId)
                ->update(['status' => 'connected']);

            Token::whereStatus("pending")->limit(1)->update(['status' => 'working', 'user_id' => $request->user()->id]);

            return Token::whereStatus("working")
                ->whereUserId($request->user()->id)
                ->first(['token', 'id']);
        }

        $token = Token::whereStatus("working")
            ->whereUserId($request->user()->id)
            ->whereId($tokenId)
            ->update(['status' => 'connected']);

        $twitter =  Twitter::whereStatus("good")
            ->whereUserId($request->user()->id)
            ->whereId($twitterId)
            ->update(['status' => 'connected', 'token_id' => $tokenId]);

        if ($twitter && $token) {
            $request->user()->task_count = (int) $request->user()->task_count + 1;
            $request->user()->save();

            return ['taskCount' => $request->user()->task_count];
        }

        return ['error'];
    }
}
