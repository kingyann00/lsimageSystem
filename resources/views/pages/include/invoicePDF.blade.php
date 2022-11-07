<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>
		
	</title>
	<style>
@import url('https://fonts.googleapis.com/css2?family=Roboto+Condensed:wght@300&family=Yellowtail&display=swap');
</style>
	<style type="text/css">	
	*{
		margin: 0;
	}
	.container{
		margin: 40px 50px 0px 50px;
		 font-family: Arial, Helvetica, sans-serif;
		 font-size: 10px;
		/*background-color: red;*/
	}
	.font-bold{
		font-weight: bold;
	}
	.invoice-header{
		display: flex;
		flex-wrap: wrap;
		align-items: center;
		justify-content: center;

		background-color: white;
	}
	.business-info{
		flex: 3;
		display: block;
		text-align: center;
		/*background-color: blue;*/

	}
	.invoice-title{
		text-align: center;
		font-size: 25px;
		font-weight: bold;
		margin-bottom: 15px;
	}
	.client-box{
		display: flex;
		align-items: flex-start;

	}
	.invoice-info{
		flex: 1;
	
	}
	.client-info{

	}
	.client-info div{
		padding-bottom: 5px;
		margin-bottom: 5px;
		border-bottom: 1px solid black;
		
	}
	.invoice-detail{
		margin-bottom: 50px;
	}
	.invoice-detail table{
		
		border-collapse: collapse;
		text-align: center;

	}
	.invoice-detail th{
		font-weight: bold;
		text-align: center;
		border: 1px solid black;
		height: 20px;

	}
	.invoice-detail td{
		border: 1px solid;
		height: 20px;
		padding: 5px;

	}
	.invoice-sign{
		border-top: 1px solid black;
		text-align: center;
		font-weight: bold;
		margin: 0px 60px;

	}

	.invoice-summary{
		margin-bottom: 50px;
		text-align: center;
		width: 60%;
		border-bottom: 1px solid black;
	}
	.invoice-summary div{
		margin-bottom: 5px;
	}
	.summary-detail div{
		text-align: left;
		padding: 5px;
		margin-left: 50px;
	}

	.invoice-amount {
		text-align: right;
		
	}
	.invoice-amount div{
		padding: 5px;
	}
	.invoice-description div{
		margin-left: 10px;
		text-align: left;
	}
	</style>
</head>
<body>


<div class="container">
	<div class="invoice-header">
		<table width="100%">
			<tr>
				<td style="vertical-align: top;">
					<div class="business-info">
						<div class="invoice-title">LSIMAGE PRINT ENTERPRISE</div>
						<div>(TR0247803-M)</div>
						<div>JALAN SR 4/18 TAMAN SERDANG RAYA, 43300 SERI KEMBANGAN, SELANGOR.</div>

						<div>
							<label>Tel</label>
							<label>:</label>
							<label>+603-8957 8903</label>
						</div>

						<div>
							<label>Email</label>
							<label>:</label>
							<label>ls_color@yahoo.com / ls.inkjetprint@gmail.com</label>
						</div>

					</div>
				</td>
				<td>
					<div class="invoice-info">
					<div>
						<label>Invoice No</label>
						<label>:</label>
						<label>{{$invoice['invoice_client']->invoice_no}}</label>
					</div>
					<div>
						<label>Date</label>
						<label>:</label>
						<label>
							<?php 
							$date=date_create($invoice['invoice_client']->invoice_date);
							echo date_format($date,"d/m/Y");
							 ?>
							</label>
					</div>
					</div>
				</td>
			</tr>
		</table>
		
		
		
	</div>
	<div class="invoice-title">Tax Invoice</div>
	<div class="client-box">
		<table width="100%">
			<tr>
				<td style="vertical-align: top;">
					<div style="font-family: 'Roboto Condensed', sans-serif;
