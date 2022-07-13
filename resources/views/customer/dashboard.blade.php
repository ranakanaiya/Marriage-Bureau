@extends('customer.layout.app')

@section('title')
Dashboard
@endsection

@section('styles')
<link href="{{asset('/assets/plugins/iCheck/all.css')}}" rel="stylesheet" type="text/css" />
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<link href="{{asset('/frontend_assets/dist/css/slideshow.css')}}" rel="stylesheet" type="text/css" />
<style>
.div-img {
  display: inline-block;
}
.div-img img {
  height: 250px;
  width: 200px;
  object-fit: cover;
  object-position: 50% 0%;
}
.div-img-content {
  display: inline-blocks;
}
@media only screen and (max-width: 767px) {
  .div-img img {
    height: auto;
    width: 100%;
    object-fit: contain;
  }
}

/*.div-img img {
  transform: scale(1.25);
}*/
</style>
@endsection

@section('content')
<section class="content-header">
  <h1>
    Dashboard
    <small>Control panel</small>
  </h1>
  <ol class="breadcrumb">
    <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
    <li class="active">Dashboard</li>
  </ol>
</section>

<!-- Main content -->
<section class="content">
  <div class="row">
    <div class="col-sm-12">

      <div class="box box-primary collapsed-box">
        <div class="box-header">
          <h3 class="box-title">Filter</h3>
          <div class="box-tools pull-right">
            <button class="btn btn-primary btn-xs" data-widget="collapse"><i class="fa fa-plus"></i></button>
            <button class="btn btn-primary btn-xs" data-widget="remove"><i class="fa fa-times"></i></button>
          </div>
        </div><!-- /.box-header -->
        <form method="post" action="{{route('dashboard.preferences.store')}}" enctype="multipart/form-data">
          @csrf
          <div class="box-body">
            <div class="row">
              <div class="col-md-12 row">
                <div class="col-md-4 form-group">
                  <label>Age&nbsp;:&nbsp;</label>
                  <input type="number" class="form-control" value="{{$preferences->age_lower}}" min="18" name="age_lower" id="age_lower" style="width:85px;display: inline-block;">
                  <label>&nbsp;To&nbsp;</label>&nbsp;
                  <input type="number" class="form-control" min="18" value="{{$preferences->age_higher}}" name="age_higher" id="age_higher" style="width:85px;display: inline-block;">
                </div>
                <div class="col-md-4 form-group">
                  <label>Height&nbsp;:&nbsp;</label>
                  <input type="number" value="{{$preferences->height_lower}}" class="form-control" min="60" name="height_lower" id="height_lower" style="width:85px;display: inline-block;">
                  <label>&nbsp;To&nbsp;</label>&nbsp;
                  <input type="number" value="{{$preferences->height_higher}}" class="form-control" min="60" name="height_higher" id="height_higher" style="width:85px;display: inline-block;">
                </div>
                <div class="col-md-4 form-group">
                  <label>Weight&nbsp;:&nbsp;</label>
                  <input type="number" value="{{$preferences->weight_lower}}" class="form-control" min="10" name="weight_lower" id="weight_lower" style="width:85px;display: inline-block;">
                  <label>&nbsp;To&nbsp;</label>&nbsp;
                  <input type="number" value="{{$preferences->weight_higher}}" class="form-control" min="10" name="weight_higher" id="weight_higher" style="width:85px;display: inline-block;">
                </div>
              </div>

              <div class="col-md-12 row">
                <div class="col-md-6 form-group">
                  <label>Marital Status</label>
                  <select name="marital_status[]" id="marital_status" multiple class="form-control select2" style="width: 100%;">
                    @foreach(config('constants.MARRITAL_STATUS') as $key=>$val)
                    <option value="{{$val}}">{{$key}}</option>
                    @endforeach
                  </select>
                </div>
                <div class="col-md-6 form-group">
                  <label>Fitness</label>
                  <select name="fitness[]" id="fitness" multiple class="form-control select2" style="width: 100%;">
                    @foreach(config('constants.FITNESS') as $key=>$val)
                    <option value="{{$val}}">{{$key}}</option>
                    @endforeach
                  </select>
                </div>
              </div>

              <div class="col-md-12 row">
                <div class="col-md-6 form-group">
                  <label>Skin Tone</label>
                  <select name="skin[]" id="skin" multiple class="form-control select2" style="width: 100%;">
                    @foreach(config('constants.SKINTONE') as $key=>$val)
                    <option value="{{$val}}">{{$key}}</option>
                    @endforeach
                  </select>
                </div>
                <div class="col-md-6 form-group">
                  <label>Physical Handicape</label>
                  <select name="physical_handicape" id="physical_handicape" class="form-control" style="width: 100%;">
                    <option value="0" {{($preferences->physical_handicape==0?'selected':'')}}>No</option>
                    <option value="1" {{($preferences->physical_handicape==1?'selected':'')}}>Yes</option>
                    <option value="2" {{($preferences->physical_handicape==2?'selected':'')}}>All</option>
                  </select>
                </div>
              </div>

              <div class="col-md-12 row">
                <div class="col-md-6 form-group">
                  <label>Diet</label>
                  <select name="diet[]" id="diet" multiple class="form-control select2" style="width: 100%;">
                    @foreach(config('constants.DIET') as $key=>$val)
                    <option value="{{$val}}">{{$key}}</option>
                    @endforeach
                  </select>
                </div>
                <div class="col-md-6 form-group">
                  <label>Country</label>
                  <select name="country[]" multiple id="country_id" class="form-control select2" style="width: 100%;">
                    @foreach($countries as $country)
                    <option value="{{$country->id}}">{{$country->name}}</option>
                    @endforeach
                  </select>
                </div>
              </div>

              <div class="col-md-12 row">
                <div class="col-md-6 form-group">
                  <label>State</label>
                  <select name="state[]" id="state_id" multiple class="form-control select2" style="width: 100%;">
                  </select>
                </div>
                <div class="col-md-6 form-group">
                  <label>City</label>
                  <select name="city[]" id="city_id" multiple class="form-control select2" style="width: 100%;">
                  </select>
                </div>
              </div>

              <div class="col-md-12 row">
                <div class="col-md-6 form-group">
                  <label>Education Qualification</label>
                  <select name="qualification[]" multiple id="qualification" class="form-control select2" style="width: 100%;">
                    @foreach(config('constants.HIGHEST_QUALIFICATION') as $key=>$val)
                      @if(!empty(config('constants.QUALIFICATION_GROUP')[$loop->iteration-1]))
                        <optgroup label="{{config('constants.QUALIFICATION_GROUP')[$loop->iteration-1]}}"></optgroup>
                      @endif
                      <option value="{{$key}}">{{$key}}</option>
                    @endforeach
                  </select>
                </div>
                <div class="col-md-6 form-group">
                  <label>Monthly Salary&nbsp;:&nbsp;</label><br>
                    <input type="number" class="form-control" min="1000" name="monthly_income_lower" id="monthly_income_lower" value="{{$preferences->monthly_income_lower}}" style="width:145px;display: inline-block;">
                    <label>&nbsp;To&nbsp;</label>&nbsp;<input type="number" class="form-control" min="1000" name="monthly_income_higher" value="{{$preferences->monthly_income_higher}}" id="monthly_income_higher" style="width:145px;display: inline-block;">
                </div>
              </div>

              <div class="col-md-12 row">
                <div class="col-md-6 form-group">
                  <label>Religion</label>
                  <select name="religion[]" multiple id="religion" class="form-control select2" style="width: 100%;">
                    @foreach(config('constants.RELIGION') as $key=>$val)
                      <option value="{{$key}}">{{$key}}</option>
                    @endforeach
                  </select>
                </div>
                <div class="col-md-6 form-group">
                  <label>Caste</label><br>
                  <select name="caste[]" multiple id="caste" class="form-control select2" style="width: 100%;">
                    @foreach(config('constants.CASTE') as $key=>$val)
                      <option value="{{$key}}">{{$key}}</option>
                    @endforeach
                  </select>
                </div>
              </div>

              <div class="col-md-12 row">
                <div class="col-md-6 form-group">
                  <label>Family Type</label>
                  <select name="family_type[]" multiple id="family_type" class="form-control select2" style="width: 100%;">
                    @foreach(config('constants.FAMILY_TYPE') as $key=>$val)
                      <option value="{{$val}}">{{$key}}</option>
                    @endforeach
                  </select>
                </div>
              </div>

              <div class="col-md-12 row">
                <div class="col-md-6 form-group">
                  <button type="submit" class="btn btn-primary">Filter Matches</button>
                  <button type="button" class="btn btn-primary" onclick="location.href='{{route('dashboard.preferences.clear')}}';">Clear Filters</button>
                </div>
              </div>

            </div>
          </div>
          <!-- /.box-body -->
        </form>
      </div><!-- /.box -->
    </div><!-- /.col -->

    <div class="col-sm-12">

      <div class="box box-primary">
        <div class="box-header">
          <h3 class="box-title">Matches</h3>
          <div class="box-tools pull-right">
            <button class="btn btn-primary btn-xs" data-widget="collapse"><i class="fa fa-minus"></i></button>
            <button class="btn btn-primary btn-xs" data-widget="remove"><i class="fa fa-times"></i></button>
          </div>
        </div><!-- /.box-header -->
        <div class="box-body">
          <div class="row">
            @php
            $i=0;
            @endphp
            @foreach($customers as $customer)
            <div class="col-md-12">
              <div class="panel panel-default">
                <div class="panel-body">
                  <div class="col-md-4 col-sm-5 col-xs-12 text-center">

                    @php
                    $imgs=[];
                    @endphp

                    <div class="div-img slide-master col-md-12" data-activeslide="1">
                      @php
                      if(!empty($customerObjs[$i]->sent_image_request(auth()->id())) && $customerObjs[$i]->sent_image_request(auth()->id())->status==1)
                      {
                        $imgs = json_decode($customers[$i]->image_original);
                      }
                      elseif(!empty($customerObjs[$i]->received_image_request(auth()->id())) && $customerObjs[$i]->received_image_request(auth()->id())->status==1)
                      {
                        $imgs = json_decode($customers[$i]->image_original);
                      }
                      else
                        $imgs = json_decode($customers[$i]->image);
                      $i++;
                      @endphp

                      @foreach($imgs as $img)
                        <img class="slide" alt="{{$customers[$i-1]->first_name}} {{$customers[$i-1]->last_name}}" src="{{asset('/assets/img/user/'.$img)}}" loading="lazy">
                      @endforeach

                      @if(count($imgs)>1)
                      <span class="slides-caption">1 / {{count($imgs)}}</span>
                      <button class="slide-button slide-button-left" onclick="nextSlide(-1,this)">&#10094;</button>
                      <button class="slide-button slide-button-right" onclick="nextSlide(+1,this)">&#10095;</button>
                      @endif
                      {{-- <img alt="Profile Picture" src="{{asset('/assets/img/user/'.(($customer->image_requested_status===1 || $customer->image_requested_received_status===1)?$customer->image_original:$customer->image))}}"> --}}
                    </div>
                    @if($customer->image_visible==0)
                    <div class="col-md-12 mt-2">
                      @if($customer->image_requested_status==NULL && $customer->image_requested_received_status==NULL)
                      <form method="post" action="{{route('customers.request.image.store',$customer->id)}}">
                        @csrf
                        <button type="button" onclick="sendRequest(this,'{{ucwords($customer->first_name)}} {{ucwords($customer->last_name)}}')" class="btn btn-primary">Request Picture</button>
                      </form>
                      @elseif($customer->image_requested_status==0 || $customer->image_requested_received_status==0)
                      <span class="text-aqua btn">Request sent for Image</span>
                      @elseif($customer->image_requested_status==1 || $customer->image_requested_received_status==1)
                      <span></span>
                      @else
                      <span class="text-red btn">Rejected</span>
                      @endif
                    </div>
                    @endif
                  </div>
                  <div class="div-img-content col-md-8 col-sm-7 col-xs-12">
                    <div class="col-md-8 col-sm-12">
                      <h2><a href="{{route('customer.details',$customer->id)}}">{{ucwords($customer->first_name)}} {{ucwords($customer->last_name)}}</a></h2>
                    </div>
                    <div class="col-md-4 col-sm-12" style="min-height:50px;">
                      <form method="post" class="d-inline pull-right ml-2" action="{{route('user.block',$customer->id)}}">
                        @csrf
                        <a title="Block" onclick="CustomerBlock(this,'{{$customer->first_name}} {{$customer->last_name}}')" class="btn btn-primary">Block</a>
                      </form>

                      @if(auth()->user()->subscribed)
                        @if($customer->request_sent)
                          <span class="btn text-primary pull-right">Request Already Sent</span>
                        @elseif($customer->request_received)
                          <span class="btn text-primary pull-right">Request Already Received</span>
                        @else
                          <form method="post" action="{{route('customer.request.store',$customer->id)}}">
                            @csrf
                            <button type="button" onclick="sendRequest(this,'{{ucwords($customer->first_name)}} {{ucwords($customer->last_name)}}')" class="btn btn-primary pull-right">Send Request</button>
                          </form>
                        @endif
                      @else
                      <a href="{{route('subscription.plans')}}" class="btn btn-primary pull-right">Subscribe</a>
                      @endif

                    </div>
                    <div class="col-md-6 col-xs-12">
                      <table class="table">
                        <tr>
                          <th>Age:</th>
                          <td>{{\Carbon\Carbon::parse($customer->dob)->diff(\Carbon\Carbon::now())->format('%y years');}}
                          </td>
                        </tr>
                        <tr>
                          <th>Location:</th>
                          <td>{{$customer->cityName.', '.$customer->stateName.', '.$customer->countryName}}
                          </td>
                        </tr>
                        <tr>
                          <th>Mother Tongue:</th>
                          <td>{{$customer->mother_tongue }}
                          </td>
                        </tr>

                      </table>
                    </div>
                    <div class="col-md-6 col-xs-12">
                      <table class="table">
                        <tr>
                          <th>Marital Status:</th>
                          <td>{{array_keys(config('constants.MARRITAL_STATUS'),$customer->marital_status)[0]}}
                          </td>
                        </tr>
                        <tr>
                          <th>Religion/Caste:</th>
                          <td>{{$customer->religion.', '.$customer->caste}}
                          </td>
                        </tr>
                        <tr>
                          <th>Profession:</th>
                          <td>{{$customer->profession}}
                          </td>
                        </tr>
                      </table>
                    </div>
                    @if($check_janmaksar)
                    <div class="col-md-12">
                      <table class="table">
                        <tr>
                          <th>Janmaksar Match Result:</th>
                          @if(!empty($check_janmaksar_details))

                            @if(!empty($customer->horoscope_details_available))
                              @if(!empty($customer->zodiac_result))
                                <td><span class="text-red">Raashi {{$customer->zodiac_result}} (Not Matched)</span></td>
                              @else
                                @if(auth()->user()->horoscope_detail->janmaksar_type==3 || $customer->janmaksar_type==3 || auth()->user()->horoscope_detail->janmaksar_type==$customer->janmaksar_type)

                                  @if(empty($customer->vasaa_gun) || $customer->vasaa_gun<18)
                                  <td><span class="text-red">Janmaksar did not matched with too Low Vasaa Gun (Vasaa Gun: {{(is_null($customer->vasaa_gun)?0:$customer->vasaa_gun)}})</span></td>
                                  @elseif($customer->horoscope_naadi==auth()->user()->horoscope_detail->naadi)
                                    @php
                                      $user1Raashi = array_search(auth()->user()->horoscope_detail->zodiac_sign,config('constants.ZODIAC_SIGN'));
                                      $user1Nakshatra = array_search(auth()->user()->horoscope_detail->naksatra,config('constants.NAKSHATRA'));
                                      $user1Gender = auth()->user()->personal_detail->gender;
                                      $user1Charan = config('constants.CHARAN')[$user1Gender][$user1Raashi][$user1Nakshatra];

                                      $user2Raashi = array_search($customer->zodiac,config('constants.ZODIAC_SIGN'));
                                      $user2Nakshatra = array_search($customer->nakshatra,config('constants.NAKSHATRA'));
                                      $user2Charan = config('constants.CHARAN')[!$user1Gender][$user2Raashi][$user2Nakshatra];
                                    @endphp
                                    @if(abs($user1Charan-$user2Charan)>=2)
                                    <td><span class="text-green">Janmaksar Matched Successfully (Mithi Naadi) (Vasaa Gun: {{$customer->vasaa_gun}})</span></td>
                                    @else
                                    <td><span class="text-red">No Matched with Naadi Dosh (Karvi Naadi) (Vasaa Gun: {{$customer->vasaa_gun}})</span></td>
                                    @endif
                                  @else
                                  <td><span class="text-green">Janmaksar Matched Successfully (Vasaa Gun: {{$customer->vasaa_gun}})</span></td>
                                  @endif
                                @else
                                  <td><span class="text-red">Janmaksar Type did not matched ({{array_search($customer->janmaksar_type,config('constants.JANMAKSAR_TYPE'))}} - {{array_search(auth()->user()->horoscope_detail->janmaksar_type,config('constants.JANMAKSAR_TYPE'))}})</span></td>
                                @endif
                              @endif
                            @else
                              <td><span class="text-aqua">This user has insufficient horoscope details to match</span></td>
                            @endif

                          @else
                          <td><span class="text-aqua">Insufficient horoscope data to match, Please fill up your horoscope details from profile page.</span></td>
                          @endif
                        </tr>
                      </table>
                    </div>
                    @endif
                  </div>
                </div>
              </div>
            </div>
            @endforeach
            <div class="col-md-12">
              @if(count($customers)>0)
              <div class="pagination pull-right no-margin">
              {{$customers->links('pagination::bootstrap-4')}}
              </div>
              @endif
            </div>
          </div>
        </div>
          <!-- /.box-body -->
      </div><!-- /.box -->
    </div><!-- /.col -->
  </div>

