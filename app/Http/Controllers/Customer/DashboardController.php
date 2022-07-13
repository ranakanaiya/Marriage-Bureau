<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Country;
use App\Models\State;
use App\Models\City;
use App\Models\User;
use App\Models\UserPersonalDetail;
use App\Models\UserFamilyDetail;
use App\Models\UserEducationCareerDetail;
use App\Models\UserHoroscopeDetail;
use App\Models\UserPreference;
use App\Models\UserBlocked;
use App\Http\Requests\User\PersonalDetailRequest;
use App\Http\Requests\User\EducationCareerDetailRequest;
use App\Http\Requests\User\FamilyDetailRequest;
use App\Http\Requests\User\HoroscopeDetailRequest;
use Image;
use File;
use Validator;
use DB;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $preferences = UserPreference::firstOrNew(['user_id'=>auth()->id()]);
        $countries = Country::all(['id','name']);
        $preferences = UserPreference::firstOrNew(['user_id'=>auth()->id()]);
        $customers = [];

        if(auth()->user()->step<5)
        {
            return view('customer.dashboard',compact('countries','customers','preferences'));
        }

        if(empty(auth()->user()->personal_detail))
        {
            auth()->user()->update(['step'=>0]);
            $customers = [];
            return view('customer.dashboard',compact('countries','customers','preferences'))->with(['status'=>'error','message'=>'Please complete you profile first before match search']);
        }

        if(empty(auth()->user()->education_career_detail))
        {
            auth()->user()->update(['step'=>1]);
            $customers = [];
            return view('customer.dashboard',compact('countries','customers','preferences'))->with(['status'=>'error','message'=>'Please complete you profile first before match search']);
        }

        if(empty(auth()->user()->family_detail))
        {
            auth()->user()->update(['step'=>2]);
            $customers = [];
            return view('customer.dashboard',compact('countries','customers','preferences'))->with(['status'=>'error','message'=>'Please complete you profile first before match search']);
        }

        if(empty(auth()->user()->horoscope_detail) && auth()->user()->step>3)
        {
            auth()->user()->update(['step'=>3]);
            $customers = [];
            return view('customer.dashboard',compact('countries','customers','preferences'))->with(['status'=>'error','message'=>'Please complete you profile first before match search']);
        }

        $personal_detail = auth()->user()->personal_detail;
        $horoscope_detail = auth()->user()->horoscope_detail;

        $check_janmaksar = $horoscope_detail->believe_janmaksar;
        $check_janmaksar_details = 1;
        if($horoscope_detail->janmaksar_type==0 || $horoscope_detail->naksatra==0 || $horoscope_detail->zodiac_sign==0 || $horoscope_detail->gan==0 || $horoscope_detail->naadi==0)
        {
            $check_janmaksar_details = 0;
        }

        $blocked = UserBlocked::where('user_id',auth()->id())->pluck('blocked_user_id');
        $customers = DB::table('users')
                    ->join('user_personal_details',function($join) use ($personal_detail){
                        $join->on('users.id','=','user_personal_details.user_id')
                            ->where('user_personal_details.gender','!=',$personal_detail->gender);
                    })
                    ->leftJoin('user_education_career_details','users.id','=','user_education_career_details.user_id')
                    ->leftJoin('user_family_details','users.id','=','user_family_details.user_id')
                    ->join('countries','user_personal_details.country_id','=','countries.id')
                    ->join('states','user_personal_details.state_id','=','states.id')
                    ->join('cities','user_personal_details.city_id','=','cities.id')
                    ->leftJoin('user_requests', function($join) {
                        $join->on('users.id','=','user_requests.user_id')
                            ->where('user_requests.sender_id',auth()->id())
                            ->where('user_requests.type',0);
                    })
                    ->leftJoin('user_requests AS user_requests_received', function($join) {
                        $join->on('users.id','=','user_requests_received.sender_id')
                            ->where('user_requests_received.user_id',auth()->id())
                            ->where('user_requests_received.type',0);
                    })
                    ->leftJoin('user_requests AS user_requests_image', function($join) {
                        $join->on('users.id','=','user_requests_image.user_id')
                            ->where('user_requests_image.sender_id',auth()->id())
                            ->where('user_requests_image.type',1);
                    })
                    ->leftJoin('user_requests AS user_requests_image_received', function($join) {
                        $join->on('users.id','=','user_requests_image_received.sender_id')
                            ->where('user_requests_image_received.user_id',auth()->id())
                            ->where('user_requests_image_received.type',1);
                    })
                    ->leftJoin('user_horoscope_details','users.id','=','user_horoscope_details.user_id')
                    ->leftJoin('zodiac_match_logics', function($join) use ($horoscope_detail) {
                        $join->on('user_horoscope_details.zodiac_sign','=','zodiac_match_logics.male_zodiac')
                            ->where('zodiac_match_logics.female_zodiac', $horoscope_detail->zodiac_sign);
                    })
                    ->leftJoin('vasaa_logics', function($join) use ($horoscope_detail) {
                        $join->on('user_horoscope_details.zodiac_sign','=',DB::raw('IF(user_personal_details.gender=0,vasaa_logics.var_raashi,vasaa_logics.kanya_raashi)'))
                            ->where('user_horoscope_details.naksatra',DB::raw('IF(user_personal_details.gender=0,vasaa_logics.var_nakshatra,vasaa_logics.kanya_nakshatra)'))
                            ->where(DB::raw('IF(user_personal_details.gender=0,vasaa_logics.kanya_raashi,vasaa_logics.var_raashi)'),$horoscope_detail->zodiac_sign)
                            ->where(DB::raw('IF(user_personal_details.gender=0,vasaa_logics.kanya_nakshatra,vasaa_logics.var_nakshatra)'),$horoscope_detail->naksatra);
                    })
                    ->where('role','2')
                    ->when(!empty($preferences->age_lower),function($query) use ($preferences){
                        $query->where('user_personal_details.dob','<=',\Carbon\Carbon::now()->subYears($preferences->age_lower)->toDateTimeString());
                    })
                    ->when(!empty($preferences->age_higher),function($query) use ($preferences){
                        $query->where('user_personal_details.dob','>=',\Carbon\Carbon::now()->subYears($preferences->age_higher)->toDateTimeString());
                    })
                    ->when(!empty($preferences->height_lower),function($query) use ($preferences){
                        $query->where('user_personal_details.height','>=',$preferences->height_lower);
                    })
                    ->when(!empty($preferences->height_higher),function($query) use ($preferences){
                        $query->where('user_personal_details.height','<=',$preferences->height_higher);
                    })
                    ->when(!empty($preferences->weight_lower),function($query) use ($preferences){
                        $query->where('user_personal_details.weight','>=',$preferences->weight_lower);
                    })
                    ->when(!empty($preferences->weight_higher),function($query) use ($preferences){
                        $query->where('user_personal_details.weight','<=',$preferences->weight_higher);
                    });

        if(!empty($preferences->marital_status) && $preferences->marital_status!='null')
        {
            $filter = json_decode($preferences->marital_status);
            $customers = $customers->whereIn('user_personal_details.marital_status',$filter);
        }

        if(!empty($preferences->fitness) && $preferences->fitness!='null')
        {
            $filter = json_decode($preferences->fitness);
            $customers = $customers->whereIn('user_personal_details.fitness',$filter);
        }

        if(!empty($preferences->skin) && $preferences->skin!='null')
        {
            $filter = json_decode($preferences->skin);
            $customers = $customers->whereIn('user_personal_details.skin',$filter);
        }

        if(!empty($preferences->physical_handicape) && $preferences->physical_handicape!=2)
        {
            $customers = $customers->where('user_personal_details.physical_handicape',$preferences->physical_handicape);
        }

        if(!empty($preferences->diet) && $preferences->diet!='null')
        {
            $filter = json_decode($preferences->diet);
            $customers = $customers->whereIn('user_personal_details.diet',$filter);
        }

        if(!empty($preferences->country) && $preferences->country!='null')
        {
            $filter = json_decode($preferences->country);
            $customers = $customers->whereIn('user_personal_details.country_id',$filter);
        }

        if(!empty($preferences->state) && $preferences->state!='null')
        {
            $filter = json_decode($preferences->state);
            $customers = $customers->whereIn('user_personal_details.state_id',$filter);
        }

        if(!empty($preferences->city) && $preferences->city!='null')
        {
            $filter = json_decode($preferences->city);
            $customers = $customers->whereIn('user_personal_details.city_id',$filter);
        }

        if(!empty($preferences->qualification) && $preferences->qualification!='null')
        {
            $filter = json_decode($preferences->qualification);
            $customers = $customers->whereIn('user_education_career_details.highest_qualification',$filter);
        }

        if(!empty($preferences->diet) && $preferences->diet!='null')
        {
            $filter = json_decode($preferences->diet);
            $customers = $customers->whereIn('user_personal_details.diet',$filter);
        }

        if(!empty($preferences->monthly_income_lower))
        {
            $customers = $customers->where('user_education_career_details.monthly_income','>=',$preferences->monthly_income_lower);
        }

        if(!empty($preferences->monthly_income_higher))
        {
            $customers = $customers->where('user_education_career_details.monthly_income','<=',$preferences->monthly_income_higher);
        }

        if(!empty($preferences->religion) && $preferences->religion!='null')
        {
            $filter = json_decode($preferences->religion);
            $customers = $customers->whereIn('user_family_details.religion',$filter);
        }

        if(!empty($preferences->caste) && $preferences->caste!='null')
        {
            $filter = json_decode($preferences->caste);
            $customers = $customers->whereIn('user_family_details.caste',$filter);
        }

        if(!empty($preferences->family_type) && $preferences->family_type!='null')
        {
            $filter = json_decode($preferences->family_type);
            $customers = $customers->whereIn('user_family_details.family_type',$filter);
        }
        if(empty(session('dashboardOrder')))
            session()->put(['dashboardOrder'=>rand(1,999999)]);

        $customers = $customers->where('users.step','>',4)
                    ->where('is_blocked',0)
                    ->whereNotIn('users.id',$blocked)
                    ->groupBy('users.id')
                    ->inRandomOrder(session('dashboardOrder'))
                    ->paginate(10,[
                    // ->get([
                        'users.id',
                        'user_personal_details.image',
                        DB::raw('user_personal_details.image_original'),
                        'user_personal_details.image_visible',
                        'user_personal_details.first_name',
                        'user_personal_details.last_name',
                        'user_personal_details.dob',
                        DB::raw('countries.name AS countryName'),
                        DB::raw('states.name AS stateName'),
                        DB::raw('cities.name AS cityName'),
                        'user_personal_details.mother_tongue',
                        'user_personal_details.marital_status',
                        'user_family_details.religion',
                        'user_family_details.caste',
                        'user_education_career_details.profession',
                        DB::raw('IF(user_requests.id IS NULL,0,1) AS request_sent'),
                        DB::raw('IF(user_requests_received.id IS NULL,0,1) AS request_received'),
                        DB::raw('user_requests_image.status AS image_requested_status'),
                        DB::raw('user_requests_image_received.status AS image_requested_received_status'),
                        DB::raw('IF(user_horoscope_details.janmaksar_type=0 OR user_horoscope_details.naksatra=0 OR user_horoscope_details.zodiac_sign=0 OR user_horoscope_details.gan=0 OR user_horoscope_details.naadi=0,0,1) AS horoscope_details_available'),
                        DB::raw('zodiac_match_logics.result AS zodiac_result'),
                        DB::raw('vasaa_logics.gun AS vasaa_gun'),
                        DB::raw('user_horoscope_details.naadi AS horoscope_naadi'),
                        DB::raw('user_horoscope_details.zodiac_sign AS zodiac'),
                        DB::raw('user_horoscope_details.naksatra AS nakshatra'),
                        DB::raw('user_horoscope_details.janmaksar_type AS janmaksar_type')
                    ]);

        $customerObjs = User::whereIn('id',$customers->pluck('id'))->get();
        // $customers = User::with(['personal_detail','personal_detail.city','personal_detail.state','personal_detail.country','education_career_detail','family_detail'])->where('role','2')->get();
        return view('customer.dashboard',compact('countries','customers','preferences','check_janmaksar','check_janmaksar_details','customerObjs'));
    }

    public function storePreferences(Request $request)
    {
        $array = [
            'age_lower' => $request->age_lower,
            'age_higher' => $request->age_higher,
            'height_lower' => $request->height_lower,
            'height_higher' => $request->height_higher,
            'weight_lower' => $request->weight_lower,
            'weight_higher' => $request->weight_higher,
            'marital_status' => json_encode($request->marital_status),
            'fitness' => json_encode($request->fitness),
            'skin' => json_encode($request->skin),
            'physical_handicape' => $request->physical_handicape,
            'diet' => json_encode($request->diet),
            'country' => json_encode($request->country),
            'state' => json_encode($request->state),
            'city' => json_encode($request->city),
            'qualification' => json_encode($request->qualification),
            'monthly_income_lower' => $request->monthly_income_lower,
            'monthly_income_higher' => $request->monthly_income_higher,
            'religion' => json_encode($request->religion),
            'caste' => json_encode($request->caste),
            'family_type' => json_encode($request->family_type)];

        $preferences = UserPreference::updateOrCreate(['user_id' => auth()->id()],$array);
        
        return redirect()->route('dashboard')->with(['status'=>'success','message'=>'Matches filtered based on preferences']);
    }

    public function clearPreferences(Request $request)
    {
        $array = [
            'age_lower' => NULL,
            'age_higher' => NULL,
            'height_lower' => NULL,
            'height_higher' => NULL,
            'weight_lower' => NULL,
            'weight_higher' => NULL,
            'marital_status' => NULL,
            'fitness' => NULL,
            'skin' => NULL,
            'physical_handicape' => NULL,
            'diet' => NULL,
            'country' => NULL,
            'state' => NULL,
            'city' => NULL,
            'qualification' => NULL,
            'monthly_income_lower' => NULL,
            'monthly_income_higher' => NULL,
            'religion' => NULL,
            'caste' => NULL,
            'family_type' => NULL];

        $preferences = UserPreference::updateOrCreate(['user_id' => auth()->id()],$array);
        
        return redirect()->route('dashboard')->with(['status'=>'success','message'=>'Cleared all filters']);
    }

    public function storePersonalDetail(PersonalDetailRequest $request)
    {
        $array = $request->validated();

        $array['addiction'] = json_encode([]);
        $array['contact'] = json_encode($array['contact']);

        $array['image'] = 'male.png';
        if($request->gender==1)
            $array['image'] = 'female.png';

        if(!empty($request->addiction))
        {
            $array['addiction'] = json_encode($request->addiction);
        }
        if(!empty(auth()->user()->personal_detail))
        {
            if(!empty(auth()->user()->personal_detail->image))
            {
                $array['image'] = auth()->user()->personal_detail->image;
                $array['gender'] = auth()->user()->personal_detail->gender;
            }
            auth()->user()->personal_detail->update($array);
            return redirect()->back()->with(['status'=>'success','message'=>'Personal Details updated successfully']);
        }
        $array['user_id']=auth()->id();
        $personal_detail = UserPersonalDetail::create($array);
        if($request->gender==1)
            auth()->user()->update(['subscribed'=>1]);
        auth()->user()->update(['step'=>1,'name'=>$array['first_name'].' '.$array['last_name']]);

        return redirect()->back()->with(['status'=>'success','message'=>'Personal Details store, One more step completed!']);
    }

    public function storeEducationDetail(EducationCareerDetailRequest $request)
    {
        $array = $request->validated();
        if(!empty(auth()->user()->education_career_detail))
        {
            auth()->user()->education_career_detail->update($array);
            return redirect()->back()->with(['status'=>'success','message'=>'Education and Career Details updated successfully']);
        }

        $array['user_id'] = auth()->id();
        $education_detail = UserEducationCareerDetail::create($array);
        auth()->user()->update(['step'=>2]);
        return redirect()->back()->with(['status'=>'success','message'=>'Education and Career details has been stored, Just few more details and you done!']);
    }

    public function storeFamilyDetail(FamilyDetailRequest $request)
    {
        $array = $request->only(['religion','caste','sub_caste','father_name','mother_name','father_occupation','mother_occupation','mosal','parental_address','family_type','property_detail']);
        $brothers = [];
        $sisters = [];

        if(!empty($request->brother_name))
            for($i=0;$i<count($request->brother_name);$i++)
            {
                $brothers[] = [
                    'name'=>$request->brother_name[$i],
                    'married'=>$request->brother_married[$i+1],
                    'education'=>$request->brother_education[$i]
                ];
            }

        if(!empty($request->sister_name))
            for($i=0;$i<count($request->sister_name);$i++)
            {
                $sisters[] = [
                    'name'=>$request->sister_name[$i],
                    'married'=>$request->sister_married[$i+1],
                    'education'=>$request->sister_education[$i]
                ];
            }

        $array['brothers_detail'] = json_encode($brothers);
        $array['sisters_detail'] = json_encode($sisters);

        if(!empty(auth()->user()->family_detail))
        {
            auth()->user()->family_detail->update($array);
            return redirect()->back()->with(['status'=>'success','message'=>'Family Details updated successfully']);
        }
        $array['user_id'] = auth()->id();
        $family_detail = UserFamilyDetail::create($array);
        auth()->user()->update(['step'=>3]);
        return redirect()->back()->with(['status'=>'success','message'=>'Family details are store successfully, Final Step now!']);
    }

    public function storeHoroscopeDetail(HoroscopeDetailRequest $request)
    {
        $array = $request->validated();
        if(!empty(auth()->user()->horoscope_detail))
        {
            auth()->user()->horoscope_detail->update($array);
            return redirect()->back()->with(['status'=>'success','message'=>'Horoscope Details updated successfully']);
        }

        $array['user_id'] = auth()->id();
        $horoscope_detail = UserHoroscopeDetail::create($array);
        auth()->user()->update(['step'=>4]);
        return redirect()->back()->with(['status'=>'success','message'=>'Horoscope Details stored successfully!']);
    }

    public function storeProfilePicture(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'image.*'=>'image|mimes:jpg,jpeg,png']);

        if($validator->fails())
        {
            return redirect()->back()->withErrors($validator->errors());
        }

        /*********Check if personal details available***********/
        if(empty(auth()->user()->personal_detail))
        {
            auth()->user()->update(['step'=>0]);
            return redirect()->back()->with(['status'=>'error','message'=>'Personal Details pending, First fill the pending details from profile']);
        }


        if(empty($request->image))
        {
            $image = ($request->gender==1)?'["female.png"]':'["male.png"]';

            if($request->image_visible==1)
                $image = auth()->user()->personal_detail->image_original;

            auth()->user()->personal_detail->update(['image_visible'=>$request->image_visible,'image'=>$image]);

            auth()->user()->personal_detail->update(['image_visible'=>$request->image_visible]);
            return redirect()->back()->with(['status'=>'success','message'=>'Profile Picture Visibility updated successfully']);
        }

        if(count($request->image)>5)
        {
            return redirect()->back()->with(['status'=>'error','message'=>'Maximum 5 Images are allowed']);
        }

        $name = json_decode(auth()->user()->personal_detail->image_original);
        if(!empty($name) && count($name)>0)
        {
            foreach($name as $old_img)
                File::delete(public_path('/assets/img/user/'. $old_img));
        }
        $array = [];
        $i=1;
        foreach($request->image as $img)
        {
            $filename = 'file_'.auth()->id().'_'.$i++.'_'.time().'.'.$img->getClientOriginalExtension();

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

        auth()->user()->personal_detail->update(['image'=>$image,'image_visible'=>$request->image_visible,'image_original'=>$name]);
        auth()->user()->update(['step'=>5]);

        return redirect()->back()->with(['status'=>'success','message'=>'Profile picture updated successfully']);

    }

    public function updateLoginDetail(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'email'=>'required|email|unique:users,email,'.auth()->id(),
            'password'=>'same:password_confirmation']);

        if($validator->fails())
        {
            return redirect()->back()->withErrors($validator->errors());
        }

        if(!empty($request->password))
            auth()->user()->update(['email'=>$request->email,'password'=>bcrypt($request->password)]);
        else
            auth()->user()->update(['email'=>$request->email]);
        return redirect()->back()->with(['status'=>'success','message'=>'Login Details Updated Successfully']);
    }

    public function profile()
    {
        $countries = Country::all(['id','name']);
        $states = State::where('country_id',auth()->user()->personal_detail->country_id)->get(['id','name']);
        $cities = City::where('state_id',auth()->user()->personal_detail->state_id)->get(['id','name']);
        return view('customer.profile',compact('countries','states','cities'));
    }

    public function aboutus()
    {
        return view('customer.aboutus');
    }
}
