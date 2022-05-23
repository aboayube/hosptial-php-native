<?php
//url function
function getLanguageUrl($lang='ar'){
     if(isset($_SERVER['QUERY_STRING'])){
        $x=explode("&",$_SERVER['QUERY_STRING']);
        if(isset($x[1])){
          echo '?lang='.$lang.'&'.$x[1];  
     
      
        }else{
          echo '?lang='.$lang;
      
      
        }
      } else{
          echo '?lang='.$lang;
        
      }
}