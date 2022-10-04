<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

// Menyisipkan File PDF
require_once dirname(__FILE__).'/tcpdf/tcpdf.php';


class Pdf extends TCPDF
{

	function __construct()
	{
		parent::__construct();
	}
}