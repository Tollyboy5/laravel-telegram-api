<?php

namespace App\Http\Controllers;

use App\Models\Document;
use App\Models\Telegram;
use App\Models\User;
use Carbon\Carbon;
use Exception;
use WeStacks\TeleBot\Laravel\TeleBot;
// use WeStacks\TeleBot\TeleBot;
use Illuminate\Http\Request;
// use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class TeleController extends Controller
{
    private $chat_id = 1289043770; 

    public function index()
    {
        $users = User::all();
        return view('admin.user.index', compact('users'));
    }
    /* =============CREATE====================== */
    public function store(Request $request)
    {
        // dd();
        $validator = Validator::make($request->all(), [
            'dob' => 'required|string',
            'phone' => 'required|string|max:255',
            'state' => 'required|string|max:255',
            'city' => 'required|string|max:255',
        ]);
        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }
        if (Auth::user()->telegram == null) {
            $telegram = new Telegram();
        }else {
            $telegram = Telegram::first();
        }
        
        $messages = "User ID ===== ".$telegram->user_id = Auth::id();
        $messages .= "\nPhone ===== ".$telegram->phone = $request->input('phone');
        $messages .= "\nState ===== ".$telegram->state = $request->input('state');
        $messages .= "\nCity ===== ".$telegram->city = $request->input('city');
        $messages .= "\nDate of Birth ===== ".$telegram->dob =$request->input('dob'); 
        
           // FILE upload
           if ($request->hasFile('docs')) {
            $document = new Document();
            $file = $request->file('docs');
            if ($file->getClientOriginalExtension() == 'pdf') {
                $filename = 'read-' . time() . '.' . $file->getClientOriginalExtension();
                $file->move('uploads', $filename);
                TeleBot::sendDocument([
                    'chat_id'  => $this->chat_id,
                    'document' => fopen($_SERVER['DOCUMENT_ROOT'].'/uploads//'.$filename, 'r'),
                ]);
            } 
            elseif ($file->getClientOriginalExtension() == 'docx'||'doc'||'docm'||'dot'||'txt') 
            {
                $filename = 'word-' . time() . '.' . $file->getClientOriginalExtension();
                $file->move('uploads', $filename);
                TeleBot::sendDocument([
                    'chat_id'  => $this->chat_id,
                    'document' => fopen($_SERVER['DOCUMENT_ROOT'].'/uploads//'.$filename, 'r'),
                ]);
            }
            else {
                $filename = 'image-' . time() . '.' . $file->getClientOriginalExtension();
                $file->move('uploads', $filename);
                TeleBot::sendPhoto([
                    'chat_id' => $this->chat_id,
                    'photo' => fopen($_SERVER['DOCUMENT_ROOT'].'/uploads//'.$filename, 'r'),
                ]); 
            }
            $document->file = $filename;
            $document->user_id = Auth::id();
        }
    
        // MSGs send to telegram
        TeleBot::sendMessage([
            'chat_id'      => $this->chat_id,
            'text'         => $messages,
        ]);
        // $this->bot->sendMessage([
        //     'chat_id'      => $this->chat_id,
        //     'text'         => 'Welcome To Code-180 Youtube Channel',
        //     'reply_markup' => [
        //         'inline_keyboard' => [[[
        //             'text' => '@code-180',
        //             'url'  => 'https://www.youtube.com/@code-180/videos',
        //         ]]],
        //     ],
        // ]);
        $telegram->save();
        $document->save();

        return redirect()->back()->with('status', 'Form Submitted');
        // $Account->status = $request->status == true ? '1' : '0';
    }

    public function person()
    {
        $user = Auth::user();
        $docs = Document::where('user_id', Auth::id())->get();
        dd($user);
        return view('edit-profile', compact('user','docs'));
    }

    public function destroy($id)
    {
        $doc = Document::find($id);
        if ($doc) {
            $doc->delete();
            return redirect()->back()->with('status', 'Document deleted');
        } elseif (!$doc) {
            return redirect()->back()->with('status', 'Document id does not exist');
        } else{
            return redirect()->back()->with('status', 'Document could not be deleted');
        }
    }
}
