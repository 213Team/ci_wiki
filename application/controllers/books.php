<?php
require_once('html2pdf/html2pdf.class.php');
include_once 'markdown/Michelf/Markdown.php';
include_once 'markdown/Michelf/MarkdownExtra.php';
use \Michelf\MarkdownExtra;

class Books extends CI_Controller {

	function __construct(){
		parent::__construct();
		date_default_timezone_set("PRC");
	}
	
	function index(){
		$data['title'] = '浏览所有书籍 - Writing in Group';
		$data['login_user'] = $this->session->userdata('user');
		
		$this->load->model('book_model');
		$data['mybooks'] = $this->book_model->getBooks();
		
		$this->load->view('header', $data);
		$this->load->view('books');
        $this->load->view('footer');
	}
	
	function view($bookid, $cid = -1){
		if(!isset($bookid))
			redirect('books');
		$data['title'] = '浏览书籍 - Writing in Group';
		$data['login_user'] = $this->session->userdata('user');
	
		$this->load->model('book_model');
		$this->load->model('catalog_model');
		$this->load->model('body_model');
		
		$data['book'] = $this->book_model->getBooks(array("id"=>$bookid))[0];
		if(!$data['book'])
			redirect('books');
		
		$tmp = $this->catalog_model->getCatalog(array("bookid"=>$bookid));
		if($cid == -1)
			$cid = $tmp[0]->id;
		$data['cid'] = $cid;
		$data['bookid'] = $bookid;
		$data['body'] = $this->body_model->getBody(array('cid'=>$cid))[0];
		
		$data['catalog'] = array();
		if($tmp){
		foreach($tmp as $row){
			if(!isset($data['catalog'][$row->fid])){
				$data['catalog'][$row->fid] = array();
			}
			array_push($data['catalog'][$row->fid], $row);

		}
		}
		
		$this->load->view('header', $data);
		$this->load->view('sidebar');
		$this->load->view('view');
		$this->load->view('footer');
	}
	
	function generatePDF($bookid){
		if(!isset($bookid))
			redirect('books');
		$this->load->model('book_model');
		$book = $this->book_model->getBooks(array('id' => $bookid))[0];
		if(!$book)
			redirect('books');
		else if(!$book->lastgen || $book->lastgen != $book->lastmod){
			 try{
        		$html2pdf = new HTML2PDF('P', 'A4', 'en');
        		$html2pdf->setDefaultFont("DroidSansFallback");
        		$this->load->model('body_model');
        		$this->load->model('catalog_model');
        		$cata = $this->catalog_model->getCatalog(array('bookid'=>$bookid));
        		
        		$page = "
	<page_footer>
        <table style=\"width: 100%;\">
            <tr>
                <td style=\"text-align: left;    width: 50%;  font-family:Droid Sans Fallback;\">协同写作</td>
                <td></td>
                <td style=\"text-align: right;    width: 50%\">[[page_cu]]/[[page_nb]]</td>
            </tr>
        </table>
    </page_footer>
    <div><strong style=\"font-size:68px;\">{$book->title}</strong><br/></div>
    <div style=\"margin:5px;\">
    <h2><strong>Author:{$this->session->userdata('user')['username']}</strong></h2>
    </div>
";
        		$html2pdf->writeHTML($page);
        		foreach($cata as $row){
	        		$body = $this->body_model->getBody(array('cid'=>$row->id))[0];
	        		$html2pdf->addPage();
	        		$html2pdf->writeHTML(MarkdownExtra::defaultTransform($body->body));
	        	}
        		$html2pdf->Output("{$book->title}.pdf");
    		}catch(HTML2PDF_exception $e) {
        		echo $e;
        		exit;
    		}
		}
	}
	
	function pullrequest($bookid, $cid){
		if(!isset($bookid) || !isset($cid))
			redirect('books');
		if($this->session->userdata('user') == false)
    		redirect('usercenter/login');
    	
    	$this->load->model('book_model');
		$this->load->model('catalog_model');
		$this->load->model('body_model');
		
		$data['title'] = '修改申请 - Writing in Group';
		$data['login_user'] = $this->session->userdata('user');
    	
    	$data['bookid'] = $bookid;
    	$data['cid'] = $cid;
    	$data['book'] = $this->book_model->getBooks(array("id"=>$bookid))[0];
		if(!$data['book'])
			redirect('books');	
    	
    	$cata = $this->catalog_model->getCatalog(array("bookid"=>$bookid));
    	
    	$flag = false;
    	foreach($cata as $row){
    		if($row->id == $cid){
    			$flag = true;
    			break;
    		}	
    	}
    	if(!$flag) redirect('books');
    	
    	$data['catalog'] = array();
		if($cata){
		foreach($cata as $row){
			if(!isset($data['catalog'][$row->fid])){
				$data['catalog'][$row->fid] = array();
			}
			array_push($data['catalog'][$row->fid], $row);

		}
		}
    	
    	$data['body'] = $this->body_model->getBody(array('cid'=>$row->id))[0];
    	$this->load->view('header', $data);
    	$this->load->view('sidebar');
    	$this->load->view('pullrequest');
    	$this->load->view('footer');
	}
}
