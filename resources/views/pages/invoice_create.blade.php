<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title></title>
	<link href="/css/adminstyle.css" rel="stylesheet"> 
	<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Roboto+Condensed:wght@300&family=Rubik:wght@500&family=Yellowtail&display=swap" rel="stylesheet">
	<script src="https://kit.fontawesome.com/cb4d10cc90.js" crossorigin="anonymous"></script>
	<style type="text/css">
		
	</style>

</head>
<body>

<?php if (Session::has('error')): ?>
{{\Session::get('error')}}
<?php endif ?>
	<div class="container">
		<div class="SiteMapPath">
			<a href="{{url('/dashboard')}}" class="sitemap_home"><i class="fa fa-home" aria-hidden="true"></i>Home</a>
				<div class="SiteMapPath-content">
					<span>></span>
					<?php if ($clientInfo): ?>
						<a href="{{url($clientInfo['client']->company_name)}}/invoice">{{$clientInfo['client']->company_name}}</a>	
					<?php else: ?>
					<a href="{{url('invoice')}}">Invoice</a>
					<?php endif ?>
					<span>></span>
					<span>Add Invoice</span>
				</div>
		</div>	
		<form method="post" action="{{url($clientInfo['client']->company_name,'store')}}">
			{{csrf_field()}}
			<div class="form-box">
			
					<button type="button" id="clientDetail_button"  class="form-section-header" onclick="Section_control('client_form')">
						<div>Client Detail</div>
						<i class="fa-solid fa-angle-down" class="updown_button" ></i>
					</button>
			
			<div class="field-form client_form">
				
				<div class="flex-item-left">
					<label >Company Name:</label>
					<input  name="company_name"
					<?php if ($clientInfo): ?>
						value="{{$clientInfo['client']->company_name}}" readonly
					<?php else: ?>
						placeholder="Example: Sample Company SDN BHD"
					<?php endif ?>
					>
					
				</div>
				
				<div class="flex-item-right">
					<label >Company Email:</label>
					<input  name="company_email"
					<?php if ($clientInfo): ?>
						value="{{$clientInfo['client']->company_email}}" readonly>
					<?php else: ?>
						placeholder="Example: samplecompany@gmail.com">
					<?php endif ?>


					
				</div>	
				
			</div>

			<div class="field-form client_form">
				<div>
					<label >Company Address:</label>
					
					<?php if ($clientInfo): ?>
						<textarea name="company_address" readonly>{{$clientInfo['client']->company_email}}</textarea>
					<?php else: ?>
						<textarea name="company_address" placeholder="Example: samplecompany@gmail.com"></textarea>
					<?php endif ?>
					
				</div>

			</div>

			<div class="field-form client_form">
				<div class="flex-item-left">
					<label >Person In Charge Name</label>
					<?php if ($clientInfo): ?>
						<select name="Pic_ID" class="PIC_Name">
							 <option value="N/A" selected disabled>--Select A option--</option> 
						<?php 
							$PIC = $clientInfo['PIC'];
					        for ($i=0; $i < sizeof($PIC); $i++){ ?>
					           <option value="{{$PIC[$i]->PIC_id}}">{{$PIC[$i]->PIC_Name}}</option> 
					            
					       
						<?php } ?>
						

					 </select>
					<?php else: ?>
						<input type="text" name="PIC_Name" value="" placeholder="Example: Jack Ma">
					<?php endif ?>
					
					
					<!-- <div class="error-message">{{$errors->first('PIC_Name')}}</div> --> 
				</div>
				
				<div class="flex-item-right">
					<label >Phone Number</label>
					<div class="phone_no">
						<?php if ($clientInfo): ?>
							<input  name="phone_no"  value="" placeholder="Please Select A Person In Charge" readonly>
						<?php else: ?>
							<input  name="phone_no"  value="" placeholder="Example: 01X XXX XXXX">
						<?php endif ?>
						
					</div>
					
					
				</div>	
				
			</div>

			
			
			
			
		</div>


		<div class="form-box">
			

					<button type="button" id="invoiceDetail_button"  class="form-section-header" onclick="Section_control('invoice_form')">
						<div>Invoice Detail</div>
						<span class="updown_button" >
						<span style="margin-right: 5px; align-self: center;">RM </span>
						<span class="payable_Amount total_amount"></span>

						<i class="fa-solid fa-angle-down"></i>
						</span>	
						
					</button>
			
			<div class="field-form invoice_form">
					<div class="flex-item">
						<label >Invoice Date:</label>
						<input type="date" name="invoice_date">
						
					</div>
	
					
			</div>
			<div class="invoice_box">
				<div class="invoice_detail1">

				<div class="field-form invoice_form">
					<div class="flex-item-left">
						<label >Description:</label>
						<input type="text" name="description[]" placeholder="Example: A1 formboad">
						
					</div>	
					<div class="flex-item-left">
						<label >Quantity</label>
						<div style="display: flex; align-items: center; ">
							<button type="button" class="decrease-button" name="decrease" id="decrease_1" onclick="decreaseValue(this)" value="Decrease Value">-</button>

							<input name="quantity" id="quantity_1" class="quantity_field listing_1" value="1" min="1">

							
							<button type="button" class="increase-button" name="increase" id="increase_1" onclick="increaseValue(this)" value="Increase Value">+</button>
  
						</div>
						
						
						
					</div>
					
					<div class="flex-item-left">
						<label >Unit Price</label>
						<input type="text" name="unit_price" class="listing_1" onkeyup="calculateAmount(this)">
					</div>	
					<div class="flex-item-right">
						<label >Amount</label>
						<input name="amount" class="amount_list" id="amount_1" readonly>
						
					</div>

					
					
				</div>
			</div>
			</div>
			
			<div>
				<button type="button" class="list-add-button invoice_form" id="more_button">+</button>
			</div>
			
			
		</div>
		<div class="form-box">
			<div class="field-form invoice_form">
				<div class="flex-item-left"><input type="hidden" name=""></div>
				<div class="flex-item-left"><input type="hidden" name=""></div>
				<div class="flex-item-left"><input type="hidden" name=""></div>
				<div class="flex-item-left">
					<label >Total(excluding GST)</label>
					<div>
						<span style="margin-right: 5px;">RM </span>
						<div class="payable_Amount subtotal"  ></div>
						<input type="hidden" name="subtotal" class="subtotal">
					</div>	
					
				</div>

			</div>
			<div class="field-form invoice_form">
				<div class="flex-item-left"><input type="hidden" name=""></div>
				<div class="flex-item-left"><input type="hidden" name=""></div>
				<div class="flex-item-left"><input type="hidden" name=""></div>
				<div class="flex-item-left">
					<label >*GST payable @ 0%</label>
					<div>
						<span style="margin-right: 5px;">RM </span>
						<div class="payable_Amount payable_tax"></div>
						<input type="hidden" name="payable_tax" class="payable_tax">
					</div>	
					
				</div>

			</div>
			<div class="field-form invoice_form">
				<div class="flex-item-left"><input type="hidden" name=""></div>
				<div class="flex-item-left"><input type="hidden" name=""></div>
				<div class="flex-item-left"><input type="hidden" name=""></div>
				<div class="flex-item-left">
					<label >Total Amount Payable </label>
					<div>
						<span style="margin-right: 5px;">RM </span>
						<div class="payable_Amount total_amount"></div>
						<input type="hidden" name="total_amount" class="total_amount">
					</div>	
					
				</div>

			</div>

		</div>
		<input type="hidden" name="quantity_list" id="quantity_listing" style="display: none;">
		<input type="hidden" name="unitPrice_list" id="unitPrice_listing" style="display: none;">
		<input type="hidden" name="amount_list" id="amount_listing" style="display: none;">
		<button type="button" onclick="GetListing()"> TESTINg</button>
		<input type="submit" name="submit" value="Add" onclick="GetListing()"> 	
			</form>	
	</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
