<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\TextMessage;

class SendTextMessages extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'sms:send';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send all unsent messages in db';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $list = TextMessage::whereSent(0)->get();
        $token = "55452F65626B673648652B334743704943376F7336413D3D";
        foreach ($list as $key => $sms) {
            $url = "https://api.kavenegar.com/v1/$token/sms/send.json?message=".urlencode($sms->body)."&receptor=$sms->receptor";
            $result = json_decode(file_get_contents($url), true);
            if ($result['return']['status'] == 200) {
                $data = [];
                $data['kid'] = $result['entries'][0]['messageid'];
                $data['sender'] = $result['entries'][0]['sender'];
                $data['cost'] = $result['entries'][0]['cost'];
                $data['sent'] = 1;
                $sms->update($data);
            }
        }
    }
}
