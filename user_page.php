
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ระบบยืม-คืนรถยนต์</title>
    <link href='http://cdnjs.cloudflare.com/ajax/libs/fullcalendar/2.4.0/fullcalendar.min.css'  rel='stylesheet' />
	<link href='http://cdnjs.cloudflare.com/ajax/libs/fullcalendar/2.4.0/fullcalendar.print.css'  rel='stylesheet' media='print' />
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
    <!-- Optional theme -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap-theme.min.css">
    <style>
        body {
            font-family: 'Arial', sans-serif;
        }

        #sidebar {
            height: 100%;
            width: 200px;
            position: fixed;
            z-index: 25;
            top: 0;
            left: 0;
            background-color: #111;
            padding-top: 20px;
            padding-right: 10px;
            color: white;
        }

        #sidebar a {
            padding: 10px;
            text-decoration: none;
            font-size: 18px;
            color: white;
            display: block;
        }

        #content {
            margin-left: 220px;
            padding: 20px;
        }

        #logout-but {
            height: 100%;
            width: 200px;
            position: fixed;
            z-index: 25;
            top: 0;
            left: 0;
            background-color: #111;
            padding-top: 20px;
            padding-right: 10px;
            color: white;
        }

        .container {
            margin-left: 250px;
            padding: 80px;
        }

        h1 {
            color: #333;
        }

        table {
            width: 10%;
            border-collapse: center;
            margin-top: 20px;
        }

        th, td {
            border: 5px solid #ddd;
            padding: 15px;
            text-align: center;
        }

        th {
            background-color: #3498db;
            color: #fff;

        }

        #calendar{
			margin-top:5px;
		}

        
    </style>
</head>
<body>

<div id="sidebar">
    <a href="user_page.php" onclick="loadContent('user_page.php')">หน้าหลัก</a>
    <a href="borrow_form.php" onclick="loadContent('borrow_form.php')">รถที่ว่าง</a>
    <a href="test.php" onclick="loadContent('test.php')">รายงาน</a>
    <a href="report.php" onclick="loadContent('report.php')">รายงาน</a>
    <a href="logout.php">ออกจากระบบ</a> 
</div>
<div class="container">
			<div class="row">
				<div class="col-md-12">
					<h4>Example Fullcalendar Modal With MySQL</h4>
					<!-- Button trigger modal New data-->
					<button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#new_calendar_modal">
					  เพิ่มข้อมูล
					</button>
					
					<div id='calendar'></div>
				</div>
			</div>
		</div>
		
			<!-- Button trigger modal Edit data-->
			<span id="trigger_modal" data-toggle="modal" data-target="#calendar_modal"></span>

				<!-- Modal For edit data-->
				<div class="modal fade" id="calendar_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
				  <div class="modal-dialog" role="document">
					<div class="modal-content">
					  <div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						<h4 class="modal-title" id="myModalLabel">Fullcalendar Modal With MySQL</h4>
					  </div>
							<div id="get_calendar"></div>
					</div>
				  </div>
				</div>
				
				
				<!-- Modal For new data-->
				<div class="modal fade" id="new_calendar_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
				  <div class="modal-dialog" role="document">
					<div class="modal-content">
					  <div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						<h4 class="modal-title" id="myModalLabel">New Fullcalendar Modal With MySQL</h4>
					  </div>
					  <div class="modal-body">
							<form id="new_calendar">
							  <div class="form-group">
								<label >เรื่อง</label>
								<input type="text" class="form-control" name="title" placeholder="">
							  </div>
							  <div class="form-group">
								<label >วันที่เริมต้น</label>
                                <input type="date" name="mydate" class="form-control" min="<?php echo date('Y-m-d');?>">
							  </div>
							  <div class="form-group">
								<label >วันที่สิ้นสุด</label>
								<input type="date" name="mydate" class="form-control" min="<?php echo date('Y-m-d');?>">
							  </div>
							  <input type="hidden" name="new_calendar_form">
							</form>
					  </div>
					  <div class="modal-footer">
							<button type="button" class="btn btn-primary" onclick="return new_calendar();">บันทึกข้อมูล</button>
							<button type="button" class="btn btn-default" data-dismiss="modal">ปิด</button>
						
					  </div>
					</div>
				  </div>
				</div>
			
		<!-- Javascript -->
		<script src="https://code.jquery.com/jquery-1.10.2.js"></script>
		<script src='https://fullcalendar.io/js/fullcalendar-2.4.0/lib/moment.min.js'></script>
		<script src='https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/2.4.0/fullcalendar.min.js'></script>
		<!-- Latest compiled and minified JavaScript -->
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>

  <!-- นำเข้า script File -->
  <script src='script.js'></script>	
</body>
</html>