@if(auth()->user()->step<1)
<div id="personalDetailModal" class="modal fade" role="dialog" data-backdrop="static" data-keyboard="false">
  <div class="modal-dialog modal-lg">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        {{-- <button type="button" class="close" data-dismiss="modal">&times;</button> --}}
        <h4 class="modal-title">Personal Detail</h4>
      </div>
      <form method="post" action="{{route('dashboard.personal_detail')}}">
        @csrf
      <div class="modal-body">
        <div id="errorSectionModal">
        @if(Session::Has('message'))
              @if(Session::get('status') == 'success')
                <div class="alert alert-success alert-dismissible">
                  <button href="#" class="close" data-dismiss="alert" aria-label="close">&times;</button>
                  <strong>{{ucwords(Session::get('status'))}}!</strong> {{Session::get('message')}}
                </div>
              @else
                <div class="alert alert-danger alert-dismissible">
                  <button href="#" class="close" data-dismiss="alert" aria-label="close">&times;</button>
                  <strong>{{ucwords(Session::get('status'))}}!</strong> {{Session::get('message')}}
                </div>
              @endif
        @endif
        @if ($errors->any())
                
            @foreach ($errors->all() as $error)
                <div class="alert alert-danger alert-dismissible">
                  <button href="#" class="close" data-dismiss="alert" aria-label="close">&times;</button>
                  <strong>Error!</strong> {{$error}}
                </div>
            @endforeach
        @endif
        </div>

        <div class="row">
          <div class="col-md-12">
            <div class="col-md-4 col-sm-12">
              <div class="form-group">
                <label for="firstName">First Name<span class="text-danger">*</span></label>
                <input type="text" name="first_name" id="firstName" class="form-control" placeholder="First Name" required>
              </div>
            </div>
            <div class="col-md-4 col-sm-12">
              <div class="form-group">
                <label for="middleName">Middle Name<span class="text-danger">*</span></label>
                <input type="text" name="middle_name" id="middleName" class="form-control" placeholder="Middle Name" required>
              </div>
            </div>
            <div class="col-md-4 col-sm-12">
              <div class="form-group">
                <label for="lastName">Last Name<span class="text-danger">*</span></label>
                <input type="text" name="last_name" id="lastName" class="form-control" placeholder="Last Name" required>
              </div>
            </div>
            <div class="col-md-12">
              <div class="form-group">
                <label>Gender<span class="text-danger">*</span></label>
                <label><input type="radio" name="gender" value="0" class="minimal" checked>Male</label>
                <label><input type="radio" name="gender" value="1" class="minimal">Female</label>
              </div>
            </div>
          </div>
        </div>

        <div class="col-md-12">
          <div class="form-group">
            <label for="address">Address<span class="text-danger">*</span></label>
            <textarea class="form-control" name="address" placeholder="Address" rows="3" required></textarea>
          </div>
        </div>

        <div class="row">
          <div class="col-md-12">
            <div class="col-md-4 col-sm-12">
              <div class="form-group">
                <label for="country">Country<span class="text-danger">*</span></label>
                <select name="country_id" id="country" class="form-control" required>
                  <option value="">Select Country</option>
                  @foreach($countries as $country)
                  <option value="{{$country->id}}">{{$country->name}}</option>
                  @endforeach
                </select>
              </div>
            </div>
            <div class="col-md-4 col-sm-12">
              <div class="form-group">
                <label for="state">State<span class="text-danger">*</span></label>
                <select name="state_id" id="state" class="form-control" required>
                  <option value="">Select State</option>
                </select>
              </div>
            </div>
            <div class="col-md-4 col-sm-12">
              <div class="form-group">
                <label for="city">City<span class="text-danger">*</span></label>
                <select name="city_id" id="city" class="form-control" required>
                  <option value="">Select City</option>
                </select>
              </div>
            </div>
          </div>
        </div>

        <div class="row">
          <div class="col-md-12">
            <div class="col-md-3 col-sm-6 col-sm-12">
              <div class="form-group">
                <label for="dob">Date of Birth<span class="text-danger">*</span></label>
                <input type="date" name="dob" id="dob" class="form-control" placeholder="Date of Birth">
              </div>
            </div>
            <div class="col-md-3 col-sm-6 col-sm-12">
              <div class="form-group">
                <label for="birthTime">Birth Time</label>
                <input type="time" name="birth_time" id="birthTime" class="form-control" placeholder="Birth Time">
              </div>
            </div>
            <div class="col-md-3 col-sm-6 col-sm-12">
              <div class="form-group">
                <label for="height">Height(cm)<span class="text-danger">*</span></label>
                <input type="number" name="height" id="height" min="50" max="500" class="form-control" placeholder="Height" required>
              </div>
            </div>
            <div class="col-md-3 col-sm-6 col-sm-12">
              <div class="form-group">
                <label for="weight">Weight(kg)<span class="text-danger">*</span></label>
                <input type="number" name="weight" id="weight" min="15" max="250" class="form-control" placeholder="Weight" required>
              </div>
            </div>
          </div>
        </div>

        <div class="row">
          <div class="col-md-12">
            <div class="col-md-7 col-sm-12">
              <div class="form-group mt-2">
                <label>Marital Status<span class="text-danger">*</span>&nbsp;:&nbsp;&nbsp;</label>
                @foreach(config('constants.MARRITAL_STATUS') as $key => $val)
                <label>
                  <input type="radio" name="marital_status" value="{{$val}}" class="minimal" {{($loop->first?'checked':'')}}/>
                  {{$key}}&nbsp;
                </label>
                @endforeach
              </div>
              <div class="form-group">
                <label>Fitness<span class="text-danger">*</span>&nbsp;:&nbsp;&nbsp;</label>
                @foreach(config('constants.FITNESS') as $key => $val)
                <label>
                  <input type="radio" name="fitness" value="{{$val}}" class="minimal" {{($loop->first?'checked':'')}}/>
                  {{$key}}&nbsp;
                </label>
                @endforeach
              </div>
              <div class="form-group">
                <label>Skin Tone<span class="text-danger">*</span>&nbsp;:&nbsp;&nbsp;</label>
                @foreach(config('constants.SKINTONE') as $key => $val)
                <label>
                  <input type="radio" name="skin" value="{{$val}}" class="minimal" {{($loop->first?'checked':'')}}/>
                  {{$key}}&nbsp;
                </label>
                @endforeach
              </div>  
            </div>
            <div class="col-md-5 col-sm-12">
              <div class="form-group">
                <label>Mobile<span class="text-danger">*</span>:</label>
                <input type="text" name="contact[]" id="contact" class="form-control mb-2" placeholder="Contact 1" required>
                <input type="text" name="contact[]" id="contact2" class="form-control" placeholder="Contact 2" required>
              </div>
            </div>
          </div>  
        </div>

        <div class="row">
          <div class="col-md-12">
            <div class="col-md-5">
              <div class="form-group">
                <label for="bloodGroup">Blood Group</label>
                <input type="text" name="blood_group" id="bloodGroup" class="form-control" placeholder="Blood Group">
              </div>
            </div>
            <div class="col-md-7">
              <div class="form-group">
                <label for="motherTongue">Mother Tongue<span class="text-danger">*</span></label>
                <input type="text" name="mother_tongue" id="motherTongue" class="form-control" placeholder="Mother Tongue" required>
              </div>
            </div>
          </div>
        </div>

        <div class="row">
          <div class="col-md-12">
            <div class="col-md-3 col-sm-4 col-sm-12">
              <div class="form-group">
                <label>Physical Handicape<span class="text-danger">*</span>&nbsp;:&nbsp;&nbsp;</label>
                <div>
                <label>
                  <input type="radio" value="0" name="physical_handicape" class="minimal" checked/>
                  No&nbsp;
                </label>
                <label>
                  <input type="radio" value="1" name="physical_handicape" class="minimal"/>
                  Yes&nbsp;
                </label>
                </div>
              </div>
            </div>
            <div class="col-md-9 col-sm-8 col-xs-7">
              <div class="form-group">
                <label for="handicapeDetail">Phyisical Handicape Detail (If any)</label>
                <input type="text" name="physical_handicape_detail" id="handicapeDetail" class="form-control" placeholder="Phyisical Handicape Detail">
              </div>
            </div>
          </div>
        </div>

        <div class="row">
          <div class="col-md-12">
            <div class="col-md-3 col-sm-12">
              <div class="form-group">
                <label>Addiction&nbsp;:&nbsp;&nbsp;</label>
                <div>
                  <label>
                    <input type="checkbox" value="Smoking" name="addiction[]" class="minimal"/>
                    Smoking&nbsp;
                  </label>
                  <label>
                    <input type="checkbox" value="Drinking" name="addiction[]" class="minimal"/>
                    Drinking&nbsp;
                  </label>
                </div>
              </div>
            </div>
            <div class="col-md-6 col-sm-12">
              <div class="form-group">
                <label>Diet<span class="text-danger">*</span>&nbsp;:&nbsp;&nbsp;</label>
                <div>
                  @foreach(config('constants.DIET') as $key => $val)
                  <label>
                    <input type="radio" name="diet" value="{{$val}}" class="minimal" {{($loop->first?'checked':'')}}/>
                    {{$key}}&nbsp;
                  </label>
                  @endforeach
                </div>
              </div>
            </div>
            <div class="col-md-3 col-sm-12">
              <div class="form-group">
                <label for="familyDiet">Family Diet</label>
                <input type="text" name="family_diet" id="familyDiet" class="form-control" placeholder="Family Diet">
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-primary">Submit</button>
        {{-- <button type="button" class="btn btn-default" data-dismiss="modal">Close</button> --}}
      </div>
      </form>
    </div>

  </div>
