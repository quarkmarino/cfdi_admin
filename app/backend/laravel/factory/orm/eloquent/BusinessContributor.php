<?php
namespace Factory\ORM\Eloquent;

use Factory\Interfaces\ContributorInterface;
use Factory\Services\Validators\ContributorValidator;
use Factory\Errors\Exceptions\NotFoundException as NotFoundException;
use Authority\Authority as Authority;
use Illuminate\Database\Eloquent\ModelNotFoundException;
 
class Contributor implements ContributorInterface {

	protected $validator;

	public function __construct(ContributorValidator $validator){
		$this->validator = $validator;
	}

	public function findById($id){
		$contributor = \Models\Contributor::whereId($id)->first();
		if(!$contributor) throw new NotFoundException('Contributor Not Found');
		return $contributor;
	}

	public function findByIdActive($id){
		$contributor = \Models\Contributor::active()->whereId($id)->first();
		if(!$contributor) throw new NotFoundException('Contributor Not Found');
		return $contributor;
	}

	public function find($ammount = 4){
		return \Models\Contributor::with('image')
		->orderBy('created_at', 'asc')
		->limit($ammount)
		->get();
	}

	public function findAll(){
		return \Models\Contributor::orderBy('created_at', 'asc')->get();//->paginate(15);
	}

	public function findAllActive(){
		return \Models\Contributor::active()
		->orderBy('created_at', 'asc')
		->get();
	}

	public function paginate($limit = null){
		return \Models\Contributor::paginate($limit);
	}

	/**
	 * Validates and create the Contributor resource
	 * @param array $data the data with which the model will be populated
	 * @return the created Contributor model
	*/

	public function store($owner_id, $data){
		$contributor = new \Models\Contributor;
		$contributor->user_id = $owner_id;

		$this->validation($data);
		$contributor->fill($data);
		$contributor->save($data);
		return $contributor;
		//return \Models\Contributor::create($data);
	}

	/**
	 * Finds the the Contributor resource by id, validates the data, the fills the model ands save it
	 * @param integer $id the id of the resource
	 * @param array $data the data with which the model will be filled
	 * @return the updated Contributor model 
	*/

	public function update($id = 1, $data){
		$contributor = $this->findById($id);
		$this->validation($data);

		$contributor->fill($data);
		$contributor->save();
		return $contributor;
	}

	/**
	 * Finds the the Contributor resource by id and deletes it
	 * @param integer $id the id of the resource
	 * @return the updated Contributor model 
	*/

	public function destroy($id){
		$contributor = $this->findById($id);
		return $contributor->delete();
	}

	public function validation($data){
		return $this->validator->validate($data);
	}

	public function instance($data = array()){
		return new \Models\Contributor($data);
	}
	
}