<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Notification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class NotificationController extends Controller
{
    public function index(){
        $notification=Notification::orderBy('created_at','desc')->get();

        return view('admin.notifications',['notifications'=>$notification]);
    }

    public function store(Request $request){
        $request->validate([
            'title'=>'required|string',
            'body'=>'required|string'
        ]);

        $response=$this->pushNotification($request->title,$request->body);

        // $status='failed';
        $responseBody=json_decode($response->body());
        // if(isset($responseBody->publishId)){
        //     $status='success';
        // }

        $status=(isset($responseBody->publishId))? 'success':'failed';

        Notification::create([
            'title'=>$this->title,
            'body'=>$this->body,
            'response'=>$response->body(),
            'status'=>$status
        ]);

        return redirect()->back();

    }

    private function pushNotification($title,$body){
        $instanceId=env('PUSHER_INSTANCE_ID');
        $secretKey=env('PUSHER_SECRET_KEY');
        $url='POST https://'.$instanceId.'.pushnotifications.pusher.com/publish_api/v1/instances/'.$instanceId.'/publishes/interests';
        
        $response=Http::withHeaders([
            'Authorization'=>'Bearer '.$secretKey,
            'Content-type'=>'application/json'
        ])->post($url,[
            'interests'=>['hello'],
            'web'=>[
                'notification'=>[
                    'title'=>$title,
                    'body'=>$body
                ]
            ],
        ]);

        return $response;
    }

}