font-family: 'Yellowtail', cursive;">M/s</div>
				</td>
				<td>
					<div class="client-info">
						<div>{{$invoice['invoice_client']->company_name}}</div>
						<div>{{$invoice['invoice_client']->company_address}}</div>
						
					</div>
				</td>
			</tr>
		</table>
		
		
	</div>
			
	<div class="invoice-detail">
		<table width="100%">
			<tr>
				<th>NO</th>
				<th width="50%">DESCRIPTION</th>
				<th>QTY</th>
				<th  colspan="2">
					<div>UNIT PRICE</div>
					<table width="100%">
						<tr>
							<td style="border: none;">RM</td>
							<td style="border: none;">CTS</td>
						</tr>
					</table>
				</th>
				<th colspan="2">AMOUNT</th>
			</tr>
			
			<?php 
			$index;
			foreach ($invoice['invoice_detail'] as $key => $invoice_detail) {
				echo '<tr>';
				echo '<td>';
				$index =  $key+1;
				echo $index;
				echo '</td>';
				foreach ($invoice_detail as $key => $value) {
					
					if ($key == 'unit_price' || $key == 'amount') {
						
						if ($value == 0) {
							$unit_price = '-';
							$CTS = '-';
							
						}else{
							$CTS = explode('.', $value);
							$unit_price = $CTS[0];
							if (isset($CTS[1])) {
								$CTS = $CTS[1]*10;
							}else{
								$CTS = '00';
							}
						}
						
						echo '<td class="invoice-amount">'.$unit_price.'</td>';
						echo '<td class="invoice-amount">'.$CTS.'</td>';	
						
					}else{
						if ($key == 'DESCRIPTION') {
							echo '<td class="invoice-description"> <div>'.$value.'</div></td>';
							
						}else{

							if ($value == 0) {
								
									echo '<td>-</td>';

							}else echo '<td>'.$value.'</td>';
						}
						
					}

					

				}
				echo '</tr>';
			}
			if ($index < 15) {
				for ($i=0; $i < 15-$index; $i++) { 
				?>
				<tr>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
				</tr>
				<?php
				}
			}
			
			 ?>
			
			<tr>
				<td style="border: none;"></td>
				<td colspan="4">
					<div  class="summary-detail">
						<div>Total(excluding GST)</div>
						<div>*GST payable @ 0%</div>
					</div>
					
				</td>
				<td>
					<div  class="invoice-amount">
						<?php 

						$subtotal_CTS = explode('.', $invoice['invoice_client']->subtotal);
						
						// $sst =  round($invoice['invoice_client']->subtotal * ($invoice['invoice_client']->percent /100),1);
						 $sst =  round($invoice['invoice_client']->subtotal * (0 /100),1);
						$sst_CTS = explode('.', $sst);

						 ?>
						<div><?php if (isset($subtotal_CTS[0])) { echo $subtotal_CTS[0]; }else echo '00'; ?></div>
						<div><?php if (isset($sst_CTS[0])) { echo $sst_CTS[0]; }else echo '00'; ?></div>
					</div>
				</td>
				<td>
					<div  class="invoice-amount">
						<div><?php if (isset($subtotal_CTS[1])) { echo $subtotal_CTS[1]*10; }else echo '00'; ?></div>
					
						<div><?php if (isset($sst_CTS[1])) { echo $sst_CTS[1]*10; }else echo '00'; ?></div>
					</div>
				</td>
			</tr>
			<tr>
				<td style="border: none;"></td>
				<td colspan="4">
					<div  class="summary-detail">
					<div>Total Amount Payable</div>
					</div>
				</td>
				<?php 

				$amount = $invoice['invoice_client']->subtotal - $sst;
				$amount_CTS = explode('.', $amount);
				 ?>
				<td class="invoice-amount">
					<div><?php if (isset($amount_CTS[0])) { echo $amount_CTS[0]; }else echo '00'; ?></div>
				
				</td>
				<td class="invoice-amount">
					<div><?php if (isset($amount_CTS[1])) { echo $amount_CTS[1]*10; }else echo '00'; ?></div>
				</td>
			</tr>
			<tr>
				<td style="border: none;"></td>
				<td colspan="6" style="border: none;">
					<div  style="text-align: left;">
						<div style="font-style: italic; font-family: 'Times New Roman', Times, serif;">Goods sold out are not returnable & exchange.</div>
						<div style="font-weight: bold;">
							<div>Note:</div>
							<div>1. All Cheque should be crossed and make payable to LSIMAGE PRINT ENTERPRISE</div>
							<div>2. Our company HongLeong Bank Acc No. <span style="color: #28398f;">24300034806</span></div>
						</div>
						
					</div>
					
				</td>
				
			</tr>
		</table>
	</div>
	<div>
		<table width="50%">
			<tr>
				<td>
					<div class="invoice-summary">
						<div>GST Summary 0%</div>
						<div>RM {{number_format($sst,2)}}</div>
					</div>
					
				</td>
				<td>
					<div class="invoice-summary">
					<div>Amount Pay</div>
					<div>RM {{number_format($amount,2)}}</div>
					</div>
				</td>
			</tr>
		</table>
	</div>
	<div class="invoice-footer">
		
		<table width="100%">
			<tr>
				<td>
					<div class="invoice-sign">
						<p>PLEASE CHOP & SIGN</p>
					</div>
				</td>
				<td>
					
					<div class="invoice-sign">
						<p>LSIMAGE PRINT ENTERPRISE</p>
					</div>
				</td>
			</tr>
		</table>
	</div>

</div>

<!-- <a href="download-invoice/eyJpdiI6InNXck8wREVDejlqSys4c09XNHZEMkE9PSIsInZhbHVlIjoiVmt1MTdBRUtRSEVpVTFuZ0ZCU1JDdz09IiwibWFjIjoiZmEzZDNhZDg0OTEzZWI1NzE1ZWYyM2I0NmFkZmM1ZWZhMzY4Yjg1NzJiMTljYTljOTIxMmU3MDNmZmQyODIwYyIsInRhZyI6IiJ9">aa</a>
    -->
</body>
</html>


