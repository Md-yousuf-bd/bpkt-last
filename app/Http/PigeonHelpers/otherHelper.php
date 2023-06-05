<?php


namespace App\Http\PigeonHelpers;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use DateTime;


trait otherHelper
{

    public static function split_array($data,$key){
        $result=array();
        foreach ($data as $d)
        {
            if(is_array($data))
            {
                array_push($result,$d[$key]);
            }
            else if(is_object($data))
            {
                array_push($result,$d->{$key});
            }

        }
        return $result;
    }

    public static function get_dates_by_range($date1, $date2, $format = 'Y-m-d' ) {
        $dates = array();
        $current = strtotime($date1);
        $date2 = strtotime($date2);
        $stepVal = '+1 day';
        while( $current <= $date2 ) {
            $dates[] = date($format, $current);
            $current = strtotime($stepVal, $current);
        }
        return $dates;
    }

    public static function change_date_format($orginal_date,$day_name=true,$changed_format='d-M-Y')
    {
        if(isset($orginal_date)&&$orginal_date!=null) {
            $newDate = date($changed_format, strtotime($orginal_date));
            $day = '';
            if ($day_name) {
                $day = date('l', strtotime($orginal_date)) . ', ';
            }

            return $day . $newDate;
        }
        else{
            return '';
        }
    }

    public static function calculate_age($dob,$today='')
    {
        $bday = new DateTime($dob); // Your date of birth
        if($today=='')
        {
            $today = new Datetime(date('Y-m-d'));
        }
        else
        {
            $today=new Datetime($today);
        }
        $diff = $today->diff($bday);
        return $diff->y .' years,'.$diff->m .' months,'. $diff->d.' days';
    }

    public static function calculate_age_year($dob,$today='')
    {
        $bday = new DateTime($dob); // Your date of birth
        if($today=='')
        {
            $today = new Datetime(date('Y-m-d'));
        }
        else
        {
            $today=new Datetime($today);
        }
        $diff = $today->diff($bday);
        return $diff->y;
    }

    public static function date_after_before($difference,$date=''){
        if($date==''){
            $date=date('Y-m-d');
        }
        return date('Y-m-d', strtotime($difference.' days', strtotime($date)));
    }

    public static function taka_format($amount = 0)
    {
        $minus='';
        if($amount<0){
            $minus='-';
        }
        $amount = abs($amount);
        if ($amount != 0) {
            $tmp = explode('.', $amount); // for float or double values
            $strMoney = '';
            $divide = 1000;
            $amount = $tmp[0];

            if($amount<100)
            {
                $strMoney .= str_pad($amount % $divide, 2, '0', STR_PAD_LEFT);
            }
            else
            {
                $strMoney .= str_pad($amount % $divide, 3, '0', STR_PAD_LEFT);
            }
            $amount = (int)($amount / $divide);
            $i = 1;
            while ($amount > 0) {
                $divide = 100;
                if ($i <= 3) {
                    $i++;
                    $strMoney = str_pad($amount % $divide, 2, '0', STR_PAD_LEFT) . ',' . $strMoney;
                } elseif($i <= 7) {
                    $strMoney = str_pad($amount % $divide, 2, '0', STR_PAD_LEFT) . $strMoney;;
                }
                $amount = (int)($amount / $divide);
            }

            if (substr($strMoney, 0, 1) == '0')
            {
                $strMoney = substr($strMoney, 1);
            }

            if (isset($tmp[1])) { // if float and double add the decimal digits here.
                if (strlen($tmp[1]) >= 2) {
                    return $minus.$strMoney . '.' . substr($tmp[1], 0, 2);
                }
                else {
                    return $minus.$strMoney . '.' . $tmp[1];
                }
            }
            else {
                return $minus.$strMoney;
            }
        } else {
            return '0.00';
        }
    }

