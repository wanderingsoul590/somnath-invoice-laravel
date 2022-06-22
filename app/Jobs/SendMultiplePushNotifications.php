<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Http\Controllers\admin\NotificationController;

class SendMultiplePushNotifications implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    protected $data;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($data)
    {
        $this->data = $data;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle(){
        
        if(isset($this->data['user_lists'])){
            foreach ($this->data['user_lists'] as $value) {
                $data['user_id'] =$this->data['user_id'];
                $data['notify_user_id'] = $value->id;
                $data['post_id'] = $this->data['post_id'];
                $data['type'] = isset($this->data['type'])?$this->data['type']:"";
                $data['title'] = isset($this->data['title'])?$this->data['title']:"";
                $data['message'] = isset($this->data['message'])?$this->data['message']:'';
                $data['send_by_web'] = isset($this->data['send_by_web'])?$this->data['send_by_web']:0;
                NotificationController::store($data);
            }
        }
       
    }
}
