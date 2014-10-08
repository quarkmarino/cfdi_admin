<?php
namespace Controllers\Api\V0\Business;

use Controllers\BaseController;
use Factory\Interfaces\UserInterface;

class UsersController extends BaseController{

	protected $user;

	public function __construct(userInterface $user){
  	$this->user = $user;
	}

	/**
	 * Display a listing of the resource.
	 * GET /users
	 *
	 * @return Response
	 */
	public function index(){
		$users = $this->user->findAll();
		return $users->toJson();
	}

	/**
	 * Store a newly created resource in storage.
	 * POST /users
	 *
	 * @return Response
	 */
	public function store(){
		$input = Input::all();
		$user = $this->user->store(\Auth::user()->id, $input);
		return $user->toJson();
	}

	/**
	 * Display the specified resource.
	 * GET /users/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id){
		//
	}

	/**
	 * Update the specified resource in storage.
	 * PUT /users/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id){
		//
	}

	/**
	 * Remove the specified resource from storage.
	 * DELETE /users/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id){
		//
	}

}