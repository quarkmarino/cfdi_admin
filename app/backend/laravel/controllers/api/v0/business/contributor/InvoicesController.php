<?php
namespace Controllers\Api\V0\Business\Contributor;

use Controllers\BaseController;
use Factory\Interfaces\ContributorInterface;
use Factory\Interfaces\InvoiceInterface;
use Input;

class InvoicesController extends BaseController{

	protected $contributor;
	protected $invoice;

	public function __construct(ContributorInterface $contributor, InvoiceInterface $invoice){
  	$this->contributor = $contributor;
  	$this->invoice = $invoice;
	}

	/**
	 * Display a listing of the resource.
	 * GET /businessinvoices
	 *
	 * @return Response
	 */
	public function index($contributor_id){
		$contributor = $this->contributor->findById($contributor_id);
		$invoices = $this->invoice->findAllInContributor($contributor_id);
		return $invoices->toJson();
	}

	/**
	 * Store a newly created resource in storage.
	 * POST /contributors
	 *
	 * @return Response
	 */
	public function store(){
		
		return $contributor->toJson();
	}

	/**
	 * Display the specified resource.
	 * GET /businessinvoices/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id){
		$invoice = $this->invoice->findById($id);
		return $invoice->toJson();
	}

}