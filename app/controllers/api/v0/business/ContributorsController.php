<?php
namespace Controllers\Api\V0\Business;

use Controllers\BaseController;
use Factory\Interfaces\ContributorInterface;
use Input;

class ContributorsController extends BaseController {

	protected $contributor;

	public function __construct(ContributorInterface $contributor){
  	$this->contributor = $contributor;
	}

	/**
	 * Display a listing of the resource.
	 * GET /contributors
	 *
	 * @return Response
	 */
	public function index(){
		$contributors = $this->contributor->findAll();
		return $contributors->toJson();
	}

	/**
	 * Store a newly created resource in storage.
	 * POST /contributors
	 *
	 * @return Response
	 */
	public function store(){
		$input = Input::all();
		$contributor = $this->contributor->store(1, $input);
		return $contributor->toJson();
	}

	/**
	 * Display the specified resource.
	 * GET /contributors/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id){
		//
	}

	/**
	 * Show the form for editing the specified resource.
	 * GET /contributors/{id}/edit
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id){
		//
	}

	/**
	 * Update the specified resource in storage.
	 * PUT /contributors/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id){
		//
	}

	/**
	 * Remove the specified resource from storage.
	 * DELETE /contributors/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id){
		//
	}

}