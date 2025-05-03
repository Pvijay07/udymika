<?php

defined('BASEPATH') OR exit('No direct script access allowed');



require_once(dirname(__FILE__) . '/dompdf/autoload.inc.php');

use Dompdf\Dompdf as Dompdf;

use Dompdf\Options;
ftpes://developers%2540xhtmlreviews.com@xhtmlreviews.com/udyam/application/libraries/dompdf/autoload.inc.php
class Pdf

{

    function createPDF($html, $filename='', $download=TRUE, $paper='A4', $orientation='portrait'){

        $options = new Options(); 

        $options->set('isPhpEnabled', 'true'); 

        $dompdf = new Dompdf($options);

        $dompdf->load_html($html);

        $dompdf->set_paper($paper, $orientation);

        $dompdf->render();

        

        // file_put_contents($filename, $dompdf->output());

        // return ($filename);

        if($download)

        {

            ob_end_clean();

            $dompdf->stream($filename.'.pdf', array('Attachment' => 1));

        }

        else

        {

            ob_end_clean();

            $dompdf->stream($filename.'.pdf', array('Attachment' => 0));

        }

    }

}

?>