    public static $bn = array("১", "২", "৩", "৪", "৫", "৬", "৭", "৮", "৯", "০","সোম","মঙ্গল","বুধ","বৃহস্পতি","শুক্র","শনি","রবি","জানুয়ারি","ফেব্রুয়ারি","মার্চ","এপ্রিল","মে","জুন","জুলাই","আগস্ট","সেপ্টেম্বর","অক্টোবর","নভেম্বর","ডিসেম্বর","বছর","মাস","দিন");
    public static $en = array("1", "2", "3", "4", "5", "6", "7", "8", "9", "0","Monday","Tuesday","Wednesday","Thursday","Friday","Saturday","Sunday","Jan","Feb","Mar","Apr","May","Jun","Jul","Aug","Sep","Oct","Nov","Dec","years","months","days");

    public static function bn2en($number) {
        return str_replace(self::$bn, self::$en, $number);
    }

    public static function en2bn($number) {
        return str_replace(self::$en, self::$bn, $number);
    }

    public static function en2bnOrd($en_order){
         $order = array("1st"=>"১ম","2nd"=>"২য়","3rd"=>"৩য়","4th"=>"৪র্থ","5th"=>"৫ম","6th"=>"৬ষ্ঠ","7th"=>"৭ম","8th"=>"৮ম","9th"=>"৯ম","10th"=>"১০ম",
             "11th"=>"১১তম","12th"=>"১২তম","13th"=>"১৩তম","14th"=>"১৪তম","15th"=>"১৫তম","16th"=>"১৬তম","17th"=>"১৭তম","18th"=>"১৮তম","19th"=>"১৯তম","20th"=>"২০তম",
             "21th"=>"২১তম","22th"=>"২২তম","23th"=>"২৩তম","24th"=>"২৪তম","25th"=>"২৫তম","26th"=>"২৬তম","27th"=>"২৭তম","28th"=>"২৮তম","29th"=>"২৯তম","30th"=>"৩০তম",
             "31th"=>"৩১তম","32th"=>"৩২তম","33th"=>"৩৩তম","34th"=>"৩৪তম","35th"=>"৩৫তম","36th"=>"৩৬তম","37th"=>"৩৭তম","38th"=>"৩৮তম","39th"=>"৩৯তম","40th"=>"৪০তম",
             "41th"=>"৪১তম","42th"=>"৪২তম","43th"=>"৪৩তম","44th"=>"৪৪তম","45th"=>"৪৫তম","46th"=>"৪৬তম","47th"=>"৪৭তম","48th"=>"৪৮তম","49th"=>"৪৯তম","50th"=>"৫০তম");
        return $order[$en_order];
    }

    public static function shorten_long_text($str,$btn_id,$max_length=100)
    {
        if(strlen($str)<=$max_length){
            return $str;
        }
        else{
            $length = strlen($str);
            $output[0] = substr($str, 0, $max_length);
            $output[1] = substr($str, $max_length, $length );
            return $output[0].'<span class="collapse" id="'.$btn_id.'">'.$output[1].'</span><span><a href="#'.$btn_id.'" data-toggle="collapse" style="font-size: 10px; color:white; padding:0px 3px !important;" class="btn btn-info btn-sm" onclick="changeMoreText(this);">More</a></span>';
        }
    }

    public static function validateDate($date, $format = 'Y-m-d'): bool
    {
        $d = DateTime::createFromFormat($format, $date);
        // The Y ( 4 digits year ) returns TRUE for any integer with any number of digits so changing the comparison from == to === fixes the issue.
        return $d && $d->format($format) === $date;
    }

    public static function show_less_more($str,$max_length=5){
        if(self::wordlen($str)>$max_length){
            return '<div class="show-less-div no-print">'.self::subword($str, 0, $max_length) .'   <button class="btn btn-sm btn-link text-sm show-btn" onclick="showMore(this)"> আরো দেখুন </button></div><div class="show-more-div no-print" style="display:none;"> '.$str.' <button class="btn btn-sm text-sm btn-link show-btn" onclick="showLess(this)"> কম দেখুন </button></div><div class="only-print"> '.$str.'</div>';
        }
        else{
            return $str;
        }
    }

    public static function wordlen($str){
        $words=explode(' ',$str);
        return count($words);
    }

