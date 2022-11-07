

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title></title>
   
<link href="/css/adminstyle.css" rel="stylesheet"> 
<script src="https://use.fontawesome.com/ef6dc49ffd.js"></script>
</head>
<body>
	<div class="container">
	<div class="SiteMapPath">
			<a href="{{url('/dashboard')}}" class="sitemap_home"><i class="fa fa-home" aria-hidden="true"></i>Home</a>
				<div class="SiteMapPath-content">

					<span>></span>
					<span>Invoice List</span>
				</div>
		</div>	

<div class="list-add-button">
<?php 

    $company_name = isset($invoicesData['company_name']) ? $invoicesData['company_name'] : 'invoice';


 ?>
 
	<a href="/{{$company_name}}/invoice_create">Add Invoice</a>



</div>


<table id="userTable">
        <thead>
            <th>Invoice No</th>
            <th>Company Name</th>
            <th>Amount(RM)</th>
            <th>Date</th>
            <th>Status</th>
            <th>Action</th>
        </thead>
        <tbody>
            <?php 
            
            
             ?>
            <?php if(!empty($invoicesData['invoices'])) { ?>
                <?php foreach($invoicesData['invoices'] as $row) { ?>
                    <tr>
                       <td>{{$row->invoice_no}}</td> 
					   <td>{{$row->company_name}}</td>

					   <td>{{$row->total_amount}}</td>
                       <td>
                        <?php 
                            $date=date_create($row->invoice_date);
                            echo date_format($date,"d-M-Y");
                         ?>
                        </td>
					   <td>{{$row->status}}</td>
					   <td>
                        <button>EDIT</button>
                        <a href="/download-invoice/{{$row->invoice_id}}">PDF</a>
                       </td>
                    </tr>
                <?php } ?>
            <?php } ?>
        </tbody>
    </table>
	</div>


<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script type="text/javascript" src="//cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
    <script>
    $(document).ready(function() {
        $('#userTable').DataTable();
    });
    </script>
</body>
</html>