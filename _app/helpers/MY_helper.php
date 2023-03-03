<?php
defined('BASEPATH') OR exit('No direct script access allowed');

if ( ! function_exists('getWebService')){
	# WS HCDIGITAL 
	function getWebService(){
		$portRandom = rand(9090,9094);
		$url = 'http://';
		$url .= IP_WS_OLD;
		$url .= ':';
		$url .= $portRandom;
		$url .= '/';
        return $url;
    }   
}

if ( ! function_exists('RandPortWS')){
	# Puerto random para WS UNIVERSAL
    function RandPortWS(){
		return rand(9594,9599);
		#return "8085";
    }   
}

if ( !function_exists('GetRutinaInformes'))
{
    function GetRutinaInformes($sec)
    {
        switch($sec){
            case "RESO":    return "VBINFORMES"; break;
            case "ECO":     return "VBINFORMES"; break;
            case "TAC":     return "VBINFORMES"; break;
            case "MAMO":    return "VBINFMAMO"; break;
            case "URO":     return "VBINFMAMO"; break;
            case "DENSITO": return "VBINFDEN"; break;
            case "MN":      return "VBINFMN"; break;
        }
    }   
}

if ( !function_exists('GetNamespaceInformes'))
{
    function GetNamespaceInformes($sec)
    {
        switch($sec){
            case "RESO":    return "TAC"; break;
            case "ECO":     return "FAC"; break;
            case "TAC":     return "TAC"; break;
            case "MAMO":    return "FAC"; break;
            case "URO":     return "FAC"; break;
            case "DENSITO": return "FAC"; break;
            case "MN":      return "FAC"; break;
        }
    }   
}

if ( !function_exists('separa'))
{
    function separa($str, $delim, $piece)
    {
      $pieces = explode($delim,$str);

      if(isset($pieces[$piece - 1])){
        return $pieces[$piece - 1];
      }else{
		return "";
      }
    }   
}

if ( ! function_exists('multiexplode'))
{
	function multiexplode ($delimiters,$string) 
	{
		$ary = explode($delimiters[0],$string);
		array_shift($delimiters);
		if($delimiters != NULL) {
			foreach($ary as $key => $val) {
				$ary[$key] = multiexplode($delimiters, $val);
			}
		}
		return  $ary;
	}
}