    public static function subword($str,$start,$max_length){
        $words=explode(' ',$str);
        $sentence='';

        for($i=$start; $i<$max_length; $i++){
            $sentence.=$words[$i].' ';
        }
        return $sentence;
    }

    public static function download_link($folder,$file_path,$type='btn'){
        if(isset($file_path) || $file_path!=''){
            $file_path_arr=explode('.',$file_path);
            if(count($file_path_arr)>1){
                $file_type=$file_path_arr[count($file_path_arr)-1];
                if($type=='btn') {
                    return '<a href="' . asset($folder . $file_path) . '" class="btn btn-sm btn-success text-light" title="ক্লিক করে ডাউনলোড করুন।" download><span class="fa fa-download"></span> ' . strtoupper($file_type) . '</a>';
                }
                elseif($type=='link'){
                    return '<a href="' . asset($folder . $file_path) . '" class="btn btn-sm btn-link" title="ক্লিক করে ডাউনলোড করুন।" download><span class="fa fa-download"></span> ' . strtoupper($file_type) . '</a>';
                }
                else{
                    return '<a style="font-size:12px !important;" href="' . asset($folder . $file_path) . '" class="btn btn-sm btn-link" title="ক্লিক করে ডাউনলোড করুন।" download>' . $file_path . '</a>';
                }
            }
            else{
                return '';
            }
        }
        else{
            return '';
        }
    }

    public static function get_date_difference($date1,$date2){
        $date1=date_create($date1);
        $date2=date_create($date2);
        $diff=date_diff($date1,$date2);
        return $diff->format("%a");
    }


    public static function get_fiscal_year_by_date($date){
        $date=explode('-',$date);
        $year=(int)$date[0];
        $month=(int)$date[1];
        if($month>6){
            $start_year=$year;
        }
        else{
            $start_year=$year-1;
        }
        return $start_year.'-'.($start_year+1);
    }

    public static function get_fiscal_year_options($selected=array(),$final_year=1950){
        $current_fiscal_year=self::get_fiscal_year_by_date(date('Y-m-d'));
        $current_fiscal_year=explode('-',$current_fiscal_year);
        $last_year=(int)$current_fiscal_year[1];
        $opts='';
        for($i=$last_year;$i>$final_year;$i--){
            $fiscal_year=($i-1).'-'.$i;
            if(in_array($fiscal_year,$selected)){
                $opts.='<option value="'.$fiscal_year.'" selected>'.self::en2bn($fiscal_year).'</option>';
            }
            else{
                $opts.='<option value="'.$fiscal_year.'">'.self::en2bn($fiscal_year).'</option>';
            }
        }
        return $opts;
    }

    public static function add_ordinal_number_suffix($num) {
        if (!in_array(($num % 100),array(11,12,13))){
            switch ($num % 10) {
                // Handle 1st, 2nd, 3rd
                case 1:  return $num.'st';
                case 2:  return $num.'nd';
                case 3:  return $num.'rd';
            }
        }
        return $num.'th';
    }

    public static function get_bangla_number_to_word($number){
        $obj = new BanglaNumberToWord();
        return $obj->numToWord($number);
    }

    public static function get_bangla_date_str($date){
        $date = self::get_bangla_date($date);
        return $date[0].' '.$date[1]. ' '.$date[2];
    }

    public static function get_bangla_date($date){
        $bn = new BanglaDate(strtotime($date));
        return $bn->get_date();
    }


    public static function array_group_by($key, $data)
    {
        $result = array();

        foreach ($data as $val) {
            if (array_key_exists($key, $val)) {
                $result[$val[$key]][] = $val;
            } else {
                $result[""][] = $val;
            }
        }

        return $result;
    }

    public static function array_multi_sort_by_key($array,$key,$order=SORT_ASC,$key2=null,$order2=SORT_ASC){
        if(count($array)>1) {
            $columns = array_column($array, $key);
            if (isset($key2) && isset($order2)) {
                $columns2 = array_column($array, $key2);
                array_multisort($columns, $order, $columns2, $order2, $array);
            } else {
                array_multisort($columns, $order, $array);
            }
        }
        return $array;
    }

}
