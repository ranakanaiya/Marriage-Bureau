<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\UserFamilyDetail;
use App\Models\UserEducationCareerDetail;
use App\Models\UserPersonalDetail;
use App\Models\UserHoroscopeDetail;
use App\Models\UserRequest;
use App\Models\UserArchive;
use Illuminate\Http\Request;
use App\Models\Country;
use App\Models\State;
use App\Models\City;
use Validator;
use File;
use Image;
use Str;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::with('personal_detail')->where('role',2)->get();
        return view('admin.customers.index',compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $countries = Country::all(['id','name']);
        return view('admin.customers.create',compact('countries'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'email'=>'required|unique:users,email',
            'password'=>'required|same:password_confirmation',
            'first_name'=>'required',
            'middle_name'=>'required',
            'last_name'=>'required',
            'address'=>'required',
            'country'=>'required|exists:countries,id',
            'state'=>'required|exists:states,id',
            'city'=>'required|exists:cities,id',
            'dob'=>'required|date',
            'gender'=>'required|integer',
            'height'=>'required|integer',
            'weight'=>'required|integer',
            'marital_status'=>'required|integer',
            'fitness'=>'required|integer',
            'skin'=>'required|integer',
            'contact'=>'required|array',
            'mother_tongue'=>'required',
            'physical_handicape'=>'required|integer',
            'diet'=>'required|integer',
            'highest_qualification'=>'required',
            'college_name'=>'required',
            'profession'=>'required',
            'monthly_income'=>'required|integer',
            'religion'=>'required',
            'caste'=>'required',
            'sub_caste'=>'required',
            'father_name'=>'required',
            'mother_name'=>'required',
            'father_occupation'=>'required',
            'mother_occupation'=>'required',
            'mosal'=>'required',
            'parental_address'=>'required',
            'family_type'=>'required',
            'property_detail'=>'required',
            'believe_in_janmaksar'=>'required',
            ]);

        if($validator->fails())
        {
            return back()->withErrors($validator->errors());
        }

        $brothers = [];
        $sisters = [];

        if(!empty($request->brother_name))
        for($i=0;$i<count($request->brother_name);$i++)
        {
            $brothers[] = [
                'name'=>$request->brother_name[$i],
                'married'=>$request->brother_married[$i+1],
                'education'=>$request->brother_education[$i]];
        }

        if(!empty($request->sister_name))
        for($i=0;$i<count($request->sister_name);$i++)
        {
            $sisters[] = [
                'name'=>$request->sister_name[$i],
                'married'=>$request->sister_married[$i+1],
                'education'=>$request->sister_education[$i]];
        }

        $addiction = [];
        if(!empty($request->addiction))
        {
            $addiction = $request->addiction;
        };

        $user = User::create([
            'name'=>$request->first_name.' '.$request->last_name,
            'password'=>bcrypt($request->password),
            'email'=>$request->email,
            'role'=>2,
            'step'=>4
            ]);

        $userPersonal = UserPersonalDetail::create([
            'user_id'=>$user->id,
            'first_name'=>$request->first_name,
            'middle_name'=>$request->middle_name,
            'last_name'=>$request->last_name,
            'dob'=>date('Y-m-d',strtotime($request->dob)),
            'gender'=>$request->gender,
            'image'=>($request->gender==1)?'female.png':'male.png',
            'birth_time'=>$request->birth_time,
            'height'=>$request->height,
            'weight'=>$request->weight,
            'contact'=>json_encode($request->contact),
            'marital_status'=>$request->marital_status,
            'fitness'=>$request->fitness,
            'skin'=>$request->skin,
            'blood_group'=>$request->blood_group,
            'mother_tongue'=>$request->mother_tongue,
            'physical_handicape'=>$request->physical_handicape,
            'physical_handicape_detail'=>$request->physical_handicape_detail,
            'addiction'=>json_encode($addiction),
            'diet'=>$request->diet,
            'family_diet'=>$request->family_diet,
            'address'=>$request->address,
            'country_id'=>$request->country,
            'state_id'=>$request->state,
            'city_id'=>$request->city
        ]);

        $userFamilyDetail = UserFamilyDetail::create([
            'user_id'=>$user->id,
            'religion'=>$request->religion,
            'caste'=>$request->caste,
            'sub_caste'=>$request->sub_caste,
            'father_name'=>$request->father_name,
            'mother_name'=>$request->mother_name,
            'father_occupation'=>$request->father_occupation,
            'mother_occupation'=>$request->mother_occupation,
            'brothers_detail'=>json_encode($brothers),
            'sisters_detail'=>json_encode($sisters),
            'mosal'=>$request->mosal,
            'parental_address'=>$request->parental_address,
            'family_type'=>$request->family_type,
            'property_detail'=>$request->property_detail,
        ]);

        $userEducation = UserEducationCareerDetail::create([
            'user_id'=>$user->id,
            'highest_qualification'=>$request->highest_qualification,
            'college_name'=>$request->college_name,
            'profession'=>$request->profession,
            'monthly_income'=>$request->monthly_income]);

        $userHoroscope = UserHoroscopeDetail::create([
            'user_id'=>$user->id,
            'believe_janmaksar'=>$request->believe_in_janmaksar,
            'janmaksar_type'=>$request->janmaksar_type,
            'naksatra'=>$request->naksatra,
            'zodiac_sign'=>$request->zodiac_sign,
            'gan'=>$request->gan,
            'naadi'=>$request->naadi]);

        return back()->with(['status'=>'success','message'=>'User Data Inserted Successfully']);

    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $customer)
    {
        $user = $customer;
        $user->load(['personal_detail','family_detail','education_career_detail','horoscope_detail']);
        $states = [];
        $cities = [];

        if(!empty($user->personal_detail))
        {
            $states = State::where('country_id',$user->personal_detail->country_id)->get(['id','name']);
            $cities = City::where('state_id',$user->personal_detail->state_id)->get(['id','name']);
        }
        else
        {
            $user->personal_detail = new UserPersonalDetail();   
            $user->personal_detail->dob = '1970-01-01 00:00:00';
            $user->personal_detail->addiction = '[]';
        }

        if(empty($user->family_detail))
        {
            $user->family_detail = new UserFamilyDetail();
            $user->family_detail->brothers_detail = '[]';
            $user->family_detail->sisters_detail = '[]';
        }

        if(empty($user->horoscope_detail))
            $user->horoscope_detail = new UserHoroscopeDetail();

        if(empty($user->education_career_detail))
            $user->education_career_detail = new UserEducationCareerDetail();
        // dd($user->personal_detail);
        $countries = Country::all(['id','name']);
        return view('admin.customers.edit',compact('user','states','cities','countries'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $customer)
    {
        $validator = Validator::make($request->all(),[
            'email'=>'required|email|unique:users,email,'.$customer->id,
            'password'=>'same:password_confirmation',
            'first_name'=>'required',
            'middle_name'=>'required',
            'last_name'=>'required',
            'gender'=>'required|integer',
            'address'=>'required',
            'country'=>'required|exists:countries,id',
            'state'=>'required|exists:states,id',
            'city'=>'required|exists:cities,id',
            'dob'=>'required|date',
            'height'=>'required|integer',
            'weight'=>'required|integer',
            'marital_status'=>'required|integer',
            'fitness'=>'required|integer',
            'skin'=>'required|integer',
            'contact'=>'required|array',
            'mother_tongue'=>'required',
            'physical_handicape'=>'required|integer',
            'diet'=>'required|integer',
            'highest_qualification'=>'required',
            'college_name'=>'required',
            'profession'=>'required',
            'monthly_income'=>'required|integer',
            'religion'=>'required',
            'caste'=>'required',
            'sub_caste'=>'required',
            'father_name'=>'required',
            'mother_name'=>'required',
            'father_occupation'=>'required',
            'mother_occupation'=>'required',
            'mosal'=>'required',
            'parental_address'=>'required',
            'family_type'=>'required',
            'property_detail'=>'required',
            'believe_in_janmaksar'=>'required',
            ]);

        if($validator->fails())
        {
            return back()->withErrors($validator->errors());
        }

        $brothers = [];
        $sisters = [];

        if(!empty($request->brother_name))
        for($i=0;$i<count($request->brother_name);$i++)
        {
            $brothers[] = [
                'name'=>$request->brother_name[$i],
                'married'=>$request->brother_married[$i+1],
                'education'=>$request->brother_education[$i]];
        }

        if(!empty($request->sister_name))
        for($i=0;$i<count($request->sister_name);$i++)
        {
            $sisters[] = [
                'name'=>$request->sister_name[$i],
                'married'=>$request->sister_married[$i+1],
                'education'=>$request->sister_education[$i]];
        }

        $addiction = [];
        if(!empty($request->addiction))
        {
            $addiction = $request->addiction;
        }

        $user = $customer;
        if(!empty($request->password))
            $user->update([
                // 'name'=>$request->first_name.' '.$request->last_name,
                'password'=>bcrypt($request->password),
                // 'email'=>$request->email
                ]);

        $user->personal_detail->update([
            'first_name'=>$request->first_name,
            'middle_name'=>$request->middle_name,
            'last_name'=>$request->last_name,
            'dob'=>date('Y-m-d',strtotime($request->dob)),
            'birth_time'=>$request->birth_time,
            'gender'=>$request->gender,
            'height'=>$request->height,
            'weight'=>$request->weight,
            'contact'=>json_encode($request->contact),
            'marital_status'=>$request->marital_status,
            'fitness'=>$request->fitness,
            'skin'=>$request->skin,
            'blood_group'=>$request->blood_group,
            'mother_tongue'=>$request->mother_tongue,
            'physical_handicape'=>$request->physical_handicape,
            'physical_handicape_detail'=>$request->physical_handicape_detail,
            'addiction'=>json_encode($addiction),
            'diet'=>$request->diet,
            'family_diet'=>$request->family_diet,
            'address'=>$request->address,
            'country_id'=>$request->country,
            'state_id'=>$request->state,
            'city_id'=>$request->city
        ]);

        $user->family_detail->update([
            'religion'=>$request->religion,
            'caste'=>$request->caste,
            'sub_caste'=>$request->sub_caste,
            'father_name'=>$request->father_name,
            'mother_name'=>$request->mother_name,
            'father_occupation'=>$request->father_occupation,
            'mother_occupation'=>$request->mother_occupation,
            'brothers_detail'=>json_encode($brothers),
            'sisters_detail'=>json_encode($sisters),
            'mosal'=>$request->mosal,
            'parental_address'=>$request->parental_address,
            'family_type'=>$request->family_type,
            'property_detail'=>$request->property_detail,
        ]);

        $user->education_career_detail->update([
            'highest_qualification'=>$request->highest_qualification,
            'college_name'=>$request->college_name,
            'profession'=>$request->profession,
            'monthly_income'=>$request->monthly_income]);

        $user->horoscope_detail->update([
            'believe_janmaksar'=>$request->believe_in_janmaksar,
            'janmaksar_type'=>$request->janmaksar_type,
            'naksatra'=>$request->naksatra,
            'zodiac_sign'=>$request->zodiac_sign,
            'gan'=>$request->gan,
            'naadi'=>$request->naadi]);

        return redirect()->route('admin.customers.index')->with(['status'=>'success','message'=>'Customer Updated Successfully']);


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $customer)
    {
        $customer->delete();
        return back()->with(['status'=>'success','message'=>'Customer Deleted successfully']);
    }

    public function updateImage(Request $request, User $customer)
    {
        $validator = Validator::make($request->all(),[
            'image.*'=>'image|mimes:jpg,jpeg,png']);

        if($validator->fails())
        {
            return redirect()->back()->withErrors($validator->errors());
        }

        $customer->load('personal_detail');

        if(!empty($customer->personal_detail))
        {
            if(empty($request->image))
            {
                $image = ($request->gender==1)?'["female.png"]':'["male.png"]';

                if($request->image_visible==1)
                    $image = $customer->personal_detail->image_original;

                $customer->personal_detail->update(['image_visible'=>$request->image_visible,'image'=>$image]);

                $customer->personal_detail->update(['image_visible'=>$request->image_visible]);
                return redirect()->back()->with(['status'=>'success','message'=>'Profile Picture Visibility updated successfully']);
            }

            if(count($request->image)>5)
            {
                return redirect()->back()->with(['status'=>'error','message'=>'Maximum 5 Images are allowed']);
            }

            $name = json_decode($customer->personal_detail->image_original);
            if(!empty($name) && count($name)>0)
            {
                foreach($name as $old_img)
                    File::delete(public_path('/assets/img/user/'. $old_img));
            }

            $array = [];
            $i=1;
            foreach($request->image as $img)
            {
                $filename = 'file_'.$customer->id.'_'.$i++.'_'.time().'.'.$img->getClientOriginalExtension();

                Image::make($img->getRealPath())->resize(1024, 1024, function ($constraint) {
                                                    $constraint->aspectRatio();
                                                    $constraint->upsize();
                                                })->save(public_path('/assets/img/user').'/'.$filename);
                // $destinationPath = public_path('/assets/img/user');
                // $request->image->move($destinationPath, $filename);
                $array[] = $filename;
            }
            $name = json_encode($array);

            $image = ($request->gender==1)?'["female.png"]':'["male.png"]';

            if($request->image_visible==1)
                $image = $name;

            $customer->personal_detail->update(['image'=>$image,'image_visible'=>$request->image_visible,'image_original'=>$name]);
            $customer->update(['step'=>5]);

            return redirect()->back()->with(['status'=>'success','message'=>'Profile picture updated successfully']);
        }
        return redirect()->back()->with(['status'=>'error','message'=>'Customer Personal Detail is pending to be filled']);
    }

    public function details(Request $request, User $customer)
    {
        $customer->load(['personal_detail','personal_detail.country','personal_detail.state','personal_detail.city','family_detail','education_career_detail','horoscope_detail']);
        return view('admin.customers.details',compact('customer'));
    }

    public function blockOrUnBlock(Request $request, User $customer)
    {
        $customer->update(['is_blocked'=>(!$customer->is_blocked)]);
        return redirect()->back()->with(['status'=>'success','message'=>'Customer blocking status updated']);
    }

    public function subscribe(Request $request, User $customer)
    {
        $customer->update(['subscribed'=>1]);
        return redirect()->back()->with(['status'=>'success','message'=>'Customer Subscribed Successfully']);
    }

    public function archive(Request $request, User $customer)
    {
        $customer->load('personal_detail', 'education_career_detail','horoscope_detail','family_detail');

        $archiveRec = [
            'old_user_id'=>$customer->id,
            'name'=>$customer->name,
            'email'=>$customer->email,
            'step'=>$customer->step,
            'subscribed'=>$customer->subscribed,
            'is_blocked'=>$customer->is_blocked,
        ];

        $detailds = [
            'personal_detail'=>[],
            'family_detail'=>[],
            'education_career_detail'=>[],
            'horoscope_detail'=>[],
        ];

        if(!empty($customer->personal_detail))
        {
            if(!empty($customer->personal_detail->image_original) && count(json_decode($customer->personal_detail->image_original))>0)
            {
                foreach(json_decode($customer->personal_detail->image_original) as $img)
                {
                    try
                    {
                        Image::make(public_path('/assets/img/user/'.$img))->save(public_path('/assets/img/userarchive').'/'.$img);
                        File::delete(public_path('/assets/img/user/'. $img));
                    }
                    catch(\Intervention\Image\Exception\NotReadableException $e)
                    {
                        //
                    }

                }
            }
            $details['personal_detail'] = $customer->personal_detail->toArray();
            $customer->personal_detail->delete();
        }

        if(!empty($customer->family_detail))
        {
            $details['family_detail'] = $customer->family_detail->toArray();
            $customer->family_detail->delete();
        }

        if(!empty($customer->education_career_detail))
        {
            $details['education_career_detail'] = $customer->education_career_detail->toArray();
            $customer->education_career_detail->delete();
        }  

        if(!empty($customer->horoscope_detail))
        {
            $details['horoscope_detail'] = $customer->horoscope_detail->toArray();
            $customer->horoscope_detail->delete();
        }  

        $details['requests'] = UserRequest::where('sender_id',$customer->id)->orWhere('user_id',$customer->id)->get()->toArray();
        $archiveRec['details'] = json_encode($details);
        $customer->delete();   

        $arch = UserArchive::create($archiveRec);
        return redirect()->back()->with(['status'=>'success','message'=>'Customer Archived!']);
    }

    public function getArchivedCustomers()
    {
        $users = UserArchive::all();
        return view('admin.customers.archive',compact('users'));
    }

    public function archivedRecover(Request $request, UserArchive $customer)
    {
        $password = Str::random(8);

        $exist = User::where('email',$customer->email)->first();
        if(!empty($exist))
        {
            return redirect()->back()->with(['status'=>'error','message'=>'Archived email is used by other user, Recovery failed for record with email '.$customer->email.'.']);
        }

        $userData = [
            'id'=>$customer->old_user_id,
            'name'=>$customer->name,
            'email'=>$customer->email,
            'password'=>bcrypt($password),
            'role'=>2,
            'step'=>$customer->step,
            'subscribed'=>$customer->subscribed,
            'is_blocked'=>$customer->is_blocked
        ];

        $details = json_decode($customer->details,true);


        $personalDetail = [];
        $familyDetail = [];
        $educationCareerDetail = [];
        $horoscopeDetail = [];
        $userObj = User::insert($userData);

        if(!empty($details['personal_detail']))
        {
            if(!empty($details['personal_detail']['image_original']) && count(json_decode($details['personal_detail']['image_original']))>0)
            {
                foreach(json_decode($details['personal_detail']['image_original']) as $img)
                {
                    try
                    {
                        Image::make(public_path('/assets/img/userarchive/'.$img))->save(public_path('/assets/img/user').'/'.$img);
                        File::delete(public_path('/assets/img/userarchive/'. $img));
                    }
                    catch(\Intervention\Image\Exception\NotReadableException $e)
                    {
                        //
                    }

                }
            }
            $personalDetail = UserPersonalDetail::insert($details['personal_detail']);

        }


        if(!empty($details['family_detail']))
        {
            $familyDetail = UserFamilyDetail::insert($details['family_detail']);
        }

        if(!empty($details['education_career_detail']))
        {
            $educationCareerDetail = UserEducationCareerDetail::insert($details['education_career_detail']);
        }  

        if(!empty($details['horoscope_detail']))
        {
            $horoscopeDetail = UserHoroscopeDetail::insert($details['horoscope_detail']);
        }  

        if(!empty($details['requests']) && count($details['requests']))
        {
            $requests = UserRequest::insert($details['requests']);
        }
        $customer->delete();
        return redirect()->back()->with(['status'=>'success','message'=>'Customer Recovered successfully!','userData'=>['name'=>$userData['name'],'email'=>$userData['email'],'password'=>$password]]);
    }

    public function archivedRecoverAll(Request $request)
    {
        $archives = UserArchive::all();
        foreach($archives as $arch)
        {
            $exist = User::where('email',$arch->email)->first();
            if(!empty($exist))
            {
                continue;
            }
            $password = Str::random(8);
            $userData = [
                'id'=>$arch->old_user_id,
                'name'=>$arch->name,
                'email'=>$arch->email,
                'password'=>bcrypt($password),
                'role'=>2,
                'step'=>$arch->step,
                'subscribed'=>$arch->subscribed,
                'is_blocked'=>$arch->is_blocked
            ];

            $details = json_decode($arch->details,true);


            $personalDetail = [];
            $familyDetail = [];
            $educationCareerDetail = [];
            $horoscopeDetail = [];
            $userObj = User::insert($userData);

            if(!empty($details['personal_detail']))
            {
                if(!empty($details['personal_detail']['image_original']) && count(json_decode($details['personal_detail']['image_original']))>0)
                {
                    foreach(json_decode($details['personal_detail']['image_original']) as $img)
                    {
                        try
                        {
                            Image::make(public_path('/assets/img/userarchive/'.$img))->save(public_path('/assets/img/user').'/'.$img);
                            File::delete(public_path('/assets/img/userarchive/'. $img));
                        }
                        catch(\Intervention\Image\Exception\NotReadableException $e)
                        {
                            //
                        }

                    }
                }
                $personalDetail = UserPersonalDetail::insert($details['personal_detail']);

            }


            if(!empty($details['family_detail']))
            {
                $familyDetail = UserFamilyDetail::insert($details['family_detail']);
            }

            if(!empty($details['education_career_detail']))
            {
                $educationCareerDetail = UserEducationCareerDetail::insert($details['education_career_detail']);
            }  

            if(!empty($details['horoscope_detail']))
            {
                $horoscopeDetail = UserHoroscopeDetail::insert($details['horoscope_detail']);
            }  

            if(!empty($details['requests']) && count($details['requests']))
            {
                $requests = UserRequest::insert($details['requests']);
            }
            $arch->delete();
        }
        return redirect()->back()->with(['status'=>'success','message'=>'All customers Recovered successfully!']);
    }
}
