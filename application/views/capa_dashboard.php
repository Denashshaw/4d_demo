
<style type="text/css">	
	.btn-light{
		background-color: #fff !important;
		margin-left: -25px !important;
		border: 1px solid lightgrey !important;
	}

	table.datatable{
		tr>td {
			width: 100px;
			height: 100px;	
		}
	}
</style>


<div class="page-wrapper chiller-theme toggled">
<?php include('header.php'); ?>
	<main class="page-content">
		<div class="container-fluid p-0">
			<div class="row">
				<div class="col-12 col-md-12 content">
					<div class="row head-content">
						<div class="col-9 col-md-4 logo"><img src="<?php echo base_url();?>img/logo.jpg"></div>
						<div class="col-3 col-md-8 text-right logout"><a href="<?php echo base_url();?>login/signout">Logout</a></div>
					</div>

					<div class="row activity-row">
            			<div class="col-md-7 activity">Capa Dashboard: <span id="selected_client"></span></div>
            			<div class="col-md-2 activity">
							<a href="<?php echo base_url('Capa_controller/CapaInsertPage'); ?>" class="btn btn-primary">Insert Page</a>
						</div>				
						<?php if($_SESSION['role'] == 'admin' && $_SESSION['loggedin_client'] != ''){ ?>
						<div class="col-md-2 mr-4 activity" style="padding-bottom: 20px;font-family: 'Montserrat', sans-serif;">
						<!-- <form action="<?php echo base_url('home/changeClient');?>" method="POST">onchange="this.form.submit()" -->
							<select class="selectpicker" multiple name="client_name[]"  id="client_name">
				              <?php foreach ($clientlist as $client) { ?>				              	
				                <option value='<?php echo $client->keyword; ?>'  <?php if($_SESSION['loggedin_client'] == $client->keyword){ ?> selected <?php } ?>><?php echo ucfirst($client->client); ?> </option>
				            <?php } ?>
							</select>
						<!-- </form> -->
						</div>
						<?php } ?>
						<!-- <div class="col-md-2 activity mr-5">
							<a href="<?php echo base_url('Capa_controller/CapaInsertPage'); ?>" class="btn btn-primary">Add Data</a>
						</div> -->
					</div>

					<?php echo $this->session->flashdata('msg');?>

					<div class="row emp-table">
						<div class="col-md-12 table-responsive">
							<table class="display" id="mytable" data-page-length='30'>
								<thead>
									<tr>
										<!-- <th scope="col">Emp Id</th> -->
										<th>SNo</th>
										<th>Client Name</th>
										<th>Feedback Received Date</th>
										<th>Facility</th>
										<th>Issue</th>		
										<th>Parameter</th>
										<th>Error Type</th>
										<th>Criticality</th>
										<th>Frequency</th>
										<th>Claim Id/Account</th>
										<th>Production Date</th>
										<th>Agent Name</th>
										<th>Agent Comments</th>
										<th>Auditor</th>
										<th>Auditor's Comments</th>
										<th>Corrective Action</th>
										<th>Preventive Action</th>
										<th>Source</th>
										<th>Agent's RA</th>
										<th>Auditor's RA</th>
										<th>Comments</th>
										<th>Date Created</th>
										<th>Date Updated</th>
									</tr>
								</thead>
								<tbody>
								</tbody>
							</table>
						</div>
					</div>
				</div>
			</div>
		</main>
	</div>

	<script type="text/javascript">	

	$(document).ready(function() {	    
		generate_datatbl();
		$(`.export_buttons`).hide();
	});

	$('#client_name').change(() => {
		generate_datatbl();
	});
		
	function generate_datatbl(){		
		/*$('.show_all_btn').hide();
	    $(`.export_buttons`).hide();
	    $(`.hide_all_btn`).hide();*/


		var table = $('#mytable').DataTable({	 
			destroy: true,
	    // Processing indicator
	    // "paging": false,
        "processing": true,
        // DataTables server-side processing mode
        "serverSide": true,
        // Initial no order.
        "order": [],
    	"autoWidth": false,	
        "dom" : 'Bfrtip',
        /*lengthMenu: [
            [ 10, 25, 50, -1 ],
            [ '10 rows', '25 rows', '50 rows', 'Show all' ]
        ],*/
        lengthMenu: [[25, 100, -1], [25, 100, "All"]],
    	pageLength: 25,
        buttons: [
        // 'pageLength',
        	{
                text: 'Generate Report',
                action: function ( e, dt, node, config ) {                	
                    $(`.export_buttons`).toggle();
                    /*$('.show_all_btn').show();
				    $(`.export_buttons`).show();
				    $(`.hide_all_btn`).show();*/
                }
            },
            {
                extend: 'print',
                text: '<i class="fa fa-print text-secondary" aria-hidden="true"></i> Print',
                className: 'export_buttons',
                exportOptions: {
                    columns: [':visible' ],
                      modifier: {
	                    search: 'applied',
	                    order: 'applied'
	                }
                },
                /*orientation : 'landscape',
                pageSize : 'A0',*/
            },{
                extend: 'excelHtml5',
                text: '<i class="fa fa-table text-success" aria-hidden="true"></i> Excel',
                className: 'export_buttons',
                exportOptions: {
                    columns: ':visible'
                }
            },
            {
                extend: 'pdfHtml5',
                text: '<i class="fa fa-book text-danger" aria-hidden="true"></i> Pdf',
                className: 'export_buttons',
                exportOptions: {
                    columns: ':visible'
                },
                orientation : 'landscape',
                pageSize : 'A0',
                customize: function ( doc ) {}
            },
            // 'colvis',
            // 'columnsToggle',
            // newly entered code
            
        ],//columnDefs: [
            /*{
                targets: 1,
                className: 'noVis'
            }*/
        //],
        columnDefs: [{
	      targets: [4, 12, 15, 16],
	      createdCell: function(cell) {
	        var $cell = $(cell);
	        var word_length = $cell[0].innerText.length;
	        //showing the read more button only the content is more then 50 characters
	        if(word_length > 50){
		        $(cell).contents().wrapAll("<div class='content'></div>");
		        var $content = $cell.find(".content");

		        $(cell).append($("<button class='btn-xs btn-outline-info rounded'>Read more</button>"));
		        $btn = $(cell).find("button");

		        $content.css({
		          "height": "56px",
		          "overflow": "hidden"
		        })
		        $cell.data("isLess", true);

		        $btn.click(function() {
		          var isLess = $cell.data("isLess");
		          $content.css("height", isLess ? "auto" : "50px")
		          $(this).text(isLess ? "Read less" : "Read more")	          
		          $cell.data("isLess", !isLess)
		        })
	    	}
	      }
	    },{
	    	 "visible" : false,
            "searchable" : false
	    }],
	        ajax:{
		        url : "<?php echo base_url(); ?>Capa_controller/capa_ajax_data",
	            type : 'POST',
	            data: {
	            	client_name: $('#client_name').val()
	        	}
	        },
	        //Set column definition initialisation properties
	       /* "columnDefs": [{ 
	            "targets": [0],
	            "orderable": false
	        }]*/
	    });		
	    // table.destroy();
	}	
	</script>
	