</div>
@endif

@if(auth()->user()->step<2)
<div id="educationDetailModal" class="modal fade" role="dialog" data-backdrop="static" data-keyboard="false">
  <div class="modal-dialog modal-lg">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Education and Career Detail</h4>
      </div>
      <form method="post" action="{{route('dashboard.education_detail')}}">
        @csrf
      <div class="modal-body">
        <div>
        @if(Session::Has('message'))
              @if(Session::get('status') == 'success')
                <div class="alert alert-success alert-dismissible">
                  <button href="#" class="close" data-dismiss="alert" aria-label="close">&times;</button>
                  <strong>{{ucwords(Session::get('status'))}}!</strong> {{Session::get('message')}}
                </div>
              @else
                <div class="alert alert-danger alert-dismissible">
                  <button href="#" class="close" data-dismiss="alert" aria-label="close">&times;</button>
                  <strong>{{ucwords(Session::get('status'))}}!</strong> {{Session::get('message')}}
                </div>
              @endif
        @endif
        @if ($errors->any())
                
            @foreach ($errors->all() as $error)
                <div class="alert alert-danger alert-dismissible">
                  <button href="#" class="close" data-dismiss="alert" aria-label="close">&times;</button>
                  <strong>Error!</strong> {{$error}}
                </div>
            @endforeach
        @endif
        </div>
       <div class="row">
          <div class="col-md-12">
            <div class="col-md-6 col-sm-12">
              <div class="form-group">
                <label for="education">Education Qualification<span class="text-danger">*</span></label>
                <select name="highest_qualification" id="education" class="form-control" placeholder="Education Qualification" required>
                  @foreach(config('constants.HIGHEST_QUALIFICATION') as $key=>$val)
                    @if(!empty(config('constants.QUALIFICATION_GROUP')[$loop->iteration-1]))
                      <optgroup label="{{config('constants.QUALIFICATION_GROUP')[$loop->iteration-1]}}"></optgroup>
                    @endif
                    <option value="{{$key}}">{{$key}}</option>
                  @endforeach
                </select>
              </div>
            </div>
            <div class="col-md-6 col-sm-12">
              <div class="form-group">
                <label for="college">College/School Name<span class="text-danger">*</span></label>
                <input type="text" name="college_name" id="college" class="form-control" placeholder="College Name">
              </div>
            </div>
          </div>
        </div>

        <div class="row">
          <div class="col-md-12">
            <div class="col-md-6 col-sm-12">
              <div class="form-group">
                <label for="profession">Profession<span class="text-danger">*</span></label>
                <input type="text" name="profession" id="profession" class="form-control" placeholder="Profession" required>
              </div>
            </div>
            <div class="col-md-6 col-sm-12">
              <div class="form-group">
                <label for="monthly_income">Monthly Income<span class="text-danger">*</span></label>
                <input type="number" min="0" name="monthly_income" id="monthly_income" class="form-control" placeholder="Monthly Income">
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-primary">Submit</button>
        {{-- <button type="button" class="btn btn-default" data-dismiss="modal">Close</button> --}}
      </div>
      </form>
    </div>

  </div>
