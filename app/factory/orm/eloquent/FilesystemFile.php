<?php
namespace Factory\ORM\Eloquent\Filesystem;

use Factory\Interfaces\FileInterface;
use Factory\Services\Validators\FileValidator;
use Factory\Errors\Exceptions\NotFoundException as NotFoundException;
use Authority\Authority as Authority;
use Illuminate\Database\Eloquent\ModelNotFoundException;
 
class File implements FileInterface {

  protected $validator;

  public function __construct(FileValidator $validator){
    $this->validator = $validator;
  }

  public function findById($id){
    $File = \Models\File::whereId($id)->first();
    if(!$File) throw new NotFoundException('File Not Found');
    return $File;
  }

  public function findByIdActive($id){
    $File = \Models\File::active()->whereId($id)->first();
    if(!$File) throw new NotFoundException('File Not Found');
    return $File;
  }

  public function find($ammount = 4){
    return \Models\File::with('image')
    ->orderBy('created_at', 'asc')
    ->limit($ammount)
    ->get();
  }

  public function findAll(){
    return \Models\File::orderBy('created_at', 'asc')->paginate(15);
  }

  public function findAllActive(){
    return \Models\File::active()
    ->orderBy('created_at', 'asc')
    ->get();
  }

  public function paginate($limit = null){
    return \Models\File::paginate($limit);
  }

  /**
   * Validates and create the File resource
   * @param array $data the data with which the model will be populated
   * @return the created File model
  */

  public function store($author_id, $data){
    //dd($author_id);
    $data['File_id'] = $author_id;
    $this->validation($data);
    return \Models\File::create($data);
  }

  /**
   * Finds the the File resource by id, validates the data, the fills the model ands save it
   * @param integer $id the id of the resource
   * @param array $data the data with which the model will be filled
   * @return the updated File model 
  */

  public function update($id,$data){
    $File = $this->findById($id);
    $this->validation($data);
    $File->fill($data);
    $File->save();
    return $File;
  }

  /**
   * Finds the the File resource by id and deletes it
   * @param integer $id the id of the resource
   * @return the updated File model 
  */

  public function destroy($id){
    $File = $this->findById($id);
    return $File->delete();
  }

  public function validation($data){
    return $this->validator->validate($data); 
  }

  public function instance($data = array()){
    return new \Models\File($data);
  }
  
}