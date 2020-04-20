<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Transaction;
use App\Delivery;
use App\Item;
use App\System;
use App\Faq;
use App\Information;
use App\Slider;
use App\Category;
use App\Province;
use App\City;
use App\Ticket;
use App\TicketGroup;
use App\TicketMessage;
use SoapClient;
use SoapFault;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ApiController extends Controller
{     
    function socket()
    {
        echo 'connect';

        $host    = "https://farazist.ir";
        $port    = 8090;
        $message = "Hello Server";
        echo "Message To server :".$message;
        // create socket
        $socket = socket_create(AF_INET, SOCK_STREAM, 0) or die("Could not create socket\n");
        // connect to server
        $result = socket_connect($socket, $host, $port) or die("Could not connect to server\n");  
        // send string to server
        socket_write($socket, $message, strlen($message)) or die("Could not send data to server\n");
        // get server response
        $result = socket_read ($socket, 1024) or die("Could not read server response\n");
        echo "Reply From Server  :".$result;
        // close socket
        socket_close($socket);
    }

    function sendQrcode(Request $request)
    {
        $data = $request['data'];

        return $data;
    }
    
    function signInUser(Request $request)
    {
        $valid_request = $request->validate([
            'mobile_number' => 'required',
            'password' => 'required',
        ]);

        $valid_request['mobile_number'] = str_replace(' ', '', $valid_request['mobile_number']);

        if(Auth::attempt(['mobile_number' => $valid_request['mobile_number'], 'password' => $valid_request['password']]))
        {
            $user = User::with('city', 'city.province', 'systems.city', 'systems.city.province', 'systems.work_times', 'system.city', 'system.city.province', 'system.work_times')->where('id', Auth::user()->id)->get()->first();
            $user->access_token = $user->createToken('authToken')->accessToken;
            return response()->json($user, 200, ['Content-type'=> 'application/json; charset=utf-8'], JSON_UNESCAPED_UNICODE); 
        }
    }

    function getTargetUser(Request $request)
    {
        $user = User::find($request['id']);

        if($user->role == 2)
        {
            $result = User::select('name', 'mobile_number')->find($request['id']);
        }
        else if($user->role == 3)
        {
            $result = User::select('name')->find($request['id']);
        }
        else
        {
            $result = null;
        }
        
        return response()->json($result, 200, ['Content-type'=> 'application/json; charset=utf-8'], JSON_UNESCAPED_UNICODE); 
    }

    function getUser(Request $request)
    {
        $user = User::with('city', 'city.province', 'systems.city', 'systems.city.province', 'systems.work_times', 'system.city', 'system.city.province', 'system.work_times')->where('id', auth()->guard('api')->user()->id)->first();
        return response()->json($user, 200, ['Content-type'=> 'application/json; charset=utf-8'], JSON_UNESCAPED_UNICODE); 
    }
     
    function checkUser(Request $request)
    {
        if ($request->has('mobile_number') && $request->has('password'))
        {
            if(Auth::attempt(['mobile_number' => $request['mobile_number'], 'password' => $request['password']]))
            {
                $result = 1;
            }
            else
            {
                $result = 0;
            }
        }
        elseif($request->has('mobile_number'))
        {
            if(User::where('mobile_number', $request['mobile_number'])->exists())
            {
                $result = 1;
            }
            else
            {
                $result = 0;
            }
        }
        else
        {
            $result = 0;
        }
        return response()->json($result);
    }
     
    function signUpUser(Request $request)
    {
        $valid_request = $request->validate([
            'name' => 'required|max:255',
            'mobile_number' => 'required|max:11|unique:users',
            'password' => 'required',
        ]);

        $user = new User();
        $user->name = $valid_request['name'];
        $user->mobile_number = $valid_request['mobile_number'];
        $user->password = bcrypt($valid_request['password']);

        if ($request->has('address')) 
        {
            $user->address = $request['address'];
        }

        if ($request->has('city_id')) 
        {
            $user->city_id = $request['city_id'];
        }

        if($request->file('image') != null)
        {
            $image = $request->file('image');
            $image_name = '/images/user/' . date("Y-m-d-H-i-s", time()) . '.jpg';
            Storage::disk('public')->putFileAs('/', $image, $image_name);
            $user->image = $image_name;
        }

        $user->save();

        return $this->signInUser($request);
    }

    function deleteUserImage(Request $request)
    {
        $user = auth()->guard('api')->user();

        if(Storage::disk('public')->has($user->image))
            Storage::disk('public')->delete($user->image);

        $user->image = "";
        $user->update();

        return response()->json($user, 200, ['Content-type'=> 'application/json; charset=utf-8'], JSON_UNESCAPED_UNICODE); 
    }

    function editUser(Request $request)
    {
        $user = auth()->guard('api')->user();

        if ($request->has('name')) 
        {
            $user->name = $request['name'];            
        }

        if ($request->has('address')) 
        {
            $user->address = $request['address'];
        }

        if ($request->has('city_id')) 
        {
            $user->city_id = $request['city_id'];
        }
        
        if ($request->has('email')) 
        {
            $user->email = $request['email'];            
        }

        if ($request->has('password')) 
        {
            $user->password = bcrypt($request['password']);            
        } 

        if ($request->has('system_id')) 
        {
            $user->system_id = $request['system_id'];            
        }

        if($request->file('image') != null)
        {
            $image = $request->file('image');
            $image_name = '/images/user/' . date("Y-m-d-H-i-s", time()) . '.jpg';
            Storage::disk('public')->putFileAs('/', $image, $image_name);
            $user->image = $image_name;
        }

        $user->update();

        return response()->json($user, 200, ['Content-type'=> 'application/json; charset=utf-8'], JSON_UNESCAPED_UNICODE); 
    }

    function changeUserPassword(Request $request)
    {
        $user = User::where('mobile_number', $request['mobile_number'])->first();

        if(!$user) //null
        {
            return 0;
        }
        else
        {
            $new_password = rand(1000, 9999);

            $user->password = bcrypt($new_password);
            $user->update();
    
            $this->sendSMS($user->mobile_number, "m3l043bhai", array( "user_id" => $user->id, "new_password" => $new_password));
            return 1;
        }
    }
    
    function getUserTransactions(Request $request)
    {
        $user_id = auth()->guard('api')->user()->id;
        $result = Transaction::with('target_user')->where('user_id', $user_id)->orderBy('created_at', 'DESC')->get();
        return response()->json($result, 200, ['Content-type'=> 'application/json; charset=utf-8'], JSON_UNESCAPED_UNICODE);
    }

    function getOwnerCitizensCount(Request $request)
    {
        $result = 0;
        foreach(auth()->guard('api')->user()->systems as $system)
        {
            $result += $system->citizens()->count();
        }
        return response()->json($result, 200, ['Content-type'=> 'application/json; charset=utf-8'], JSON_UNESCAPED_UNICODE);
    }

    function getUserDeliveries(Request $request)
    {
        $result = Delivery::with('city', 'city.province', 'system.owner', 'system.city', 'system.city.province', 'items')
        ->where('user_id', auth()->guard('api')->user()->id)
        ->where('state', '!=', 'waiting')
        ->where('state', '!=', 'accepted')
        ->orderBy('created_at', 'DESC')->get();

        return response()->json($result, 200, ['Content-type'=> 'application/json; charset=utf-8'], JSON_UNESCAPED_UNICODE);
    }

    function getLastUserDelivery(Request $request)
    {
        $user_id = auth()->guard('api')->user()->id;
        $result = Delivery::with('city', 'city.province', 'system.owner', 'system.city', 'system.city.province', 'items')->where('user_id', $user_id)->orderBy('created_at', 'DESC')->first();
        
        return response()->json($result, 200, ['Content-type'=> 'application/json; charset=utf-8'], JSON_UNESCAPED_UNICODE);
    }
     
    function getSystemDeliveries(Request $request)
    {
        $result = Delivery::with('city', 'city.province', 'items', 'user')->where('system_id', $request['id'])->orderBy('created_at', 'DESC')->get();
        return response()->json($result, 200, ['Content-type'=> 'application/json; charset=utf-8'], JSON_UNESCAPED_UNICODE);
    }

    function getUserTickets(Request $request)
    {
        $user_id = auth()->guard('api')->user()->id;
        $result = Ticket::with('group')->where('user_id', $user_id)->orderBy('created_at', 'DESC')->get();
        
        return response()->json($result, 200, ['Content-type'=> 'application/json; charset=utf-8'], JSON_UNESCAPED_UNICODE);
    }

    function getTicketMessages(Request $request)
    {
        $result = Ticket::find($request['ticket_id'])->messages;
        
        return response()->json($result, 200, ['Content-type'=> 'application/json; charset=utf-8'], JSON_UNESCAPED_UNICODE);
    }

    function getTicketGroups(Request $request)
    {
        $result = TicketGroup::all();
        
        return response()->json($result, 200, ['Content-type'=> 'application/json; charset=utf-8'], JSON_UNESCAPED_UNICODE);
    }

    function addTicket(Request $request)
    {
        $user_id = auth()->guard('api')->user()->id;
        
        $ticket = new Ticket();
        $ticket->user_id = $user_id;
        $ticket->group_id = $request['group_id'];
        $ticket->subject = $request['subject'];
        $ticket->save();

        return response()->json($ticket, 200, ['Content-type'=> 'application/json; charset=utf-8'], JSON_UNESCAPED_UNICODE);
    }

    function addTicketMessage(Request $request)
    {
        $ticket = Ticket::find($request['ticket_id']);
        
        if($ticket->state == 'open')
        {
            $ticket_message = new TicketMessage();
            $ticket_message->type = $request['type'];
            $ticket_message->ticket_id = $request['ticket_id'];
            
            if ($request->has('text')) 
            {
                $ticket_message->text = $request['text'];
            }

            if($request->file('image') != null)
            {
                $image = $request->file('image');
                $image_name = '/images/ticket/' . date("Y-m-d-H-i-s", time()) . '.jpg';
                Storage::disk('public')->putFileAs('/', $image, $image_name);
                $ticket_message->image = $image_name;
            }
            
            $ticket_message->save();
    
            return response()->json($ticket_message, 200, ['Content-type'=> 'application/json; charset=utf-8'], JSON_UNESCAPED_UNICODE);
        }
    }

    function editTicketMessages(Request $request)
    {
        $ticket = Ticket::find($request['ticket_id']);

        foreach($ticket->items as $item)
        {
            $item->state = "seen";
            $item->update();
        }
        return response()->json($ticket, 200, ['Content-type'=> 'application/json; charset=utf-8'], JSON_UNESCAPED_UNICODE);
    }

    function getNewTicketMessagesCount(Request $request)
    {
        $result = 0;
        foreach(auth()->guard('api')->user()->tickets as $ticket)
        {
            $result += $ticket->messages()->where('type','receive')->where('state','unseen')->count();
        }
        return response()->json($result, 200, ['Content-type'=> 'application/json; charset=utf-8'], JSON_UNESCAPED_UNICODE);
    }

    function transfer(Request $request)
    {
        $sender = auth()->guard('api')->user();
        $receiver = User::where('id', $request['target_user_id'])->get()->first();
        
        if(!$sender || !$receiver)
        {
            return "0";
        }
        elseif($sender->wallet - $request['amount'] < 0)
        {
            return "00";
        }
        else
        {
            $sender->wallet -= $request['amount'];
            $sender->update();
            
            $receiver->wallet += $request['amount'];
            $receiver->update();

            $transaction = new Transaction();
            $transaction->user_id = $sender->id;
            $transaction->target_user_id = $receiver->id;
            $transaction->amount = -$request['amount'];
            if ($request->has('description')) $transaction->description = $request['description'];
            $transaction->save();

            $transaction = new Transaction();
            $transaction->user_id = $receiver->id;
            $transaction->target_user_id = $sender->id;
            $transaction->amount = $request['amount'];
            if ($request->has('description')) $transaction->description = $request['description'];
            $transaction->save();

            $this->sendSMS($sender->mobile_number, "6iawhe3ig8", array( "sender_id" => $sender->id, "amount" => $request['amount'], "wallet" => $sender->wallet));
            $this->sendSMS($receiver->mobile_number, "6nr93842ew", array( "receiver_id" => $receiver->id, "amount" => $request['amount'], "wallet" => $receiver->wallet));

            return "1";
        }
    }

    function transferSecure(Request $request)
    {
        $sender = System::find($request['system_id'])->owner()->id;
        $receiver = auth()->guard('api')->user();
        
        if(!$sender || !$receiver)
        {
            return "0";
        }
        elseif($sender->wallet - $request['amount'] < 0)
        {
            return "00";
        }
        else
        {
            $sender->wallet -= $request['amount'];
            $sender->update();
            
            $receiver->wallet += $request['amount'];
            $receiver->update();

            $transaction = new Transaction();
            $transaction->user_id = $sender->id;
            $transaction->target_user_id = $receiver->id;
            $transaction->amount = -$request['amount'];
            if ($request->has('description')) $transaction->description = $request['description'];
            $transaction->save();

            $transaction = new Transaction();
            $transaction->user_id = $receiver->id;
            $transaction->target_user_id = $sender->id;
            $transaction->amount = $request['amount'];
            if ($request->has('description')) $transaction->description = $request['description'];
            $transaction->save();

            $this->sendSMS($sender->mobile_number, "6iawhe3ig8", array( "sender_id" => $sender->id, "amount" => $request['amount'], "wallet" => $sender->wallet));
            $this->sendSMS($receiver->mobile_number, "6nr93842ew", array( "receiver_id" => $receiver->id, "amount" => $request['amount'], "wallet" => $receiver->wallet));

            return "1";
        }
    }

    function getCities(Request $request)
    {
        $result = City::all();
        return response()->json($result, 200, ['Content-type'=> 'application/json; charset=utf-8'], JSON_UNESCAPED_UNICODE); 
    }

    function getProvinceCities(Request $request)
    {
        $result = Province::find($request['province_id'])->cities;
        return response()->json($result, 200, ['Content-type'=> 'application/json; charset=utf-8'], JSON_UNESCAPED_UNICODE); 
    }

    function getProvinces(Request $request)
    {
        $result = Province::all();
        return response()->json($result, 200, ['Content-type'=> 'application/json; charset=utf-8'], JSON_UNESCAPED_UNICODE); 
    }

    function getInformations(Request $request)
    {
        $result = Information::all();
        return response()->json($result, 200, ['Content-type'=> 'application/json; charset=utf-8'], JSON_UNESCAPED_UNICODE); 
    }

    function getFaqs(Request $request)
    {
        $result = Faq::all();
        return response()->json($result, 200, ['Content-type'=> 'application/json; charset=utf-8'], JSON_UNESCAPED_UNICODE); 
    }

    function getItems(Request $request)
    {
        $user = auth()->guard('api')->user();

        if($user != null && $user->role == 2) // owner
        {
            $result = $user->items;
        }
        else if($user != null && $user->role == 3) // citizen
        {
            $result = $user->system->owner->items;
        }
        else // not login
        {
            $result = Item::where('owner_id', '0')->get();
        }
        return response()->json($result, 200, ['Content-type'=> 'application/json; charset=utf-8'], JSON_UNESCAPED_UNICODE); 
    }

    function editItems(Request $request)
    {
        foreach($request['items'] as $request_item)
        {
            $item = Item::find($request_item['id']);
            $item->name = $request_item['name'];
            $item->price = $request_item['price'];
            $item->enable = $request_item['enable'];

            $item->update();
        }
    }

    function getCategories(Request $request)
    {
        $result = Category::all();
        return response()->json($result, 200, ['Content-type'=> 'application/json; charset=utf-8'], JSON_UNESCAPED_UNICODE); 
    }

    function getSliders(Request $request)
    {
        $result = Slider::all();
        return response()->json($result, 200, ['Content-type'=> 'application/json; charset=utf-8'], JSON_UNESCAPED_UNICODE); 
    }

    function getSystemSliders(Request $request)
    {
        $system = System::find($request['system_id']);

        if($system != null && $system->sliders->count() > 0)
        {
            $result = $system->sliders;
        }
        else
        {
            $result = Slider::where('system_id', '0')->get();
        }
        return response()->json($result, 200, ['Content-type'=> 'application/json; charset=utf-8'], JSON_UNESCAPED_UNICODE); 
    }

    function getSystems(Request $request)
    {
        $result = System::with('owner', 'city')->get();
        return response()->json($result, 200, ['Content-type'=> 'application/json; charset=utf-8'], JSON_UNESCAPED_UNICODE); 
    }

    function getSystem(Request $request)
    {
        $result = System::with('owner', 'city', 'work_times')->where('id', $request['id'])->first();
        return response()->json($result, 200, ['Content-type'=> 'application/json; charset=utf-8'], JSON_UNESCAPED_UNICODE); 
    }

    function deleteSystemImage(Request $request)
    {
        $system = System::find($request['id']);

        if(Storage::disk('public')->has($system->image))
            Storage::disk('public')->delete($system->image);

        $system->image = "";
        $system->update();

        return response()->json($system, 200, ['Content-type'=> 'application/json; charset=utf-8'], JSON_UNESCAPED_UNICODE); 
    }

    function editSystem(Request $request)
    {
        $system = System::find($request['id']);

        if ($system) 
        {
            if($request->file('image') != null)
            {
                $image = $request->file('image');
                $image_name = '/images/system/' . date("Y-m-d-H-i-s", time()) . '.jpg';
                Storage::disk('public')->putFileAs('/', $image, $image_name);
                $system->image = $image_name;
            }

            if ($request->has('activation_type')) 
            {
                $system->activation_type = $request['activation_type'];

                if($request['activation_type'] == "auto")
                {
                    if($request->has('morning_start_time'))
                    {
                        $system->morning_start_time = $request['morning_start_time']; 
                    }
                    if($request->has('morning_end_time'))
                    {
                        $system->morning_end_time = $request['morning_end_time']; 
                    }
                    if($request->has('afternoon_start_time'))
                    {
                        $system->afternoon_start_time = $request['afternoon_start_time']; 
                    }
                    if($request->has('afternoon_end_time'))
                    {
                        $system->afternoon_end_time = $request['afternoon_end_time']; 
                    }
                }
                else if($request['activation_type'] == "manual")
                {
                    if($request->has('state'))
                    {
                        $system->state = $request['state'];   
                    }
                }         
            }

            $system->update();
            return response()->json($system, 200, ['Content-type'=> 'application/json; charset=utf-8'], JSON_UNESCAPED_UNICODE); 
        }
    }
     
    function editDelivery(Request $request)
    {
        $delivery = Delivery::find($request['id']);

        if ($request->has('address')) 
        {
            $delivery->address = $request['address'];            
        }
        
        if ($request->has('system_id')) 
        {
            $delivery->system_id = $request['system_id'];            
        }

        if ($request->has('city_id')) 
        {
            $delivery->city_id = $request['city_id'];            
        } 

        if ($request->has('state')) 
        {
            $delivery->state = $request['state'];            
        } 

        if ($request->has('undefined_items_name')) 
        {
            $delivery->undefined_items_name = $request['undefined_items_name'];            
        }

        if ($request->has('undefined_items_weight')) 
        {
            $delivery->undefined_items_weight = $request['undefined_items_weight'];            
        }

        if ($request->has('undefined_items_price')) 
        {
            $delivery->undefined_items_price = $request['undefined_items_price'];            
        }

        if ($request->has('seen')) 
        {
            $delivery->seen = $request['seen'];            
        } 

        if ($request->has('description')) 
        {
            $delivery->description = $request['description'];            
        } 

        $delivery->update();

        if ($request->has('items')) 
        {
            foreach($delivery->items as $item)
            {
                $delivery->items()->detach($item->id);
            }

            foreach($request['items'] as $item)
            {
                $delivery->items()->attach([$item['id'] => ['count'=> $item['count']]]);
            }
        }

        return response()->json($delivery, 200, ['Content-type'=> 'application/json; charset=utf-8'], JSON_UNESCAPED_UNICODE); 
    }

    function addNewDelivery(Request $request)
    {
        $delivery = new Delivery();
        $delivery->user_id = $request['user_id'];
        $delivery->system_id = $request['system_id'];
    
        if ($request->has('address')) 
        {
            $delivery->address = $request['address'];            
        }

        if ($request->has('city_id')) 
        {
            $delivery->city_id = $request['city_id'];            
        } 

        if ($request->has('state')) 
        {
            $delivery->state = $request['state'];            
        }

        if ($request->has('undefined_items_name')) 
        {
            $delivery->undefined_items_name = $request['undefined_items_name'];            
        }

        if ($request->has('undefined_items_weight')) 
        {
            $delivery->undefined_items_weight = $request['undefined_items_weight'];            
        }

        $delivery->save();

        if ($request->has('items')) 
        {
            foreach($request['items'] as $item)
            {
                $delivery->items()->attach([$item['id'] => ['count'=> $item['count']]]);
            }
        }

        return response()->json($delivery, 200, ['Content-type'=> 'application/json; charset=utf-8'], JSON_UNESCAPED_UNICODE); 
    }
     
    function verificationSMS(Request $request)
    {
        return $this->sendSMS($request['mobile_number'], "esxf1rvim9", array( "code" => $request['code']));
    }
     
    private function sendSMS($mobile_number, $pattern_code, $input_data)
    {
        // turn off the WSDL cache
        ini_set("soap.wsdl_cache_enabled", "0");
        try 
        {
            $client = new SoapClient("http://ippanel.com/class/sms/wsdlservice/server.php?wsdl");
            $user = "09155598173"; 
            $pass = "2200698518"; 
            $fromNum = "3000505"; 
            $toNum = array($mobile_number);
        
            return $client->sendPatternSms($fromNum,$toNum,$user,$pass,$pattern_code,$input_data);
        } 
        catch (SoapFault $ex) 
        {
            return $ex->faultstring;
        }
    }
}