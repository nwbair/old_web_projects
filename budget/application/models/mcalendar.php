<?php
class MCalendar extends Model {
	
	var $conf;
	
	function MCalendar () {
		parent::Model();
		
		$this->conf = array(
			'day_type'		=> 'long',
			'start_day'		=> 'monday',
			'show_next_prev'=> true,
			'next_prev_url'	=> base_url() . 'calendar/index'
		);
		
		$this->conf['template'] = '
			{table_open}<table class="main_cal">{/table_open}
			
			{heading_row_start}<tr>{/heading_row_start}
			
			{heading_previous_cell}<th><a href="{previous_url}">&lt;&lt;</a></th>{/heading_previous_cell}
			{heading_title_cell}<th colspan="{colspan}">{heading}</th>{/heading_title_cell}
			{heading_next_cell}<th><a href="{next_url}">&gt;&gt;</a></th>{/heading_next_cell}
			
			{heading_row_end}</tr>{/heading_row_end}
			
			{week_row_start}<tr>{/week_row_start}
			{week_day_cell}<th class="day_header">{week_day}</th>{/week_day_cell}
			{week_row_end}</tr>{/week_row_end}
			
			{cal_row_start}<tr class="days">{/cal_row_start}
			{cal_cell_start}<td class="day">{/cal_cell_start}
			
			{cal_cell_content}
				<div class="day_listing">{day}</div>
				<div class="content">{content}</div>
			{/cal_cell_content}
			{cal_cell_content_today}
				<div class="today day_listing">{day}</div>
				<div class="content">{content}</div>
			{/cal_cell_content_today}
			
			{cal_cell_no_content}<div class="day_listing">{day}</div>{/cal_cell_no_content}
			{cal_cell_no_content_today}<div class="today day_listing">{day}</div>{/cal_cell_no_content_today}
			
			{cal_cell_blank}&nbsp;{/cal_cell_blank}
			
			{cal_cell_end}</td>{/cal_cell_end}
			{cal_row_end}</tr>{/cal_row_end}
			
			{table_close}</table>{/table_close}
		';
	}
	
	function get_calendar_data($year, $month) {
        $query = $this->db->query("SELECT DISTINCT DATE_FORMAT(date, '%Y-%m-%e') AS date
									FROM budget_bills
									WHERE date LIKE '$year-$month%' "); //date format eliminates zeros make
               															//days look 05 to 5
  
		$cal_data = array();
               
		foreach ($query->result() as $row) { //for every date fetch data
			$a = array();
			$i = 0;
			$query2 = $this->db->query("SELECT name
										FROM budget_bills
										WHERE date LIKE DATE_FORMAT('$row->date', '%Y-%m-%d') "); //date format change back the date format
																								  //that fetched earlier
 			foreach ($query2->result() as $r) {
     			$a[$i] = $r->name;     //make data array to put to specific date
         		$i++;                         
     		}
        		$cal_data[substr($row->date,8,2)] = $a;
    
		}

		return $cal_data;
	}
	  
	
	function generate ($year, $month) {
		
		$this->load->library('calendar', $this->conf);
		
		$cal_data = $this->get_calendar_data($year, $month);
		
		return $this->calendar->generate($year, $month, $cal_data);
	}
}