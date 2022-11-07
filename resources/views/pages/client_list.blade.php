

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
					<span>Client List</span>
				</div>
		</div>	

<div class="list-add-button">
	
	<a href="{{url('client','create')}}">Add Client</a>
</div>


<table id="userTable">
        <thead>
            <th>Company Name</th>
            <th>Company Email</th>
            <th>Company Address</th>
            <th> <div class="action_column">Action</div></th>
        </thead>
        <tbody>
            <?php if(!empty($clients)) { ?>
                <?php foreach($clients as $row) { ?>
                    <tr>
                       <td>{{$row['company_name']}}</td>
                       <td>{{$row['company_email']}}</td>
						<td>{{$row['company_address']}}</td>
						<td class="action_column">

                            <img src="icon/ellipsis-vertical.png" width="18px" type="button" class="action-button" id="action_{{$row['client_id']}}" onclick="ActionToggle(this)">
                       
                            <div class="dropdown-content" id="dropdown_{{$row['client_id']}}">
                                <div class="close_dropdown" type="button" id="action_{{$row['client_id']}}" onclick="ActionToggle(this)">
                                    Close
                                    <img src="icon/close.png">
                                </div>
                                 
                           
                                <div><a href="{{$row['company_name']}}/EDIT">View & Edit</a></div>
                                
                                <div><a href="{{$row['company_name']}}/invoice">Invoice</a></div>
                                <div><a href="delete/{{$row['client_id']}}">Delete</a></div>


                            </div>
                            
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

    function ActionToggle(elm){
        var id = $(elm).attr("id").match(/action_(\d+)/)[1];
        console.log(id);
        console.log($(elm).attr("id"));

        if ($("#dropdown_"+id).css("display") == "block") {

            $("#dropdown_"+id).toggle();
            $("#action_"+id).toggle();

            
        }else{
            $(".dropdown-content").css("display","none");
$(".action-button").css("display","inline-block");
            $("#dropdown_"+id).toggle();
            $("#action_"+id).toggle();
        }
        
    }
    </script>
</body>
</html>