</div>
@endif

@if(auth()->user()->step<3)
<div id="familyDetailModal" class="modal fade" role="dialog" data-backdrop="static" data-keyboard="false">
  <div class="modal-dialog modal-lg">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Family Detail</h4>
      </div>  
      <form method="post" action="{{route('dashboard.family_detail')}}">
        @csrf
      <div class="modal-body">
        <div>
        @if(Session::Has('message'))
              @if(Session::get('status') == 'success')
                <div class="alert alert-success alert-dismissible">
                  <button href="#" class="close" data-dismiss="alert" aria-label="close">&times;</button>
                  <strong>{{ucwords(Session::get('status'))}}!</strong> {{Session::get('message')}}
                </div>
              @else
                <div class="alert alert-danger alert-dismissible">
                  <button href="#" class="close" data-dismiss="alert" aria-label="close">&times;</button>
                  <strong>{{ucwords(Session::get('status'))}}!</strong> {{Session::get('message')}}
                </div>
              @endif
        @endif
        @if ($errors->any())
                
            @foreach ($errors->all() as $error)
                <div class="alert alert-danger alert-dismissible">
                  <button href="#" class="close" data-dismiss="alert" aria-label="close">&times;</button>
                  <strong>Error!</strong> {{$error}}
                </div>
            @endforeach
        @endif
        </div>
        <div class="row">
          <div class="col-md-12">
            <div class="col-md-4 col-sm-12">
              <div class="form-group">
                <label for="religion">Religion<span class="text-danger">*</span></label>
                <select name="religion" id="religion" class="form-control" required>
                  @foreach(config('constants.RELIGION') as $key=>$val)
                      <option value="{{$key}}">{{$key}}</option>
                  @endforeach
                </select>
              </div>
            </div>
            <div class="col-md-4 col-sm-12">
              <div class="form-group">
                <label for="caste">Caste<span class="text-danger">*</span></label>
                <select name="caste" id="caste" class="form-control" required>
                  @foreach(config('constants.CASTE') as $key=>$val)
                    <option value="{{$key}}">{{$key}}</option>
                  @endforeach
                </select>
              </div>
            </div>
            <div class="col-md-4 col-sm-12">
              <div class="form-group">
                <label for="sub_caste">Sub-Caste<span class="text-danger">*</span></label>
                <input type="text" name="sub_caste" id="sub_caste" class="form-control" placeholder="Sub-Caste" required>
              </div>
            </div>
          </div>
        </div>

        <div class="row">
          <div class="col-md-12">
            <div class="col-md-6 col-sm-12">
              <div class="form-group">
                <label for="father_name">Father Name<span class="text-danger">*</span></label>
                <input type="text" name="father_name" id="father_name" class="form-control" placeholder="Father Name" required>
              </div>
            </div>
            <div class="col-md-6 col-sm-12">
              <div class="form-group">
                <label for="mother_name">Mother Name<span class="text-danger">*</span></label>
                <input type="text" name="mother_name" id="mother_name" class="form-control" placeholder="Mother Name" required>
              </div>
            </div>
          </div>
        </div>

        <div class="row">
          <div class="col-md-12">
            <div class="col-md-6 col-sm-12">
              <div class="form-group">
                <label for="father_occupation">Father Occupation<span class="text-danger">*</span></label>
                <input type="text" name="father_occupation" id="father_occupation" class="form-control" placeholder="Father Occupation" required>
              </div>
            </div>
            <div class="col-md-6 col-sm-12">
              <div class="form-group">
                <label for="mother_occupation">Mother Occupation<span class="text-danger">*</span></label>
                <input type="text" name="mother_occupation" id="mother_occupation" class="form-control" placeholder="Mother Occupation" required>
              </div>
            </div>
            <div class="col-md-12">
              <div class="form-group">
                <label for="address">Maternal Address (મૌસલ)<span class="text-danger">*</span></label>
                <textarea class="form-control" name="mosal" id="modal" placeholder="Address" rows="3" required></textarea>
              </div>
            </div>

            <div class="col-md-12">
              <div class="form-group">
                <label for="address">Parental Address <span class="text-danger">*</span></label>
                <textarea class="form-control" name="parental_address" id="parental_address" placeholder="Address" rows="3" required></textarea>
              </div>
            </div>

            <div class="col-md-12">
              <div class="form-group">
                <label for="family_type">Family Type<span class="text-danger">*</span>&nbsp;:&nbsp;&nbsp;</label>
                @foreach(config('constants.FAMILY_TYPE') as $key => $val)
                  <label>
                    <input type="radio" name="family_type" value="{{$val}}" class="minimal" {{($loop->first?'checked':'')}}/>
                    {{$key}}&nbsp;&nbsp;
                  </label>
                @endforeach
              </div>
            </div>

            <div class="col-md-6 col-sm-12">
              <div class="col-md-12">
                <button onclick="brothers(this,1)" type="button" class="btn btn-primary btn-round">+</button>&nbsp;&nbsp;<label>Brother</label>&nbsp;&nbsp;<button onclick="brothers(this,-1)" type="button" class="btn btn-primary btn-round">-</button>
              </div>
            </div>

            <div class="col-md-6 col-sm-12">
              <div class="col-md-12">
                <button onclick="sisters(this,1)" type="button" class="btn btn-primary btn-round">+</button>&nbsp;&nbsp;<label>Sister</label>&nbsp;&nbsp;<button onclick="sisters(this,-1)" type="button" class="btn btn-primary btn-round">-</button>
              </div>
            </div>
          </div>
        </div>

        <div class="row">
          <div class="col-md-12">
            <div class="col-md-12">
              <div class="form-group">
                <label for="property_detail">Property Details<span class="text-danger">*</span></label>
                <textarea class="form-control" name="property_detail" name="propert_detail" placeholder="Property Details" rows="3" required></textarea>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-primary">Submit</button>
        {{-- <button type="button" class="btn btn-default" data-dismiss="modal">Close</button> --}}
      </div>
      </form>
    </div>

  </div>
