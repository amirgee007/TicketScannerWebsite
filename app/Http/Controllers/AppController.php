<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;


class AppController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function event()
    {
        return view('pages/event/event');
    }
    public function eventAdd()
    {
        return view('pages/event/add');
    }
    public function appLaunch()
    {
        return view('pages/app');
    }
    public function eventEdit()
    {
        $id = Auth::id();
        $events = DB::table('events')->where('owner_id', $id)->get();
        //return json_decode(json_encode((array) $events), true);
        //return $data;
        if (isset($events)){
            //$data = json_decode(json_encode((array) $events), true);
            //return $data;
            return view('pages/event/edit', ['data' => $events]);
        }else{
            return view('pages/event/edit');
        }
        //
    }
    // Add logic
    public function eventList($data)
    {
        $id = Auth::id();
        $events = DB::table('events')->where(['owner_id'=> $id, 'id' => $data])->first();
        $codes = DB::table('codes')->where(['event_id'=> $data])->get();
        return view('pages/event/list', ['data' => $events, 'codes' => $codes]);

    }
    public function Add(Request $request)
    {

        //return view('pages/event/add', ['request' => $request]);
        //$this->validateAdd($request);
        if ($request->isMethod('post')) {
            //return $request->input('eventCodes');

            //Add values to db
            $pdo = DB::connection()->getPdo();
            $id = Auth::id();
            $result = DB::table('events')->insert(
                array('name' => $request->input('eventName'), 'owner_id' => $id)
            );
            if ( $result )  {
                $rowId = $pdo->lastInsertId();

                foreach(preg_split("/((\r?\n)|(\r\n?))/", $request->input('eventCodes')) as $code){
                    DB::table('codes')->insert(
                        array('event_id' => $rowId, 'code' => $code, 'state' => 'true')
                    );
                }


            }



            return view('pages/event/add', ['data' => $request]);
        }


        return $this->sendFailedAddResponse($request);
    }

    protected function attemptAdd(Request $request)
    {
        return true;
    }

    protected function validateAdd(Request $request)
    {
        $this->validate($request, [
            'eventCodes' => 'required', 'password' => 'required',
        ]);
    }
    protected function sendFailedAddResponse(Request $request)
    {
        return redirect()->back()
            ->withInput($request->only('eventCodes', 'eventName'))
            ->withErrors([
                'eventCodes' => "Error occured",
                'eventName' => "Error occured",
            ]);
    }
}
