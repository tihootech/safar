<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Jenssegers\Agent\Agent;
use Carbon\Carbon;


class Session extends Model
{
    use HasFactory;
    protected $appends = ['same', 'devtype', 'devname', 'platform', 'browser', 'last_activity_date'];

    public function getSameAttribute()
    {
        return $this->user_agent == $_SERVER['HTTP_USER_AGENT'];
    }

    public function getDevtypeAttribute()
    {
        $agent = new Agent();
        $agent->setUserAgent($this->user_agent);
        return $agent->isMobile() ? __('MOBILE') : ( $agent->isTablet() ? __('TABLET') : __('COMPUTER') );
    }

    public function getDevnameAttribute()
    {
        $agent = new Agent();
        $agent->setUserAgent($this->user_agent);
        return $agent->device();
    }

    public function getPlatformAttribute()
    {
        $agent = new Agent();
        $agent->setUserAgent($this->user_agent);
        return $agent->platform();
    }

    public function getBrowserAttribute()
    {
        $agent = new Agent();
        $agent->setUserAgent($this->user_agent);
        return $agent->browser();
    }

    public function getLastActivityDateAttribute()
    {
        return Carbon::createFromTimestamp($this->last_activity);
    }
}
