<?php
    include('session.php');
    error_reporting(E_ALL & ~E_NOTICE);
  class Calendar
  {
	      var $events;

	function Calendar($date)
	{
		if(empty($date)) $date = time();
		define('NUM_OF_DAYS', date('t',$date));
		define('CURRENT_DAY', date('j',$date));
		define('CURRENT_MONTH_A', date('F',$date));
		define('CURRENT_MONTH_N', date('n',$date));
		define('CURRENT_YEAR', date('Y',$date));
		define('START_DAY', (int) date('N', mktime(0,0,0,CURRENT_MONTH_N,1, CURRENT_YEAR)) - 1);
		define('COLUMNS', 7);
		define('PREV_MONTH', $this->prev_month());
		define('NEXT_MONTH', $this->next_month());
		$this->events = array();
	}

	function prev_month()
	{
		return mktime(0,0,0,
				(CURRENT_MONTH_N == 1 ? 12 : CURRENT_MONTH_N - 1),
				(checkdate((CURRENT_MONTH_N == 1 ? 12 : CURRENT_MONTH_N - 1), CURRENT_DAY, (CURRENT_MONTH_N == 1 ? CURRENT_YEAR - 1 : CURRENT_YEAR)) ? CURRENT_DAY : 1),
				(CURRENT_MONTH_N == 1 ? CURRENT_YEAR - 1 : CURRENT_YEAR));
	}
	
	function next_month()
	{
		return mktime(0,0,0,
				(CURRENT_MONTH_N == 12 ? 1 : CURRENT_MONTH_N + 1),
				(checkdate((CURRENT_MONTH_N == 12 ? 1 : CURRENT_MONTH_N + 1) , CURRENT_DAY ,(CURRENT_MONTH_N == 12 ? CURRENT_YEAR + 1 : CURRENT_YEAR)) ? CURRENT_DAY : 1),
				(CURRENT_MONTH_N == 12 ? CURRENT_YEAR + 1 : CURRENT_YEAR));
	}
	
	function getEvent($timestamp)
	{
		$event = NULL;
		if(array_key_exists($timestamp, $this->events))
			$event = $this->events[$timestamp];
		return $event;
	}
	
	function addEvent($event, $day = CURRENT_DAY, $month = CURRENT_MONTH_N, $year = CURRENT_YEAR)
	{ 
		
		$timestamp = mktime(0, 0, 0, intval($month),intval($day), intval($year));
		if(array_key_exists($timestamp, $this->events))
			array_push($this->events[$timestamp],$event);
		else
			$this->events[$timestamp] = array($event);
	}
	
	function makeEvents()
	{   echo "<strong style='font-size:45px;'>My Appointments</strong><br>";
         $i=1;	
		if($events = $this->getEvent(mktime(0, 0, 0, CURRENT_MONTH_N, CURRENT_DAY, CURRENT_YEAR))){
			foreach($events as $event) {echo "<strong style='font-size:45px;'>".$i.")".$event.'<br />';
			$i++;
		}
	}
}
	
	function makeCalendar()
	{
		echo '<table border="1" cellspacing="20" style="text-align: center;"><tr>';
		echo '<td width="30"><a href="?date='.PREV_MONTH.'">&lt;&lt;</a></td>';
		echo '<td colspan="5" style="text-align:center">'.CURRENT_MONTH_A .' - '. CURRENT_YEAR.'</td>';
		echo '<td width="30"><a href="?date='.NEXT_MONTH.'">&gt;&gt;</a></td>';
		echo '</tr><tr>';
		echo '<td width="30">Mon</td>';
		echo '<td width="30">Tue</td>';
		echo '<td width="30">Wed</td>';
		echo '<td width="30">Thu</td>';
		echo '<td width="30">Fri</td>';
		echo '<td width="30">Sat</td>';
		echo '<td width="30">Sun</td>';
		echo '</tr><tr>';
		
		echo str_repeat('<td>&nbsp;</td>', START_DAY);
		
		$rows = 1;
		
		for($i = 1; $i <= NUM_OF_DAYS; $i++)
		{
			if($i == CURRENT_DAY)
				echo '<td style="background-color: #C0C0C0"><strong>'.$i.'</strong></td>';
			else if($event = $this->getEvent(mktime(0, 0, 0, CURRENT_MONTH_N, $i, CURRENT_YEAR)))
				echo '<td style="background-color: #99CCFF"><a href="?date='.mktime(0,0,0,CURRENT_MONTH_N,$i,CURRENT_YEAR).'">'.$i.'</a></td>';
			else
				echo '<td><a href="?date='.mktime(0 ,0 ,0, CURRENT_MONTH_N, $i, CURRENT_YEAR).'">'.$i.'</a></td>';
					
			if((($i + START_DAY) % COLUMNS) == 0 && $i != NUM_OF_DAYS)
			{
				echo '</tr><tr>';
				$rows++;
			}
		}
		echo str_repeat('<td>&nbsp;</td>', (COLUMNS * $rows) - (NUM_OF_DAYS + START_DAY)).'</tr></table>';
	}
}
$even=$day=$month=$year=$dt=$sd="";
$cal = new Calendar($_GET['date']);
$ses_empho = mysqli_query($conn,"SELECT * FROM appointments WHERE username='$user_check' ORDER BY starttime asc ");
while ($row = mysqli_fetch_array($ses_empho,MYSQLI_ASSOC)){

     $even="<strong style='font-size:35px;' >".$row['title']." </strong>- <br>"."<strong style='font-size:25px;'>".$row['description']." <br>   "."From : ".$row['starttime']." <br>     To  : ".$row['endtime']."</strong><br><br><br>";
     $sd=explode(" ",$row['starttime']);
     $dt=explode("-",$sd[0]);
     $day=$dt[2];
     $month=$dt[1];
     $year=$dt[0];
            
     /*$day=date_format($row['starttime'],'l');
     //$day = $row['starttime']->format("d");
     $month = date_format($row['starttime'],'m');
     $year = date_format($row['starttime'],'Y');
     */
     $cal->addEvent($even,$day,$month,$year);
     
 }
/*$cal->makeCalendar();
$cal->makeEvents();
*/
?>
<!DOCTYPE html>
<html>
<head>
	<title>Calendar Appointment</title>
	<style type="text/css">
		body{
			background-color: gold;
		}
		#bu {        width: 19%;
                     background-color: green;
                     color: white;
                     padding: 14px 20px;
                     margin: 8px 0;
                     border: 3px solid;
                     border-radius: 4px;
                     border-color: white;
                     cursor: pointer;}
	</style>
</head>
<body>
<h2 style="text-align: right;";><a href = "logout.php">Sign Out</a></h2>
<div id="myevents" style="padding-left: 400px;">
<div id="header"><h1 style="color: rgb(200,110,180);font-size: 40px;font-weight: bold;padding-left: 50px;">Your Calendar</h1></div>
<?php
$cal->makeCalendar();
$cal->makeEvents();
?>
<button onclick="location.href='welcome.php' " id="bu">Go back to home Page</button>
</div>
</body>
</html>