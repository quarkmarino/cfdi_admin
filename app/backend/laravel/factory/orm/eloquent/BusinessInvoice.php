<?php
namespace Factory\ORM\Eloquent;

use Factory\Interfaces\InvoiceInterface;
use Factory\Services\Validators\InvoiceValidator;
use Factory\Errors\Exceptions\NotFoundException as NotFoundException;
use Authority\Authority as Authority;
use Illuminate\Database\Eloquent\ModelNotFoundException;
 
class Invoice implements InvoiceInterface {

	protected $validator;

	public function __construct(InvoiceValidator $validator){
		$this->validator = $validator;
	}

	public function findById($id){
		$Invoice = \Models\Invoice::whereId($id)->first();
		if(!$Invoice) throw new NotFoundException('Invoice Not Found');
		return $Invoice;
	}

	public function findByIdActive($id){
		$Invoice = \Models\Invoice::active()->whereId($id)->first();
		if(!$Invoice) throw new NotFoundException('Invoice Not Found');
		return $Invoice;
	}

	public function find($ammount = 4){
		return \Models\Invoice::with('image')
		->orderBy('created_at', 'asc')
		->limit($ammount)
		->get();
	}

	public function findAll(){
		return \Models\Invoice::orderBy('created_at', 'asc')
		->paginate(15);
	}

	public function findAllActive(){
		return \Models\Invoice::active()
		->orderBy('created_at', 'asc')
		->get();
	}

	public function findAllInContributor($contributor_id){
    return \Models\Invoice::where('receiver_id', $contributor_id)->orWhere('issuer_id', $contributor_id)
    ->orderBy('created_at', 'asc')->get();
    //->paginate(15);
  }

	public function paginate($limit = null){
		return \Models\Invoice::paginate($limit);
	}

	/**
	 * Validates and create the Invoice resource
	 * @param array $data the data with which the model will be populated
	 * @return the created Invoice model
	*/

	public function store($author_id, $data){
		//dd($author_id);
		$data['Invoice_id'] = $author_id;
		$this->validation($data);
		return \Models\Invoice::create($data);
	}

	/**
	 * Finds the the Invoice resource by id, validates the data, the fills the model ands save it
	 * @param integer $id the id of the resource
	 * @param array $data the data with which the model will be filled
	 * @return the updated Invoice model 
	*/

	public function update($id,$data){
		$Invoice = $this->findById($id);
		$this->validation($data);
		$Invoice->fill($data);
		$Invoice->save();
		return $Invoice;
	}

	/**
	 * Finds the the Invoice resource by id and deletes it
	 * @param integer $id the id of the resource
	 * @return the updated Invoice model 
	*/

	public function destroy($id){
		$Invoice = $this->findById($id);
		return $Invoice->delete();
	}

	public function validation($data){
		return $this->validator->validate($data); 
	}

	public function instance($data = array()){
		return new \Models\Invoice($data);
	}
	
}