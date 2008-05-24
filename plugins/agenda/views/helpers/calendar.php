<?
class CalendarHelper extends Helper {
	
	var $helpers = array('Html','Ajax');
	
	function day($day = null, $month = null, $year = null, $events = null) {
		$out = $this->today($day,$month,$year);
		$out .= $this->events($day,$month,$year,$events);
		return $this->output($out);
	}
	
	function events($day=null,$month=null,$year=null,$events=array()) {
		$entry = array();
		$i = 0;
		$x = 0;
		$max = 3;
		$maxed = false;
		if ($month < 10) { $month = "0".$month; }
		if ($day < 10) { $day = "0".$day; }
	
		if (empty($events)) { 
			return null; 
		} else {
			foreach ($events as $event) {
				$date = strtotime($event['Event']['date']);
				$dday = date("d",$date); 
				$mmonth = date("m",$date);
				$yyear = date("Y", $date);
				if ($dday == $day && $mmonth == $month && $yyear == $year) {
					$entry[$i]['headline'] = $event['Event']['headline'];
					$entry[$i]['id'] = $event['Event']['id'];
					$entry[$i]['course_id'] = $event['Event']['course_id'];
				}
				$i++;
			}
			
			if ($entry) {
				$output = '<ul>';
				foreach ($entry as $item) {
					$output .= 
					'<li class="event">'.
					$this->Html->link($item['headline'],array('plugin' => 'agenda','controller' => 'events','action' => 'view', $item['id'],'course_id' => $item['course_id'])).
					'</li>';
				}
				$output .= '</ul>';
				return $this->output($output); 
			} else {
				return null;
			}
		}
	}
	
	function today($day=null,$month=null,$year=null) {
		if ($day == date('j') && $month == date('m') && $year == date('Y')) {
			$output = '<strong class="today">'.$day.'</strong>';
		} else {
			$output = '<strong>'.$day.'</strong>';
		}
		return $this->output($output);
	}
}
?>