@extends('admin.layout.app')

@section('title')
Customer Create
@endsection

@section('styles')
<link href="{{asset('/assets/plugins/iCheck/all.css')}}" rel="stylesheet" type="text/css" />
@endsection

@section('content')
<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>
    Customers
    <small>Create</small>
  </h1>
  <ol class="breadcrumb">
    <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
    <li><a href="#">Customers</a></li>
    <li class="active">Create</li>
  </ol>
</section>

<!-- Main content -->
<section class="content">
  <div class="row">
    <div class="col-xs-12">

      <div class="box box-primary">
        <div class="box-header">
          <h3 class="box-title">Customer Create</h3>
        </div><!-- /.box-header -->
        <form method="post" action="{{route('admin.customers.store')}}">
        	@csrf
	        <div class="box-body">

	        	<h4>Login Details</h4>
	        	<hr>
	        	<div class="row">
	        		<div class="col-md-12">
		        		<div class="col-md-4 col-sm-12">
				        	<div class="form-group">
				        		<label for="email">Email Id<span class="text-danger">*</span></label>
				        		<input type="text" name="email" id="email" class="form-control" placeholder="Email Id" required>
				        	</div>
				        </div>
				        <div class="col-md-4 col-sm-12">
				        	<div class="form-group">
				        		<label for="password">Password<span class="text-danger">*</span></label>
				        		<input type="text" name="password" id="password" class="form-control" placeholder="Password" required>
				        	</div>
				        </div>
				        <div class="col-md-4 col-sm-12">
				        	<div class="form-group">
				        		<label for="password_confirmation">Password Confirmation<span class="text-danger">*</span></label>
				        		<input type="text" name="password_confirmation" id="password_confirmation" class="form-control" placeholder="Password Confirmation" required>
				        	</div>
				        </div>
				      </div>
			      </div>

	        	<h4>Personal Details</h4>
	        	<hr>
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
				      </div>
			      </div>

			      <div class="col-md-12">
			      	<div class="form-group">
			      		<label>Gender<span class="text-danger">*</span></label>
			      		<label><input type="radio" name="gender" value="0" class="minimal" checked>Male</label>
			      		<label><input type="radio" name="gender" value="1" class="minimal">Female</label>
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
				      			<select name="country" id="country" class="form-control" required>
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
				      			<select name="state" id="state" class="form-control" required>
				      				<option value="">Select State</option>
				      			</select>
				      		</div>
				      	</div>
				      	<div class="col-md-4 col-sm-12">
				      		<div class="form-group">
				      			<label for="city">City<span class="text-danger">*</span></label>
				      			<select name="city" id="city" class="form-control" required>
				      				<option value="">Select City</option>
				      			</select>
				      		</div>
				      	</div>
				      </div>
	        	</div>

	        	<div class="row">
	        		<div class="col-md-12">
		        		<div class="col-md-3 col-sm-6 col-xs-12">
		        			<div class="form-group">
		        				<label for="dob">Date of Birth<span class="text-danger">*</span></label>
		        				<input type="date" name="dob" id="dob" class="form-control" placeholder="Date of Birth">
		        			</div>
		        		</div>
		        		<div class="col-md-3 col-sm-6 col-xs-12">
		        			<div class="form-group">
		        				<label for="birthTime">Birth Time</label>
		        				<input type="time" name="birth_time" id="birthTime" class="form-control" placeholder="Birth Time">
		        			</div>
		        		</div>
		        		<div class="col-md-3 col-sm-6 col-xs-12">
		        			<div class="form-group">
		        				<label for="height">Height(cm)<span class="text-danger">*</span></label>
		        				<input type="number" name="height" id="height" min="50" max="500" class="form-control" placeholder="Height" required>
		        			</div>
		        		</div>
		        		<div class="col-md-3 col-sm-6 col-xs-12">
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
            		<div class="col-md-3 col-sm-4 col-xs-12">
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
            		<div class="col-md-3 col-xs-12">
            			<div class="form-group">
            				<label>Addiction&nbsp;:&nbsp;&nbsp;</label>
            				<div>
		        					<label>
	                      <input type="checkbox" value="Smoking" name="additction[]" class="minimal"/>
	                      Smoking&nbsp;
	                    </label>
	                    <label>
	                      <input type="checkbox" value="Drinking" name="additction[]" class="minimal"/>
	                      Drinking&nbsp;
	                    </label>
	                  </div>
            			</div>
            		</div>
            		<div class="col-md-6 col-xs-12">
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
            		<div class="col-md-3 col-xs-12">
            			<div class="form-group">
            				<label for="familyDiet">Family Diet</label>
            				<input type="text" name="family_diet" id="familyDiet" class="form-control" placeholder="Family Diet">
            			</div>
            		</div>
            	</div>
            </div>

            <h4>Education & Career</h4>
            <hr>
            <div class="row">
            	<div class="col-md-12">
            		<div class="col-md-6 col-sm-12">
	            		<div class="form-group">
	            			<label for="education">Education Qualification<span class="text-danger">*</span></label>
	            			<select name="highest_qualification" id="education" class="form-control" required>
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

            <h4>Family Details</h4>
            <hr>
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
		        	<div class="col-md-12" style="margin-top: 1.5rem!important;">
		        		<div class="col-md-12">
					      	<div class="form-group">
					      		<label for="property_detail">Property Details<span class="text-danger">*</span></label>
					      		<textarea rows="3" class="form-control" name="property_detail" name="propert_detail" placeholder="Property Details" required></textarea>
					      	</div>
					      </div>
				      </div>
				    </div>

				    <h4>Astrology Details</h4>
            <hr>
            <div class="row">
            	<div class="col-md-12">
            		<div class="col-md-6">
            			<label>Believes In Horoscope?<span class="text-danger">*</span></label>
            			<label>
            				<input type="radio" value="1" name="believe_in_janmaksar" class="minimal" checked>
            				Yes
            			</label>
            			<label>
            				<input type="radio" value="0" name="believe_in_janmaksar" class="minimal">
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

	        	<div class="row">
	        		<div class="col-md-12">
	        			<div class="col-md-12">
	        				<button type="submit" class="btn btn-primary pull-right">Submit</button>
	        			</div>
	        		</div>
	        	</div>

	        </div>
	        <!-- /.box-body -->
	      </form>
      </div><!-- /.box -->
    </div><!-- /.col -->
  </div><!-- /.row -->
