<?php
namespace Factory\ORM\Eloquent\Directorysystem;

use Factory\Interfaces\DirectoryInterface;
use Factory\Services\Validators\DirectoryValidator;
use Factory\Errors\Exceptions\NotFoundException as NotFoundException;
use Authority\Authority as Authority;
use Illuminate\Database\Eloquent\ModelNotFoundException;
 
class Directory implements DirectoryInterface {

  protected $validator;

  public function __construct(DirectoryValidator $validator){
    $this->validator = $validator;
  }

  public function findById($id){
    $Directory = \Models\Directory::whereId($id)->first();
    if(!$Directory) throw new NotFoundException('Directory Not Found');
    return $Directory;
  }

  public function findByIdActive($id){
    $Directory = \Models\Directory::active()->whereId($id)->first();
    if(!$Directory) throw new NotFoundException('Directory Not Found');
    return $Directory;
  }

  public function find($ammount = 4){
    return \Models\Directory::with('image')
    ->orderBy('created_at', 'asc')
    ->limit($ammount)
    ->get();
  }

  public function findAll(){
    return \Models\Directory::orderBy('created_at', 'asc')->paginate(15);
  }

  public function findAllActive(){
    return \Models\Directory::active()
    ->orderBy('created_at', 'asc')
    ->get();
  }

  public function paginate($limit = null){
    return \Models\Directory::paginate($limit);
  }

  /**
   * Validates and create the Directory resource
   * @param array $data the data with which the model will be populated
   * @return the created Directory model
  */

  public function store($author_id, $data){
    //dd($author_id);
    $data['Directory_id'] = $author_id;
    $this->validation($data);
    return \Models\Directory::create($data);
  }

  /**
   * Finds the the Directory resource by id, validates the data, the fills the model ands save it
   * @param integer $id the id of the resource
   * @param array $data the data with which the model will be filled
   * @return the updated Directory model 
  */

  public function update($id,$data){
    $Directory = $this->findById($id);
    $this->validation($data);
    $Directory->fill($data);
    $Directory->save();
    return $Directory;
  }

  /**
   * Finds the the Directory resource by id and deletes it
   * @param integer $id the id of the resource
   * @return the updated Directory model 
  */

  public function destroy($id){
    $Directory = $this->findById($id);
    return $Directory->delete();
  }

  public function validation($data){
    return $this->validator->validate($data); 
  }

  public function instance($data = array()){
    return new \Models\Directory($data);
  }
  
}