</div>
@endif

@if(auth()->user()->step<4)
<div id="horoscopeDetailModal" class="modal fade" role="dialog" data-backdrop="static" data-keyboard="false">
  <div class="modal-dialog modal-lg">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Horoscope Detail</h4>
      </div>
      <form method="post" action="{{route('dashboard.horoscope_detail')}}">
        @csrf
      <div class="modal-body">
        <div id="errorSectionModal">
        @if(Session::Has('message'))
              @if(Session::get('status') == 'success')
                <div class="alert alert-success alert-dismissible">
                  <button href="#" class="close" data-dismiss="alert" aria-label="close">&times;</button>
                  <strong>{{ucwords(Session::get('status'))}}!</strong> {{Session::get('message')}}
                </div>
              @else
                <div class="alert alert-danger alert-dismissible">
                  <button href="#" class="close" data-dismiss="alert" aria-label="close">&times;</button>
                  <strong>{{ucwords(Session::get('status'))}}!</strong> {{Session::get('message')}}
                </div>
              @endif
        @endif
        @if ($errors->any())
                
            @foreach ($errors->all() as $error)
                <div class="alert alert-danger alert-dismissible">
                  <button href="#" class="close" data-dismiss="alert" aria-label="close">&times;</button>
                  <strong>Error!</strong> {{$error}}
                </div>
            @endforeach
        @endif
        </div>
        <div class="row">
          <div class="col-md-12">
            <div class="col-md-6">
              <label>Believes In Horoscope?<span class="text-danger">*</span></label>
              <label>
                <input type="radio" value="1" name="believe_janmaksar" class="minimal" checked>
                Yes
              </label>
              <label>
                <input type="radio" value="0" name="believe_janmaksar" class="minimal">
                No
              </label>
            </div>
            <div class="col-md-6">
              <label>Janmaksar Type&nbsp;:&nbsp;&nbsp;</label>
              @foreach(config('constants.JANMAKSAR_TYPE') as $key => $val)
              <label>
                <input type="radio" value="{{$val}}" name="janmaksar_type" class="minimal" checked>
                {{$key}}&nbsp;&nbsp;
              </label>
              @endforeach
            </div>
          </div>
        </div>

        <div class="row">
          <div class="col-md-12">
            <div class="col-md-3 col-sm-12">
              <div class="form-group">
                <label for="naksatra">Naksatra</label>
                <select name="naksatra" id="naksatra" class="form-control" required>
                  @foreach(config('constants.NAKSHATRA') as $key => $val)
                  <option value="{{$val}}">{{$key}}</option>
                  @endforeach
                </select>
              </div>
            </div>
            <div class="col-md-3 col-sm-12">
              <div class="form-group">
                <label for="zodiac_sign">Zodiac Sign</label>
                <select name="zodiac_sign" id="zodiac_sign" class="form-control" required>
                  @foreach(config('constants.ZODIAC_SIGN') as $key => $val)
                  <option value="{{$val}}">{{$key}}</option>
                  @endforeach
                </select>
              </div>
            </div>
            <div class="col-md-3 col-sm-12">
              <div class="form-group">
                <label for="gan">Gan</label>
                <select name="gan" id="gan" class="form-control" required>
                  @foreach(config('constants.GAN') as $key => $val)
                  <option value="{{$val}}">{{$key}}</option>
                  @endforeach
                </select>
              </div>
            </div>
            <div class="col-md-3 col-sm-12">
              <div class="form-group">
                <label for="naadi">Naadi</label>
                <select name="naadi" id="naadi" class="form-control" required>
                  @foreach(config('constants.NAADI') as $key => $val)
                  <option value="{{$val}}">{{$key}}</option>
                  @endforeach
                </select>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-primary">Submit</button>
        {{-- <button type="button" class="btn btn-default" data-dismiss="modal">Close</button> --}}
      </div>
      </form>
    </div>

  </div>
