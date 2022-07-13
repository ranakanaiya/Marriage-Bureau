<?php
namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\UserBlocked;
use App\Models\UserRequest;

class CustomerController extends Controller
{
    public function details(User $customer)
    {
        $acceptedRec = UserRequest::where('type',0)->where('status',1)->where(function($query) use($customer) {
            $query->where(function($subquery) use($customer) {
                $subquery->where('user_id',auth()->id())
                    ->where('sender_id',$customer->id);
                })
                ->orWhere(function($subquery) use($customer) {
                    $subquery->where('sender_id',auth()->id())
                    ->where('user_id',$customer->id);
                });
        })->get();
        $accepted = (count($acceptedRec)>0)?1:0;
        return view('customer.userdetails',compact('customer','accepted'));
    }

    public function block(User $customer)
    {
        $block = UserBlocked::create(['user_id'=>auth()->id(),'blocked_user_id'=>$customer->id]);
        return redirect()->back()->with(['status'=>'success','message'=>'User Blocked successfully']);
    }

    public function unBlock(User $customer)
    {
        $unblocked = UserBlocked::where('user_id',auth()->id())->where('blocked_user_id',$customer->id)->delete();
        return redirect()->back()->with(['status'=>'success','message'=>'User unblocked successfully']);
    }

    public function getBlocked()
    {
        $users = UserBlocked::with(['blocked_user','blocked_user','blocked_user'])->where('user_id',auth()->id())->get();
        return view('customer.blocked',compact('users'));
    }
}
