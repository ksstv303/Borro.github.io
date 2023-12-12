<?php
class Fullcalendar {
 
    private $host = 'localhost'; //ชื่อ Host 
	   private $user = 'root'; //ชื่อผู้ใช้งาน ฐานข้อมูล
	   private $password = ''; // password สำหรับเข้าจัดการฐานข้อมูล
	   private $database = 'car_rental_db2'; //ชื่อ ฐานข้อมูล

	//function เชื่อมต่อฐานข้อมูล
	protected function connect(){
		
		$mysqli = new mysqli($this->host,$this->user,$this->password,$this->database);
			
			$mysqli->set_charset("utf8");

			if ($mysqli->connect_error) {

			    die('Connect Error: ' . $mysqli->connect_error);
			}

		return $mysqli;
	}
	
	//function show data in fullcalendar
	public function get_fullcalendar(){
		
		$db = $this->connect();
		$get_calendar = $db->query("SELECT * FROM calendar");
		
		while($calendar = $get_calendar->fetch_assoc()){
			$result[] = $calendar;
		}
		
		if(!empty($result)){
			
			return $result;
		}
	}
	
	//show data in modal
	public function get_fullcalendar_id($get_id){
		
		$db = $this->connect();
		$get_user = $db->prepare("SELECT id,title,start,end FROM calendar WHERE id = ?");
		$get_user->bind_param('i',$get_id);
		$get_user->execute();
		$get_user->bind_result($id,$title,$start,$end);
		$get_user->fetch();
		
		$result = array(
			'id'=>$id,
			'title'=>$title,
			'start'=>$start,
			'end'=>$end
		);
		
		return $result;
	}
	
	//save new data 
	public function new_calendar($data){
		
		$db = $this->connect();
		
		$add_user = $db->prepare("INSERT INTO calendar (id,title,start,end) VALUES(NULL,?,?,?) ");
		
		$add_user->bind_param("sss",$data['title'],$data['start'],$data['end']);
		
		if(!$add_user->execute()){
			
			echo $db->error;
			
		}else{
			
			echo "บันทึกข้อมูลเรียบร้อย";
		}
	}
	
	//edit data 
	public function edit_calendar($data){
		
		$db = $this->connect();
		
		$add_user = $db->prepare("UPDATE calendar SET title = ? , start = ? ,end = ? WHERE id = ?");
		
		$add_user->bind_param("sssi",$data['title'],$data['start'],$data['end'],$data['edit_calendar_id']);
		
		if(!$add_user->execute()){
			
			echo $db->error;
			
		}else{
			
			echo "บันทึกข้อมูลเรียบร้อย";
		}
	}
	
	//delete data
	public function del_calendar($id){
		
		$db = $this->connect();
		
		$del_user = $db->prepare("DELETE FROM calendar WHERE id = ?");
		
		$del_user->bind_param("i",$id);
		
		if(!$del_user->execute()){
			
			echo $db->error;
			
		}else{
			
			echo "ลบข้อมูลเรียบร้อย";
		}
	}	
}
?>
สร้างไฟล์ json-event.php

ในไฟล์ json-event.php จะรับข้อมูลจาก FORM เพื่อส่งข้อมูลให้กับ Method ต่าง ๆ ภายในไฟล์ fullcalendar.class.php ตาม เงื่อนไข IF

<?php
require "fullcalendar.class.php";

//new object
$fullcalendar = new Fullcalendar();

//check data for show fullcalendar
if(isset($_GET['get_json'])){
	
	//call method get_fullcalendar
	$get_calendar = $fullcalendar->get_fullcalendar();

	foreach($get_calendar as $calendar){
		
		$json[] = array(
			'id'=>$calendar['id'],
			'title'=>$calendar['title'],
			'start'=>$calendar['start'],
			'end'=>$calendar['end'],
			'url'=>'javascript:get_modal('.$calendar['id'].');',
		);
	}
	
	//return JSON object
	echo json_encode($json);
}

//show edit data modal
if(isset($_POST['id'])){
	
	$get_data = $fullcalendar->get_fullcalendar_id($_POST['id']);
	
	echo'<div class="modal-body">
			<form id="edit_fullcalendar">
				  <div class="form-group">
					<label >เรื่อง</label>
					<input type="text" class="form-control" name="title" value="'.$get_data['title'].'">
				  </div>
				  <div class="form-group">
					<label >วันที่เริ่มต้น</label>
					<input type="text" class="form-control" name="start"  value="'.$get_data['start'].'">
				  </div>
				  <div class="form-group">
					<label >วันที่สิ้นสุด</label>
					<input type="text" class="form-control" name="end" value="'.$get_data['end'].'">
				  </div>
					<input type="hidden" name="edit_calendar_id" value="'.$get_data['id'].'">
				</form>
			</div>
		  <div class="modal-footer">
				<button type="button" class="btn btn-danger pull-left" onclick="return del_calendar('.$get_data['id'].');">Delete</button>
				<button type="button" class="btn btn-primary" onclick="return edit_calendar();">Save changes</button>
				<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
		  </div>';
}

//save new data
if(isset($_POST['new_calendar_form'])){
	
	$fullcalendar->new_calendar($_POST);
}

//edit new data
if(isset($_POST['edit_calendar_id'])){
	
	$fullcalendar->edit_calendar($_POST);
}

//delete data
if(isset($_POST['del_id'])){
	
	$fullcalendar->del_calendar($_POST['del_id']);
}