</div>
@endif

@if(auth()->user()->step<5)
<div id="profilePictureModal" class="modal fade" role="dialog" data-backdrop="static" data-keyboard="false">
  <div class="modal-dialog modal-lg">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Profile Picture</h4>
      </div>
      <form method="post" action="{{route('dashboard.profile_picture')}}" enctype="multipart/form-data">
        @csrf
      <div class="modal-body">
        <div id="errorSectionModal">
        @if(Session::Has('message'))
              @if(Session::get('status') == 'success')
                <div class="alert alert-success alert-dismissible">
                  <button href="#" class="close" data-dismiss="alert" aria-label="close">&times;</button>
                  <strong>{{ucwords(Session::get('status'))}}!</strong> {{Session::get('message')}}
                </div>
              @else
                <div class="alert alert-danger alert-dismissible">
                  <button href="#" class="close" data-dismiss="alert" aria-label="close">&times;</button>
                  <strong>{{ucwords(Session::get('status'))}}!</strong> {{Session::get('message')}}
                </div>
              @endif
        @endif
        @if ($errors->any())
                
            @foreach ($errors->all() as $error)
                <div class="alert alert-danger alert-dismissible">
                  <button href="#" class="close" data-dismiss="alert" aria-label="close">&times;</button>
                  <strong>Error!</strong> {{$error}}
                </div>
            @endforeach
        @endif
        </div>
        <div class="row">
          <div class="col-md-12">
            <div class="col-md-8 col-sm-12">
              <div class="form-group">
                <input type="file" name="image[]" id="image" class="form-control" required>
              </div>
            </div>
            <div class="col-md-4 col-sm-6">
              <label>
              <input type="checkbox" class="minimal" name="image_visible" value="1" checked>&nbsp; Keep image visible
              </label>
            </div>
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-primary">Submit</button>
        {{-- <button type="button" class="btn btn-default" data-dismiss="modal">Close</button> --}}
      </div>
      </form>
    </div>

  </div>
