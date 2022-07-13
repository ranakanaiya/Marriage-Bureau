@extends('customer.layout.app')

@section('title')
User Profile
@endsection

@section('styles')
<link href="{{asset('/assets/plugins/iCheck/all.css')}}" rel="stylesheet" type="text/css" />
<link href="{{asset('/assets/dist/css/slideshow.css')}}" rel="stylesheet" type="text/css" />
<style>
.slide-master {
  display: inline-block;
  height: 250px;
}
.slide-master img {
  height: 250px;
  width: 250px;
  object-fit: contain;
}
.slide-master-content {
  display: inline-blocks;
}
@media only screen and (max-width: 767px) {
  .slide-master img {
    height: auto;
    width: 100%;
    object-fit: cover;
  }
}
</style>

@endsection

@section('content')
<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>
    User Profile
    <small>View</small>
  </h1>
  <ol class="breadcrumb">
    <li><a href="{{route('dashboard')}}"><i class="fa fa-dashboard"></i> Home</a></li>
    <li class="active">User Profile</li>
  </ol>
</section>

<!-- Main content -->
<section class="content">
  <div class="row">
    <div class="col-xs-12">

      <div class="box box-primary">
        <div class="box-header">
          <h2 class="box-title">User Details</h2>
        </div><!-- /.box-header -->
        <div class="box-body">
          <div class="row">
            <div class="col-md-12">
              <div class="panel panel-custom">
                <div class="panel-heading">
                  <h3 class="no-margin">Personal Details</h3>
                </div>
                <div class="panel-body">
                  <div class="col-md-4 col-sm-5 col-xs-12 text-center">
                    <div class="slide-master col-md-12" data-activeslide="1">

                      @php($imgs = [])
                      @if(!empty($customer->sent_image_request(auth()->id())) && $customer->sent_image_request(auth()->id())->status==1)
                        @php($imgs = json_decode($customer->personal_detail->image_original))
                      @elseif(!empty($customer->received_image_request(auth()->id())) && $customer->received_image_request(auth()->id())->status==1)
                        @php($imgs = json_decode($customer->personal_detail->image_original))
                      @else
                        @php($imgs = json_decode($customer->personal_detail->image))
                      @endif

                      @foreach($imgs as $img)
                        <img class="slide" src="{{asset('/assets/img/user/'.$img)}}">
                      @endforeach

                      @if(count($imgs)>1)
                      <span class="slides-caption">1 / {{count($imgs)}}</span>
                      <button class="slide-button slide-button-left" onclick="nextSlide(-1,this)">&#10094;</button>
                      <button class="slide-button slide-button-right" onclick="nextSlide(+1,this)">&#10095;</button>
                      @endif
                    </div>
                    @if($customer->personal_detail->image_visible==0)
                    <div class="col-md-12 mt-2">
                      @if(!empty($customer->sent_image_request(auth()->id())))
                        @if($customer->sent_image_request(auth()->id())->status==0)
                          <span class="text-aqua">Request sent for Image</span>
                        @elseif($customer->sent_image_request(auth()->id())->status==1)
                          <span></span>
                        @else
                          <span class="text-red">Rejected</span>
                        @endif
                      @elseif(!empty($customer->received_image_request(auth()->id())))
                        @if($customer->received_image_request(auth()->id())->status==0)
                          <span class="text-aqua">Request sent for Image</span>
                        @elseif($customer->received_image_request(auth()->id())->status==1)
                          <span></span>
                        @else
                          <span class="text-red">Rejected</span>
                        @endif
                      @else
                        <form method="post" action="{{route('customers.request.image.store',$customer->id)}}">
                          @csrf
                          <button type="button" onclick="sendRequest(this,'{{ucwords($customer->personal_detail->first_name)}} {{ucwords($customer->personal_detail->last_name)}}')" class="btn btn-primary">Request Picture</button>
                        </form>
                      @endif

                    </div>
                    @endif
                  </div>
                  <div class="slide-master-content col-md-8 col-sm-7 col-xs-12">
                    <div class="col-md-8">
                      <h3><a href="{{route('customer.details',$customer->id)}}">{{ucwords($customer->personal_detail->first_name)}} {{ucwords($customer->personal_detail->middle_name)}} {{ucwords($customer->personal_detail->last_name)}}</a></h3>
                    </div>
                    <div class="col-md-4" style="min-height:50px;">
                      <form method="post" class="d-inline pull-right ml-2" action="{{route('user.block',$customer->id)}}">
                        @csrf
                        <a title="Block" onclick="CustomerBlock(this,'{{$customer->first_name}} {{$customer->last_name}}')" class="btn btn-primary">Block</a>
                      </form>
                      @if(auth()->user()->subscribed)
                        @if(!empty($customer->sent_request(auth()->id())))
                          @if($customer->sent_request(auth()->id())->status==0)
                            <span class="text-primary pull-right">Request Already Sent</span>
                          @elseif($customer->sent_request(auth()->id())->status==1)
                            <span class="text-green pull-right">Request Accepted</span>
                          @else
                            <span class="text-red pull-right">Request Rejected</span>
                          @endif
                        @elseif(!empty($customer->received_request(auth()->id())))
                          @if($customer->received_request(auth()->id())->status==0)
                            <span class="text-primary pull-right">Request Received</span>
                          @elseif($customer->received_request(auth()->id())->status==1)
                            <span class="text-green pull-right">Request Accepted</span>
                          @else
                            <span class="text-red pull-right">Request Rejected</span>
                          @endif
                        @else
                          <form method="post" action="{{route('customer.request.store',$customer->id)}}">
                            @csrf
                            <button type="button" onclick="sendRequest(this,'{{ucwords($customer->personal_detail->first_name)}} {{ucwords($customer->personal_detail->last_name)}}')" class="btn btn-primary pull-right">Send Request</button>
                          </form>
                        @endif
                      @else
                      <button onclick="location.href='{{route('subscription.plans')}}';" class="btn btn-primary pull-right">Subscribe</button>
                      @endif
                    </div>

                    <div class="col-md-6 col-xs-12">
                      <table class="table">
                        <tr>
                          <th>Age:</th>
                          <td>{{\Carbon\Carbon::parse($customer->personal_detail->dob)->diff(\Carbon\Carbon::now())->format('%y years');}}
                          </td>
                        </tr>
                        <tr>
                          <th>Location:</th>
                          <td>{{$customer->personal_detail->city->name.', '.$customer->personal_detail->state->name.', '.$customer->personal_detail->country->name}}
                          </td>
                        </tr>
                        <tr>
                          <th>Height:</th>
                          <td>{{$customer->personal_detail->height }} cm
                          </td>
                        </tr>
                        <tr>
                          <th>Weight:</th>
                          <td>{{$customer->personal_detail->weight }} kg
                          </td>
                        </tr>
                        <tr>
                          <th>Mother Tongue:</th>
                          <td>{{$customer->personal_detail->mother_tongue}}
                          </td>
                        </tr>
                        <tr>
                          <th>Blood Group:</th>
                          <td>{{$customer->personal_detail->blood_group}}
                          </td>
                        </tr>
                      </table>
                    </div>
                    <div class="col-md-6 col-xs-12">
                      <table class="table">
                        <tr>
                          <th>Marital Status:</th>
                          <td>{{array_keys(config('constants.MARRITAL_STATUS'),$customer->personal_detail->marital_status)[0]}}
                          </td>
                        </tr>
                        <tr>
                          <th>Religion/Caste/Sub-caste:</th>
                          <td>{{$customer->family_detail->religion.', '.$customer->family_detail->caste.', '.$customer->family_detail->sub_caste}}
                          </td>
                        </tr>
                        <tr>
                          <th>Fitness:</th>
                          <td>{{array_keys(config('constants.FITNESS'),$customer->personal_detail->fitness)[0]}}
                          </td>
                        </tr>
                        <tr>
                          <th>Skin Tone:</th>
                          <td>{{array_keys(config('constants.SKINTONE'),$customer->personal_detail->skin)[0]}}
                          </td>
                        </tr>
                        @if($customer->personal_detail->physical_handicape)
                        <tr>
                          <th>Physical Handicape Detail:</th>
                          <td>{{$customer->personal_detail->physical_handicape_detail}}
                          </td>
                        </tr>
                        @endif
                        @if(!empty(json_decode($customer->personal_detail->addiction)))
                        <tr>
                          <th>Addiction:</th>
                          <td>{{implode(', ',json_decode($customer->personal_detail->addiction))}}
                          </td>
                        </tr>
                        @endif
                        <tr>
                          <th>Diet:</th>
                          <td>{{array_keys(config('constants.DIET'),$customer->personal_detail->diet)[0]}}
                          </td>
                        </tr>
                        <tr>
                          <th>Family Diet:</th>
                          <td>{{$customer->personal_detail->family_diet}}
                          </td>
                        </tr>
                      </table>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <div class="col-md-4 col-sm-12">
              <div class="panel panel-custom">
                <div class="panel-heading">
                  <h3 class="no-margin">Contact Details</h3>
                </div>
                <div class="panel-body">
                  <table class="table">
                        <tr>
                          <th>Contact No:</th>
                          <td>
                            @if(auth()->user()->subscribed && $accepted==1)
                            {{json_decode($customer->personal_detail->contact)[0]}}<br>{{json_decode($customer->personal_detail->contact)[1]}}
                            @else
                            {{substr(json_decode($customer->personal_detail->contact)[0],0,5).'XXXXXX..'}}<br>{{substr(json_decode($customer->personal_detail->contact)[1],0,5).'XXXXXX..'}}
                            @endif
                          </td>
                        </tr>
                        <tr>
                          <th>Email:</th>
                          <td>
                            @if(auth()->user()->subscribed && $accepted==1)
                            {{$customer->email}}
                            @else
                              @if(count(explode('@',$customer->email))>1)
                              {{'..XXXXXX@'.explode('@',$customer->email)[1]}}
                              @else
                              XXXXXXXXXXXX
                              @endif
                            @endif
                          </td>
                        </tr>
                      </table>
                </div>
              </div>
            </div>

            <div class="col-md-8 col-sm-12">
              <div class="panel panel-custom">
                <div class="panel-heading">
                  <h3 class="no-margin">Education and Career</h3>
                </div>
                <div class="panel-body">
                  <div class="col-md-6">
                    <table class="table">
                      <tr>
                        <th>Education:</th>
                        <td>{{$customer->education_career_detail->highest_qualification}}
                        </td>
                      </tr>
                      <tr>
                        <th>Profession:</th>
                        <td>{{$customer->education_career_detail->profession}}
                        </td>
                      </tr>
                    </table>
                  </div>
                  <div class="col-md-6">
                    <table class="table">
                      <tr>
                        <th>College/School Name:</th>
                        <td>{{$customer->education_career_detail->college_name}}
                        </td>
                      </tr>
                      <tr>
                        <th>Monthly Income:</th>
                        <td>{{$customer->education_career_detail->monthly_income}}
                        </td>
                      </tr>
                    </table>
                  </div>
                </div>
              </div>
            </div>

            <div class="col-md-12">
              <div class="panel panel-custom">
                <div class="panel-heading">
                  <h3 class="no-margin">Family Details</h3>
                </div>
                <div class="panel-body">
                  <div class="col-md-6">
                    <table class="table">
                      <tr>
                        <th>Father Name:</th>
                        <td>{{$customer->family_detail->father_name}}
                        </td>
                      </tr>
                      <tr>
                        <th>Father Occupation:</th>
                        <td>{{$customer->family_detail->father_occupation}}
                        </td>
                      </tr>
                      @if(count(json_decode($customer->family_detail->brothers_detail))>0)
                      <tr>
                        <td colspan="2">
                          @foreach(json_decode($customer->family_detail->brothers_detail) as $brother)
                          <div class="panel panel-custom">
                            <div class="panel-heading">
                              <h4 class="no-margin">Brother Detail</h4>
                            </div>
                            <div class="panel-body">
                              <table class="table">
                                <tr>
                                  <th>Name</th>
                                  <td>{{$brother->name}}</td>
                                </tr>
                                <tr>
                                  <th>Married</th>
                                  <td>{{($brother->married==0?'Not Married':'Married')}}</td>
                                </tr>
                                <tr>
                                  <th>Education</th>
                                  <td>{{$brother->education}}</td>
                                </tr>
                              </table>
                            </div>
                          </div>
                          @endforeach
                        </td>
                      </tr>
                      @endif
                    </table>
                  </div>
                  <div class="col-md-6">
                    <table class="table">
                      <tr>
                        <th>Mother Name:</th>
                        <td>{{$customer->family_detail->mother_name}}
                        </td>
                      </tr>
                      <tr>
                        <th>Mother Occupation:</th>
                        <td>{{$customer->family_detail->mother_occupation}}
                        </td>
                      </tr>
                      @if(count(json_decode($customer->family_detail->sisters_detail))>0)
                      <tr>
                        <td colspan="2">
                          @foreach(json_decode($customer->family_detail->sisters_detail) as $sister)
                          <div class="panel panel-custom">
                            <div class="panel-heading">
                              <h4 class="no-margin">Sister Detail</h4>
                            </div>
                            <div class="panel-body">
                              <table class="table">
                                <tr>
                                  <th>Name</th>
                                  <td>{{$sister->name}}</td>
                                </tr>
                                <tr>
                                  <th>Married</th>
                                  <td>{{($sister->married==0?'Not Married':'Married')}}</td>
                                </tr>
                                <tr>
                                  <th>Education</th>
                                  <td>{{$sister->education}}</td>
                                </tr>
                              </table>
                            </div>
                          </div>
                          @endforeach
                        </td>
                      </tr>
                      @endif
                    </table>
                  </div>
                  <div class="col-md-12">
                    <table class="table">
                      <tr>
                        <th>Property Detail</th>
                        <td>{!!nl2br($customer->family_detail->property_detail)!!}</td>
                      </tr>
                    </table>
                  </div>
                </div>
              </div>
            </div>

            <div class="col-md-12">
              <div class="panel panel-custom">
                <div class="panel-heading">
                  <h3 class="no-margin">Horoscope Detail</h3>
                </div>
                <div class="panel-body">
                  <div class="col-md-6 col-sm-12">
                    <table class="table">
                      <tr>
                        <th>Believes In Horoscope?</th>
                        <td>{{($customer->horoscope_detail->believe_janmaksar==0?'No':'Yes')}}</td>
                      </tr>
                      <tr>
                        <th>Naksatra</th>
                        <td>{{array_keys(config('constants.NAKSHATRA'),$customer->horoscope_detail->naksatra)[0]}}</td>
                      </tr>
                      <tr>
                        <th>Gan</th>
                        <td>{{array_keys(config('constants.GAN'),$customer->horoscope_detail->gan)[0]}}</td>
                      </tr>
                    </table>
                  </div>
                  <div class="col-md-6 col-sm-12">
                    <table class="table">
                      <tr>
                        <th>Janmaksar Type</th>
                        <td>{{array_keys(config('constants.JANMAKSAR_TYPE'),$customer->horoscope_detail->janmaksar_type)[0]}}</td>
                      </tr>
                      <tr>
                        <th>Zodiac Sign</th>
                        <td>{{array_keys(config('constants.ZODIAC_SIGN'),$customer->horoscope_detail->zodiac_sign)[0]}}</td>
                      </tr>
                      <tr>
                        <th>Naadi</th>
                        <td>{{array_keys(config('constants.NAADI'),$customer->horoscope_detail->naadi)[0]}}</td>
                      </tr>
                    </table>
                  </div>
                  
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- /.box-body -->
      </div><!-- /.box -->
    </div><!-- /.col -->

  </div><!-- /.row -->
</section>

@endsection

@section('scripts')
<script type="text/javascript" src="{{asset('/assets/dist/js/slideshow.js')}}"></script>
<script>
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
</script>
@endsection