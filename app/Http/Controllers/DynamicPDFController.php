<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Session;
use PDF;
use Auth;
use App\Lesson;
use App\Syllabus;
use App\Course;
class DynamicPDFController extends Controller
{
     function index()
    {
     $customer_data = $this->get_customer_data($id);
     return view('application_details')->with('name', $customer_data);
    }

function get_customer_data1($id,$user_id)
{
    $customer_data = DB::table('user_activities')
        ->where('user_id',$user_id)
        ->get();
        return $customer_data;
}
    function get_customer_data($id)
    {
        if(Session()->exists('user'))
        {
        $customer_data = DB::table('user_activities')
        ->where('user_id',Session::get('userid'))
        ->where('course_id',$id)
        ->get();
     
        
        return $customer_data;
        }
    }
    function pdfuser($id,$user_id)
    {
        $pdf = \App::make('dompdf.wrapper');
        $pdf->loadHTML($this->convert_customer_data_to_html1($id,$user_id));
        return $pdf->stream();
    }
    function pdf($id)
    {
        $pdf = \App::make('dompdf.wrapper');
        $pdf->loadHTML($this->convert_customer_data_to_html($id));
        return $pdf->stream();
    }
    function convert_customer_data_to_html1($id,$user_id)
    {
        $lesson=Lesson::where('id',$id)->first();  
        $sylabus=Syllabus::where('id',$lesson->syllabus_id)->first();  
        $course=Course::where('id',$lesson->course_id)->first();  
        $customer_data = $this->get_customer_data1($id,$user_id);
        $output = '
        <h3 align="center">Activity Details</h3>
        <h5>Course Name :- '.$course->title.'</h5>  <h5>Syllabus Name :- '.$sylabus->title.'</h5>  <h5>Lesson Name : '.$lesson->name.'</h5>
        <table width="100%" style="border-collapse: collapse; border: 0px;">
        ';  
        $i=1;
        foreach($customer_data as $customer)
        {
        $output .= '
        <tr>
        <th style="border: 1px solid; padding:12px;">Activity '.$i++.'</th>
        </tr>
        <tr>
        <td style="border: 1px solid; padding:12px;">'.$customer->user_input.'</td>
        </tr>
        ';
        }
        $output .= '</table>';
        return $output;
        
    }
      function convert_customer_data_to_html($id)
    {
       
        //$lesson=Lesson::where('id',$id)->first();  
        $sylabus=Syllabus::where('course_id',$id)->first();  
        $course=Course::where('id',$sylabus->course_id)->first();  
        $customer_data = $this->get_customer_data($id);
        //print_r($customer_data);
        $output = '
        <h3 align="center">Activity Details</h3>
        <h5>Course Name :- '.$course->title.'</h5>  <h5>Syllabus Name :- '.$sylabus->title.'</h5> 
        <table width="100%" style="border-collapse: collapse; border: 0px;">
        ';  
        $i=1;
        foreach($customer_data as $customer)
        {
        $output .= '
        <tr>
        <th style="border: 1px solid; padding:12px;">Activity Title </th>
        <th style="border: 1px solid; padding:12px;">Description </th>
        <th style="border: 1px solid; padding:12px;">Participation grade level </th>
        <th style="border: 1px solid; padding:12px;">Hour spend per week</th>
        <th style="border: 1px solid; padding:12px;">Weeks spent per year</th>
        
        </tr>
        <tr>
        <td style="border: 1px solid; padding:12px;">'.$customer->activity_title.'</td>
        <td style="border: 1px solid; padding:12px;">'.$customer->user_input.'</td>
         <td style="border: 1px solid; padding:12px;">'.$customer->participation_grade.'</td>
          <td style="border: 1px solid; padding:12px;">'.$customer->hour_week.'</td>
           <td style="border: 1px solid; padding:12px;">'.$customer->week_year.'</td>
           
        </tr>
        ';
        }
        $output .= '</table>';
        return $output;
    }

}
