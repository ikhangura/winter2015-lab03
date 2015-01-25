<?php
/**
* Add strong tag to all capitalized words in qotes.
*
* hooks/Compress.php
*
* ------------------------------------------------------------------------
*/
class Compress {
function __construct() {
}
//-------------------------------------------------------------
// The normal pages
//-------------------------------------------------------------
// This function bolds all capitalized words!
function highlight()
{
    // echo "data coming from hooks";
     // intercept output
    $CI =& get_instance();
    $data = $CI->output->get_output();
    // find the quote and make it an array of words!
   // substr(string,start,length)   method  // 16 is for p tag stuff
    $quote = substr($data, strpos($data, '<p class="lead">') + 16,
    strpos($data, '</p>') - (strpos($data, '<p class="lead">') + 16));
    // get all the required data into aaray form 
    $newdata = explode(" ", $quote);
   // create new array for updated quote
   $requiredoutput = array();
   // iterate all the words and add strong tag to them, if there is any capital word 
   foreach($newdata as $word)
   {
        if( preg_match("/[A-Z]+/", $word) )
        {
            $word = "<strong>" . $word . "</strong>";
        }
    $requiredoutput[] = $word;
   }
        // put everything together
        $newquote = implode(" ", $requiredoutput);
        $newquote = '<p class="lead">' . $newquote . '</p>';
        $data = preg_replace('#<p class="lead">.+</p>#', $newquote, $data);
        // output the page!
        $CI->output->set_output($data);
        $CI->output->_display();
}
}

/* End of file Compress.php */
