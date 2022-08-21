<?php

namespace App\Http\Controllers\Tenant;
use App\Http\Controllers\Controller;
use \FileUploader;

class UploadController extends Controller
{
    // Return all Banners
    public function submit()
    {
        $field = 'files';
		$uploadDir = getStoragerImagePath("catalog");
		
		// initialize FileUploader
		$FileUploader = new FileUploader($field, array(
			'limit' => 100,
			'fileMaxSize' => 100,
			'extensions' => null,
			'uploadDir' => $uploadDir,
			'title' => 'name'
		));
		
		// upload
		$upload = $FileUploader->upload();
		if ($upload['isSuccess']) {
			foreach($upload['files'] as $key=>$item) {
				$upload['files'][$key] = array(
					'extension' => $item['extension'],
					'format' => $item['format'],
					'file' => $uploadDir . $item['name'],
					'name' => $item['name'],
					'size' => $item['size'],
					'size2' => $item['size2'],
					'title' => $item['title'],
					'type' => $item['type'],
					'url' => asset($uploadDir . $item['name'])
				);
			}
		}
		
		echo json_encode($upload);
		exit;
    }

   
    public function removeFile()
    {
        unlink($_POST['file']);
		exit;
    }

    
}
