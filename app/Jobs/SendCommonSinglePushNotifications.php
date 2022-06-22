<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Http\Controllers\admin\NotificationController;

class SendCommonSinglePushNotifications //implements ShouldQueue
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
    public function handle()
    {
        $data['user_id'] = $this->data['user_id'];
        $data['notify_user_id'] = $this->data['notify_user_id'];
        $data['post_id'] = $this->data['post_id'];
        $data['type'] = isset($this->data['type'])?$this->data['type']:"";
        $data['message'] = isset($this->data['message'])?$this->data['message']:"";
        $data['title'] = isset($this->data['title'])?$this->data['title']:"";
        //$data['post_type'] = isset($this->data['post_type'])?$this->data['post_type']:"";
        $data['obj'] = isset($this->data['obj'])?$this->data['obj']:"";
        NotificationController::store($data);
    }
}