<script type="text/javascript">
	$(document).ready(function(){
		$(document).on('change','.PIC_Name',function(){
			 // console.log("hmm its change");
			 var PIC_ID=$(this).val();
			// console.log(PIC_ID);
			// var div=$(this).parent();
			$.ajax({
				type:'get',
				url:'{!!URL::to('findPICPhone')!!}',
				data:{'id':PIC_ID},
				success:function(data){
					console.log('success');
					console.log(data);
					console.log(data[0].phone_no);
					op = '<input type="text" name="phone_no" value="'+data[0].phone_no+'" readonly>';
					$("div").find('.phone_no').html(" ");
				   $("div").find('.phone_no').append(op);


				},
				error:function(){
					console.log('error');
				}
			});


		});
		
		$("#more_button").click(function(){

			var $div = $('div[class^="invoice_detail"]:last');

			console.log($div.prop("class").match(/\d+/g));
			var num = parseInt( $div.prop("class").match(/\d+/g), 10 ) +1;
			
			var $klon = $div.clone().prop('class', 'invoice_detail'+num );
			$klon.find("input").val("");
			$klon.find('input[name=quantity]').val("1");
			$klon.find('input[name=quantity]').attr("id", 'quantity_'+num );
			$klon.find('input[name=quantity]').attr("class", 'quantity_field listing_'+num );
			$klon.find('input[name=unit_price]').attr("class", 'listing_'+num );
			$klon.find('input[name=amount]').attr("id", 'amount_'+num );
			$klon.find('button[name=increase]').attr("id", 'increase_'+num );
			$klon.find('button[name=decrease]').css("background-color","#CFCFCE");
			$klon.find('button[name=decrease]').attr("id", 'decrease_'+num );
			
			$div.after($klon);


			$(".invoice_detail").clone().appendTo(".invoice_box");

			// $("p").append(" <b>Appended text</b>.");


		});


	});
	function GetListing() {
		 var quantity_listing = [];
		 var unitPrice_listing = [];
		 var amount_listing = [];

		$('input[name=quantity]').each(function () {
	        
	        if (!isNaN(this.value) && this.value.length != 0) {
	        	quantity_listing.push(this.value); 	
	        }else{
	        	quantity_listing.push(0);
	        }
	        
	     });
		$('input[name=unit_price]').each(function () {
	      
	        if (this.value.length != 0) {
	        	unitPrice_listing.push(this.value);
	        }else{
	        	unitPrice_listing.push("null");
	        }
	        
	     });
		
		$('input[name=amount]').each(function () {
	        if (!isNaN(this.value) && this.value.length != 0) {
	        	amount_listing.push(this.value);    
	        }else{
	        	amount_listing.push(0.00);
	        }
	     });

		// console.log(amount_listing);
		$("#quantity_listing").val(quantity_listing);
		$("#unitPrice_listing").val(unitPrice_listing);
		$("#amount_listing").val(amount_listing);

	}
	function increaseValue(elm) {
		var id = $(elm).attr("id").match(/increase_(\d)/)[1];
		console.log(id);
	  var value = parseInt(document.getElementById('quantity_'+id).value, 10);
	  value = isNaN(value) ? 0 : value;
	  value++;
	  document.getElementById('quantity_'+id).value = value;
	  calculateAmount(id);
	  console.log(value);
	  if (value > 1) {

					$("#decrease_"+id).css("background-color", "#D38D92");
					
		}
	}

	function decreaseValue(elm) {
		var id = $(elm).attr("id").match(/decrease_(\d)/)[1];
	  var value = parseInt(document.getElementById('quantity_'+id).value, 10);
	  // console.log(value);
	  value = isNaN(value) ? 0 : value;
	  value < 1 ? value = 1 : '';
	  
		if (value == 1) {
					$("#decrease_"+id).css("background-color", "#CFCFCE");
					$("#decrease_"+id).css("cursor", "cursor:context-menu;");
					
		}else{
			value--;
	  
			document.getElementById('quantity_'+id ).value = value;
			calculateAmount(id);
			if (value == 1) {
					$("#decrease_"+id).css("background-color", "#CFCFCE");
					$("#decrease_"+id).css("cursor", "cursor:context-menu;");
					
		}
		}
	  
	}
	function calculateAmount(elm) {
		if (!$.isNumeric(elm)) {
			// console.log(elm.value);
			id = $(elm).attr("class").match(/listing_(\d)/)[1];
		}else{
			id = elm;
		}
		console.log(id);
	     var sum = 1;
	     var count = 0;
	     //iterate through each textboxes and add the values
	     $(".listing_"+id).each(function () {

	         //add only if the value is number
	         if (!isNaN(this.value) && this.value.length != 0) {
	            sum *= parseFloat(this.value);
	            count++;

	            
	            
	         }

	     });
	     
	    if (count == 2) {
	    	 $("#amount_"+id).val(sum.toFixed(2));
	    	 calculateTotalAmount();
	    }
	    
	}

	function calculateTotalAmount() {
	    var sum = 0;

	     //iterate through each textboxes and add the values
	    $(".amount_list").each(function () {



	         if (!isNaN(this.value) && this.value.length != 0) {

	             sum += parseFloat(this.value);
	            // count++;
	         }

	     });
	     //.toFixed() method will roundoff the final sum to 2 decimal places
	     var payable_tax = parseFloat("0");
	     var total_amount = sum-payable_tax;
	   		$(".subtotal").text(sum.toFixed(2));
	   		$(".subtotal").val(sum.toFixed(2));
	   		$(".payable_tax").text(payable_tax.toFixed(2));
	   		$(".payable_tax").val(payable_tax.toFixed(2));
	   		$(".total_amount").text(sum.toFixed(2));
	   		$(".total_amount").val(sum.toFixed(2));
	    
	}
	function Section_control(elm){
		console.log(elm);
		
			$('.'+elm).toggle();
			if (elm == "invoice_form") {
				if ($(".updown_button span").css("display")=="none") {
					$(".updown_button span").css("display","block");
				}else{
					$(".updown_button span").css("display","none");
				}
				
			}
	
		
	}
</script>

</body>
</html>