</div>
@endif
</section>
@endsection

@section('scripts')
<script src="{{asset('/assets/plugins/iCheck/icheck.min.js')}}" type="text/javascript"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script type="text/javascript" src="{{asset('/frontend_assets/dist/js/slideshow.js')}}"></script>
<script>
  function CustomerBlock(obj,name)
  {
     swal({
      title: "Are you sure?",
      text: "Do you want to block "+name+"?",
      icon: "warning",
      buttons: true,
      dangerMode: true,
    })
    .then((willDelete) => {
      if (willDelete) {
        $(obj).closest('form').submit();
      } else {
        // swal("Your imaginary file is safe!");
      }
    });
  }
  function sendRequest(obj,name)
  {
    swal({
      title: "Are you sure?",
      text: "Do you want to request "+name+"!",
      icon: "warning",
      buttons: true,
      dangerMode: true,
    })
    .then((willDelete) => {
      if (willDelete) {
        swal("Request is sent!", {
          icon: "success",
        });
        $(obj).closest('form').submit();
      } else {
        // swal("Your imaginary file is safe!");
      }
    });
  }
</script>
<script>
  var brotherCount = 1;
  var sisterCount = 1;
  var states = [];
  var cities = [];
  @if(auth()->user()->step==0)
  var today = new Date();
    var dd = today.getDate();
    var mm = today.getMonth()+1; //January is 0!
    var yyyy = today.getFullYear()-18;
    if(dd<10){
        dd='0'+dd
    } 
    if(mm<10){
        mm='0'+mm
    } 

    date = yyyy+'-'+mm+'-'+dd;
    document.getElementById("dob").setAttribute("max", date);
    @endif
  function brothers(obj,flg)
  {
    if(flg>0)
    {
      $(obj).parent().append(`<div class="row botherField">
                      <hr>
                      <div class="col-md-4 col-sm-12">
                        <label>Brother Name<span class="text-danger">*</span></label>
                        <input type="text" name="brother_name[]" class="form-control" placeholder="Name" required>
                      </div>
                      <div class="col-md-4 col-sm-12">
                        <label>Marital Status?<span class="text-danger">*</span></label>
                        <label>
                          <input type="radio" name="brother_married[`+brotherCount+`]" value="0" class="minimal" checked/>
                          Single
                        </label>
                        <label>
                          <input type="radio" name="brother_married[`+brotherCount+`]" value="1" class="minimal"/>
                          Married
                        </label>
                      </div>
                      <div class="col-md-4 col-sm-12">
                        <label>Educaton<span class="text-danger">*</span></label>
                        <input type="text" name="brother_education[]" class="form-control" placeholder="Name" required>
                      </div>
                    </div>`);
          $('input[type="checkbox"].minimal, input[type="radio"].minimal').iCheck({
            checkboxClass: 'icheckbox_minimal-blue',
            radioClass: 'iradio_minimal-blue'
          });
          brotherCount++;
    }
    else
    {
      $(obj).siblings('.botherField').last().remove();
      brotherCount--;
      if(brotherCount<1)
        brotherCount=1;
    }
  }
  function sisters(obj,flg)
  {
    if(flg>0)
    {
      $(obj).parent().append(`<div class="row sisterField">
                      <hr>
                      <div class="col-md-4 col-sm-12">
                        <label>Sister Name<span class="text-danger">*</span></label>
                        <input type="text" name="sister_name[]" class="form-control" placeholder="Name" required>
                      </div>
                      <div class="col-md-4 col-sm-12">
                        <label>Marital Status?<span class="text-danger">*</span></label>
                        <label>
                          <input type="radio" name="sister_married[`+sisterCount+`]" value="0" class="minimal" checked/>
                          Single
                        </label>
                        <label>
                          <input type="radio" name="sister_married[`+sisterCount+`]" value="1" class="minimal"/>
                          Married
                        </label>
                      </div>
                      <div class="col-md-4 col-sm-12">
                        <label>Educaton<span class="text-danger">*</span></label>
                        <input type="text" name="sister_education[]" class="form-control" placeholder="Name" required>
                      </div>
                    </div>`);
          $('input[type="checkbox"].minimal, input[type="radio"].minimal').iCheck({
            checkboxClass: 'icheckbox_minimal-blue',
            radioClass: 'iradio_minimal-blue'
          });
          sisterCount++;
    }
    else
    {
      $(obj).siblings('.sisterField').last().remove();
      sisterCount--;
      if(sisterCount<1)
        sisterCount=1;
    }
  }
  $(document).ready(function(e){
    $('.select2').select2();

    //Init Old values
    @if(!empty($preferences->marital_status))
      $('#marital_status').val({!!$preferences->marital_status!!}).trigger('change');
    @endif
    @if(!empty($preferences->fitness))
      $('#fitness').val({!!$preferences->fitness!!}).trigger('change');
    @endif
    @if(!empty($preferences->skin))
      $('#skin').val({!!$preferences->skin!!}).trigger('change');
    @endif
    @if(!empty($preferences->diet))
      $('#diet').val({!!$preferences->diet!!}).trigger('change');
    @endif
    @if(!empty($preferences->country))
      $('#country_id').val({!!$preferences->country!!}).trigger('change');
    @endif
    @if(!empty($preferences->state))
      states = {!!(!empty($preferences->state)?$preferences->state:'[]')!!};
    @endif
    @if(!empty($preferences->city))
      cities = {!!(!empty($preferences->city)?$preferences->city:'[]')!!};
    @endif
    @if(!empty($preferences->qualification))
      $('#qualification').val({!!$preferences->qualification!!}).trigger('change');
    @endif
    @if(!empty($preferences->religion))
      $('#religion').val({!!$preferences->religion!!}).trigger('change');
    @endif
    @if(!empty($preferences->caste))
      $('#caste').val({!!$preferences->caste!!}).trigger('change');
    @endif
    @if(!empty($preferences->family_type))
      $('#family_type').val({!!$preferences->family_type!!}).trigger('change');
    @endif
    $('#country').change(function(e){
      if($(this).val()!='')
      $.ajax({
        url: '{{url('/admin/get/states/')}}'+'/'+$(this).val(),
        method: 'get',
        success: function(result)
        {
          if(result.status==1)
          {
            if(result.data.length>0)
            {
              $('#state').empty().append('<option value="">Select State</option>')
              $.each(result.data, function(i,v){
                $('#state').append('<option value="'+v.id+'">'+v.name+'</option>');
              })
            }
            else
            {
              $('#errorSectionModal').append(`<div class="alert alert-danger alert-dismissible" style="display:none;">
                <button href="#" class="close" data-dismiss="alert" aria-label="close">&times;</button>
                <strong>Error!</strong> Country Does not have any State. Please select different Country
              </div>`).children('.alert').last().fadeIn();
              // toastr.error('Country Does not have any State. Please select different Country');
            }
          }
          else
          {
            $('#errorSectionModal').append(`<div class="alert alert-danger alert-dismissible" style="display:none;">
                <button href="#" class="close" data-dismiss="alert" aria-label="close">&times;</button>
                <strong>Error!</strong> Something went wrong, Contect Admin
              </div>`).children('.alert').last().fadeIn();
            // toastr.error('Something went wrong, Contect Admin');
          }
        },
        error: function(e)
        {
          console.log(e);
        }
      });
    });
    $('#state').change(function(e){
      if($(this).val()!='')
      $.ajax({
        url: '{{url('/admin/get/cities/')}}'+'/'+$(this).val(),
        method: 'get',
        success: function(result)
        {
          if(result.status==1)
          {
            if(result.data.length>0)
            {
              $('#city').empty().append('<option value="">Select City</option>')
              $.each(result.data, function(i,v){
                $('#city').append('<option value="'+v.id+'">'+v.name+'</option>');
              });
            }
            else
            {
              $('#errorSectionModal').append(`<div class="alert alert-danger alert-dismissible" style="display:none;">
                <button href="#" class="close" data-dismiss="alert" aria-label="close">&times;</button>
                <strong>Error!</strong> State Does not have any City. Please select different State
              </div>`).children('.alert').last().fadeIn();
            }
          }
          else
          {
            $('#errorSectionModal').append(`<div class="alert alert-danger alert-dismissible" style="display:none;">
                <button href="#" class="close" data-dismiss="alert" aria-label="close">&times;</button>
                <strong>Error!</strong> Something went wrong, Contect Admin
              </div>`).children('.alert').last().fadeIn();
          }
        },
        error: function(e)
        {
          console.log(e);
        }
      });
    });
    $('#country_id').change(function(e){
      console.log('here');
      if($(this).val()!='' && $(this).val()!=null && $(this).val()!=undefined)
      $.ajax({
        url: '{{url('/admin/get/states/')}}'+'/'+$(this).val()+'/'+1,
        method: 'get',
        success: function(result)
        {
          if(result.status==1)
          {
            if(result.data.length>0)
            {
              $('#state_id').empty().append('<option value="">Select State</option>')
              $.each(result.data, function(i,v){
                $('#state_id').append('<option value="'+v.id+'">'+v.name+'</option>');
              });
              if(states.length>0)
              {
                $('#state_id').val(states).trigger('change');
              }
            }
            else
            {
              $('#errorSectionModal').append(`<div class="alert alert-danger alert-dismissible" style="display:none;">
                <button href="#" class="close" data-dismiss="alert" aria-label="close">&times;</button>
                <strong>Error!</strong> Country Does not have any State. Please select different Country
              </div>`).children('.alert').last().fadeIn();
              // toastr.error('Country Does not have any State. Please select different Country');
            }
          }
          else
          {
            $('#errorSectionModal').append(`<div class="alert alert-danger alert-dismissible" style="display:none;">
                <button href="#" class="close" data-dismiss="alert" aria-label="close">&times;</button>
                <strong>Error!</strong> Something went wrong, Contect Admin
              </div>`).children('.alert').last().fadeIn();
            // toastr.error('Something went wrong, Contect Admin');
          }
        },
        error: function(e)
        {
          console.log(e);
        }
      });
    });
    $('#state_id').change(function(e){
      if($(this).val()!='' && $(this).val()!=null && $(this).val()!=undefined)
      $.ajax({
        url: '{{url('/admin/get/cities/')}}'+'/'+$(this).val()+'/'+1,
        method: 'get',
        success: function(result)
        {
          if(result.status==1)
          {
            if(result.data.length>0)
            {
              $('#city_id').empty().append('<option value="">Select City</option>')
              $.each(result.data, function(i,v){
                $('#city_id').append('<option value="'+v.id+'">'+v.name+'</option>');
              });
              console.log(cities);
              if(cities.length>0)
              {
                $('#city_id').val(cities).trigger('change');
              }
            }
            else
            {
              $('#errorSectionModal').append(`<div class="alert alert-danger alert-dismissible" style="display:none;">
                <button href="#" class="close" data-dismiss="alert" aria-label="close">&times;</button>
                <strong>Error!</strong> State Does not have any City. Please select different State
              </div>`).children('.alert').last().fadeIn();
            }
          }
          else
          {
            $('#errorSectionModal').append(`<div class="alert alert-danger alert-dismissible" style="display:none;">
                <button href="#" class="close" data-dismiss="alert" aria-label="close">&times;</button>
                <strong>Error!</strong> Something went wrong, Contect Admin
              </div>`).children('.alert').last().fadeIn();
          }
        },
        error: function(e)
        {
          console.log(e);
        }
      });
    })
    $('input[type="checkbox"].minimal, input[type="radio"].minimal').iCheck({
      checkboxClass: 'icheckbox_minimal-blue',
      radioClass: 'iradio_minimal-blue'
    });
  });
  $(document).ready(function(){
    @if(auth()->user()->step==0)
    $('#personalDetailModal').modal('show');
    @elseif(auth()->user()->step==1)
    $('#educationDetailModal').modal('show');
    @elseif(auth()->user()->step==2)
    $('#familyDetailModal').modal('show');
    @elseif(auth()->user()->step==3)
    $('#horoscopeDetailModal').modal('show');
    @elseif(auth()->user()->step==4)
    $('#profilePictureModal').modal('show');
    @endif
    $('input[type="checkbox"].minimal, input[type="radio"].minimal').iCheck({
      checkboxClass: 'icheckbox_minimal-blue',
      radioClass: 'iradio_minimal-blue'
    });
  });
</script>
@endsection