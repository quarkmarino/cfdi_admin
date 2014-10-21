<?php
namespace Factory\Workers;

use File;
use Log;

class Heavy{

	public function task($job, $data){
		File::append(app_path().'/queue.txt', $data['message'].time().PHP_EOL);
		Log::info("Queues rocks!!");
		$job->delete();
	}

}