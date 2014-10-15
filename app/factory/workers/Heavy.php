<?php
namespace Factory\Workers;

use File;

class Heavy{

	public function task($job, $data){
		File::append(app_path().'/queue.txt', $data['message'].time().PHP_EOL);
		$job->delete();
	}

}