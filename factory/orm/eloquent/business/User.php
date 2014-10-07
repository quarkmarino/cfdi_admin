<?php
namespace Repositories\ORM\Eloquent\Business;

use Repositories\Interfaces\UserInterface;
use Repositories\Services\Validators\UserValidator;
use Repositories\Errors\Exceptions\NotFoundException as NotFoundException;
use Authority\Authority as Authority;
use Illuminate\Database\Eloquent\ModelNotFoundException;
 
class User implements UserInterface {

	protected $validator;

	public function __construct(UserValidator $validator){
		$this->validator = $validator;
	}

	public function findById($id){
		$User = \Models\User::whereId($id)->first();
		if(!$User) throw new NotFoundException('User Not Found');
		return $User;
	}

	public function findByIdActive($id){
		$User = \Models\User::active()->whereId($id)->first();
		if(!$User) throw new NotFoundException('User Not Found');
		return $User;
	}

	public function find($ammount = 4){
		return \Models\User::with('image')
		->orderBy('created_at', 'asc')
		->limit($ammount)
		->get();
	}

	public function findAll(){
		return \Models\User::orderBy('created_at', 'asc')->paginate(15);
	}

	public function findAllActive(){
		return \Models\User::active()
		->orderBy('created_at', 'asc')
		->get();
	}

	public function paginate($limit = null){
		return \Models\User::paginate($limit);
	}

	/**
	 * Validates and create the User resource
	 * @param array $data the data with which the model will be populated
	 * @return the created User model
	*/

	public function store($author_id, $data){
		//dd($author_id);
		$data['user_id'] = $author_id;
		$this->validation($data);
		return \Models\User::create($data);
	}

	/**
	 * Finds the the User resource by id, validates the data, the fills the model ands save it
	 * @param integer $id the id of the resource
	 * @param array $data the data with which the model will be filled
	 * @return the updated User model 
	*/

	public function update($id,$data){
		$User = $this->findById($id);
		$this->validation($data);
		$User->fill($data);
		$User->save();
		return $User;
	}

	/**
	 * Finds the the User resource by id and deletes it
	 * @param integer $id the id of the resource
	 * @return the updated User model 
	*/

	public function destroy($id){
		$User = $this->findById($id);
		return $User->delete();
	}

	public function validation($data){
		return $this->validator->validate($data); 
	}

	public function instance($data = array()){
		return new \Models\User($data);
	}
	
}