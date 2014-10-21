<?php

namespace Factory\Interfaces;
 
interface FileInterface {
  public function findById($id);
  //public function findAllWith($with);
  public function findAll();
  public function paginate($limit = null);
  public function store($directory_id = null, $data);
  public function update($is, $data);
  public function destroy($id);
  public function validation($data);
  public function instance();
}