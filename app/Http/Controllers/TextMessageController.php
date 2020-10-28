<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TextMessage;

class TextMessageController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('admin');
    }

    public function index()
    {
        return TextMessage::latest()->get();
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'body' => 'required|string',
            'receptor' => 'required|string',
        ]);
        TextMessage::create($data);
        return ['success' => true];
    }

    public function resend($id)
    {
        $sms = TextMessage::findOrFail($id);
        $newSms = $sms->replicate()->fill([
            'sent' => 0,
            'kid' => null,
            'sender' => 0,
            'cost' => 0,
        ]);
        $newSms->save();
        return ['success' => true, 'sms' => $newSms];
    }

    public function destroy($id)
    {
        $sms = TextMessage::findOrFail($id);
        $sms->delete();
        return ['success' => true];
    }
}
