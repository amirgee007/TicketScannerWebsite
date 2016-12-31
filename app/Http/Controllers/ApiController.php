<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class ApiController extends Controller
{
    public function api()
    {
        return response()->json([
            'name' => 'Abigail',
            'state' => 'CA'
        ]);
    }

    public function createToken(Request $request)
    {
        if ($request->isMethod('post')) {
            $user = DB::table('users')->where('email', $request->input('email'))->first();
            if (isset($user) && Hash::check($request->input('password'), $user->password)) {
                return response()->json([
                    'state' => true,
                    'userName' => $user->name,
                    'userMail' => $user->email,
                    'api_token' => $user->api_token,
                ]);
            }

            //When false password or non-existing user
            return response()->json([
                'state' => false,
            ]);
        }
    }

    public function getEvents(Request $request)
    {
        if ($request->isMethod('post') && $id = $this->checkApiToken($request->input('api_token'))) {
            $events = DB::table('events')->where('owner_id', $id)->get();
            return response()->json([
                'state' => true,
                'events' => $events,
            ]);
        }else{
            return response()->json([
                'state' => false,
            ]);
        }
    }
    public function getSingleEvent($data, Request $request)
    {
        if ($request->isMethod('post') && $id = $this->checkApiToken($request->input('api_token'))) {
            if($event = DB::table('events')->where(['owner_id'=> $id, 'id' => $data])->first())
            {
                $codes = DB::table('codes')->where(['event_id'=> $event->id])->get();
                return response()->json([
                    'state' => true,
                    'codes' => $codes,
                ]);
            }else{
                return response()->json([
                    'state' => false,
                ]);
            }
        }else{
            return response()->json([
                'state' => false,
            ]);
        }
    }
    public function getCode($data, Request $request)
    {
        if ($request->isMethod('post') && $userId = $this->checkApiToken($request->input('api_token'))) {
            if($code = DB::table('codes')->where(['id'=> $data])->first() )
            {
                if($event = DB::table('events')->where(['owner_id'=> $userId, 'id' => $code->event_id])->first()){
                    $code = DB::table('codes')->where(['event_id'=> $event->id, 'id' => $data])->first();
                    $newState = $request->input('state');
                    if(!isset($newState)){
                        return response()->json([
                            'state' => true,
                            'code' => $code,
                        ]);
                    }elseif($newState == 'false'){
                        $updatedCode = DB::table('codes')
                            ->where(['id'=> $data])
                            ->update(['state' => 'false']);
                        return response()->json([
                            'state' => true,
                            'update' => $updatedCode,
                        ]);
                    }

                }
            }
        }
        return response()->json([
            'state' => false,
        ]);
    }
    public function checkApiToken($token)
    {
        $user = DB::table('users')->where('api_token', $token)->first();
        if ($user) {
            return $user->id;
        }
        return false;
    }
}