</section>

@endsection

@section('scripts')
<script src="{{asset('/assets/plugins/iCheck/icheck.min.js')}}" type="text/javascript"></script>
<script>
	var brotherCount = 1;
	var sisterCount = 1;
	function brothers(obj,flg)
	{
		if(flg>0)
		{
			$(obj).parent().append(`<div class="row botherField">
		        					<hr>
		        					<div class="col-md-4 col-xs-12">
		        						<label>Brother Name<span class="text-danger">*</span></label>
		        						<input type="text" name="brother_name[]" class="form-control" placeholder="Name" required>
		        					</div>
		        					<div class="col-md-4 col-xs-12">
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
		        					<div class="col-md-4 col-xs-12">
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
		}
	}
	function sisters(obj,flg)
	{
		if(flg>0)
		{
			$(obj).parent().append(`<div class="row sisterField">
		        					<hr>
		        					<div class="col-md-4 col-xs-12">
		        						<label>Sister Name<span class="text-danger">*</span></label>
		        						<input type="text" name="sister_name[]" class="form-control" placeholder="Name" required>
		        					</div>
		        					<div class="col-md-4 col-xs-12">
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
		        					<div class="col-md-4 col-xs-12">
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
		}
	}
	$(document).ready(function(e){
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
							toastr.error('Country Does not have any State. Please select different Country');
						}
					}
					else
					{
						toastr.error('Something went wrong, Contect Admin');
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
							})
						}
						else
						{
							toastr.error('State Does not have any City. Please select different State');
						}
					}
					else
					{
						toastr.error('Something went wrong, Contect Admin');
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
</script>
@endsection