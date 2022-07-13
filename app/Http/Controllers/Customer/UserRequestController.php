<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\UserRequest;
use App\Models\UserUtility;

class UserRequestController extends Controller
{
    public function index()
    {
        $util = UserUtility::where('user_id',auth()->id())->where('slug','request_counts')->update(['value'=>0]);
        $this->initSession();
        $sent = UserRequest::with(['sender','user','sender.personal_detail','user.personal_detail'])->where('sender_id',auth()->id())->latest()->get();
        $received = UserRequest::with(['sender','user','sender.personal_detail','user.personal_detail'])->where('user_id',auth()->id())->latest()->get();
        return view('customer.userrequest',compact('sent','received'));
    }
    public function store(Request $request,User $user)
    {
        if($user->personal_detail->gender==auth()->user()->personal_detail->gender)
        {
            return redirect()->back()->with(['status'=>'error','message'=>'Cannot send request to user with same gender']);
        }

        $oldreq = UserRequest::where('type',0)->where(function($query) use ($user) {
                        $query->where('user_id',$user->id)
                            ->where('sender_id',auth()->id());
                    })
                    ->orWhere(function($query) use ($user) {
                        $query->where('user_id',auth()->id())
                            ->where('sender_id',$user->id);
                    })->first();
        if(!empty($oldreq))
        {
            return redirect()->back()->with(['status'=>'warning','message'=>'Cannot send request to user, Please check your inbox.']);
        }

        $req = UserRequest::create([
            'user_id'=>$user->id,
            'sender_id'=>auth()->id()]);

        $recUtil = UserUtility::firstOrNew(['user_id'=>$user->id,'slug'=>'request_counts']);
        if(empty($recUtil->value))
            $recUtil->value = 1;
        else
            $recUtil->value += 1;
        $recUtil->save();

        // $recUtil = UserUtility::firstOrNew(['user_id'=>auth()->id(),'slug'=>'request_counts']);
        // if(empty($recUtil->value))
        //     $recUtil->value = 1;
        // else
        //     $recUtil->value += 1;
        // $recUtil->save();

        $this->initSession();

        return redirect()->back()->with(['status'=>'success','message'=>'Request sent successfully!']);
    }

    public function accept(Request $request, UserRequest $user_request, User $user)
    {
        if(auth()->user()->subscribed==0)
            return redirect()->back()->with(['status'=>'error','message'=>'Subscription required to perform this action']);

        if($request->accepted==1)
        {
           $user_request->update(['status'=>1]);
           return redirect()->back()->with(['status'=>'success','message'=>'Request Accepted uccessfully']);
        }
        $user_request->update(['status'=>5]);
        return redirect()->back()->with(['status'=>'success','message'=>'Request Rejected successfully']);
    }

    public function storeImageRequest(Request $request,User $user)
    {
        if($user->personal_detail->gender==auth()->user()->personal_detail->gender)
        {
            return redirect()->back()->with(['status'=>'error','message'=>'Cannot send request to user with same gender']);
        }

        $oldreq = UserRequest::where('type',1)->where(function($query) use ($user) {
                        $query->where('user_id',$user->id)
                            ->where('sender_id',auth()->id());
                    })
                    ->orWhere(function($query) use ($user) {
                        $query->where('user_id',auth()->id())
                            ->where('sender_id',$user->id);
                    })->first();
        if(!empty($oldreq))
        {
            return redirect()->back()->with(['status'=>'warning','message'=>'Cannot send request to user, Please check your inbox.']);
        }

        $req = UserRequest::create([
            'user_id'=>$user->id,
            'sender_id'=>auth()->id(),
            'type'=>1]);

        $recUtil = UserUtility::firstOrNew(['user_id'=>$user->id,'slug'=>'request_counts']);
        if(empty($recUtil->value))
            $recUtil->value = 1;
        else
            $recUtil->value += 1;
        $recUtil->save();

        // $recUtil = UserUtility::firstOrNew(['user_id'=>auth()->id(),'slug'=>'request_counts']);
        // if(empty($recUtil->value))
        //     $recUtil->value = 1;
        // else
        //     $recUtil->value += 1;
        // $recUtil->save();

        $this->initSession();

        return redirect()->back()->with(['status'=>'success','message'=>'Request sent successfully!']);
    }
}
