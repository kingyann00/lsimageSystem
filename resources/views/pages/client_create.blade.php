<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title></title>
	<link href="/css/adminstyle.css" rel="stylesheet"> 
	<script src="https://use.fontawesome.com/ef6dc49ffd.js"></script>


</head>
<body>
<?php 
		$company_name = session('company_name');
		$company_email = null;
		$PIC_Name = session('PIC_Name');
		$phone_no = null;
		$company_address = session('company_address');
		if ($errors->first('company_email') == null) {
			$company_email = session('company_email');
		}
		if ($errors->first('phone_no') == null) {
			$phone_no = session('phone_no');
		}
		
 ?>
<?php if (Session::has('error')): ?>
{{\Session::get('error')}}
<?php endif ?>
	<div class="container">
		<div class="SiteMapPath">
			<a href="{{url('/dashboard')}}" class="sitemap_home"><i class="fa fa-home" aria-hidden="true"></i>Home</a>
				<div class="SiteMapPath-content">
					<span>></span>
					<a href="{{url('client')}}">Client</a>
					<span>></span>
					<span>Add Client</span>
				</div>
		</div>	
		<form method="post" action="{{url('client','store')}}">
			{{csrf_field()}}
			<div class="form-box">
			
			<div class="field-form">
				<div class="flex-item-left">
					<label >Company Name:</label>
					<input type="text" name="company_name" value="{{$company_name}}" placeholder="Example: Sample Company SDN BHD">
					<div class="error-message">{{$errors->first('company_name')}}</div> 
				</div>
				
				<div class="flex-item-right">
					<label >Company Email:</label>
					<input type="text" name="company_email" value="{{$company_email}}" placeholder="Example: samplecompany@gmail.com">
					<div class="error-message">{{$errors->first('company_email')}}</div> 
				</div>	
				
			</div>

			<div class="field-form">
				<div class="flex-item-left">
					<label >Person In Charge Name</label>
					<input type="text" name="PIC_Name" value="{{$PIC_Name}}" placeholder="Example: Jack Ma">
					<div class="error-message">{{$errors->first('PIC_Name')}}</div> 
				</div>
				
				<div class="flex-item-right">
					<label >Phone Number</label>
					<input type="text" name="phone_no" value="{{$phone_no}}" placeholder="Example: 01X XXX XXXX">
					<div class="error-message">{{$errors->first('phone_no')}}</div> 
				</div>	
				
			</div>

			<div class="field-form">
				<div>
					<label >Company Address:</label>
					<textarea name="company_address" placeholder="No 16,BS 9/7">{{$company_address}}</textarea>
					<div class="error-message">{{$errors->first('company_address')}}</div> 
				</div>

			</div>
			
			
			
		</div>
		<input type="submit" name="submit" value="Add"> 	
			</form>	
	</div>


</body>
</html>