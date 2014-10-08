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
		$Contributor = \Models\Contributor::whereId($id)->first();
		if(!$Contributor) throw new NotFoundException('Contributor Not Found');
		return $Contributor;
	}

	public function findByIdActive($id){
		$Contributor = \Models\Contributor::active()->whereId($id)->first();
		if(!$Contributor) throw new NotFoundException('Contributor Not Found');
		return $Contributor;
	}

	public function find($ammount = 4){
		return \Models\Contributor::with('image')
		->orderBy('created_at', 'asc')
		->limit($ammount)
		->get();
	}

	public function findAll(){
		return \Models\Contributor::orderBy('created_at', 'asc')->paginate(15);
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

	public function store($author_id, $data){
		//dd($author_id);
		$data['Contributor_id'] = $author_id;
		$this->validation($data);
		return \Models\Contributor::create($data);
	}

	/**
	 * Finds the the Contributor resource by id, validates the data, the fills the model ands save it
	 * @param integer $id the id of the resource
	 * @param array $data the data with which the model will be filled
	 * @return the updated Contributor model 
	*/

	public function update($id,$data){
		$Contributor = $this->findById($id);
		$this->validation($data);
		$Contributor->fill($data);
		$Contributor->save();
		return $Contributor;
	}

	/**
	 * Finds the the Contributor resource by id and deletes it
	 * @param integer $id the id of the resource
	 * @return the updated Contributor model 
	*/

	public function destroy($id){
		$Contributor = $this->findById($id);
		return $Contributor->delete();
	}

	public function validation($data){
		return $this->validator->validate($data); 
	}

	public function instance($data = array()){
		return new \Models\Contributor($data);
	}
	
}