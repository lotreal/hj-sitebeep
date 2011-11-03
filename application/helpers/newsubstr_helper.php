<?php 

/**
* 字符串截取
*
* @access public
* @param  string  $string 待截取的字符串
* @param  integer $length 截取字符串长度
* @param  boolean $flag   在字符串结尾附加指定字符串
* @return string
*/

function newsubstr($string, $length, $flag = 0)
{
	$temp = '';
	$last = array();
	$append = '...';	
	
    if (strlen($string) <= $length )
    {
        return ($flag) ? $string.$append : $string;
    }
    else
    {
        $i = 0;
		
        while ($i < $length)
        {
            $temp = substr($string,$i,1);
			
            if ( ord($temp) >=224 )
            {
                $temp = substr($string,$i,3);
                $i = $i + 3;
            }
            elseif( ord($temp) >=192 )
            {
                $temp = substr($string,$i,2);
                $i = $i + 2;
            }
            else
            {
                $i = $i + 1;
            }
			
            $last[] = $temp;
        }
		
		unset($temp);
        $last = implode("",$last);		
		return ($flag) ? $last.$append : $last;
    }
}