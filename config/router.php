<?php
    // $init->Auth('admin', '../');

	if(!isset($url) || empty($url))
	{
		$init->view('index');
	}else{
		$url = rtrim($_GET['url'], '/');
        $url = filter_var($url, FILTER_SANITIZE_URL);
		// echo $url.'<br>'.$page;
		if(file_exists('public/'.$url.'.php'))
		{
			$uri = $url;
			$init->view($url);
		}
		elseif(file_exists('public/'.$url.'/index.php')){	
			$uri = $url;
			$init->navigate(BASE_URL.$url.'/index');
		}
		else{
			$url = explode('/', $url);
			$urlLen = count($url);
			// echo $urlLen;
			if($urlLen == 2){
				if(file_exists('public/'.$url[0].'.php')){
					$uri = $url[1];
					$init->view($url[0]);
				}elseif(file_exists('public/'.$url[0].'/'.$url[1].'.php')){
					$init->view($url[0].'/'.$url[1]);
				}else{
					$init->navigate('404');
				}
			}
			elseif($urlLen > 2){
				if(file_exists('public/'.$url[0].'.php')){
					$uri = $url[1];
					$uri2 = $url[2];
					$uri3 = isset($url[3])?$url[3]:'';
					$uri4 = isset($url[4])?$url[4]:'';
					$init->view($url[0]);
				}
				elseif(file_exists('public/'.$url[0].'/'.$url[1].'.php')){
					$uri = $url[2];
					$uri2 = isset($url[3])?$url[3]:'';
					$uri3 = isset($url[4])?$url[4]:'';
					$init->view($url[0].'/'.$url[1]);
				}
				elseif(file_exists('public/'.$url[0].'/'.$url[1].'/'.$url[2].'.php')){
					$uri = $url[3];
					$uri2 = isset($url[4])?$url[4]:'';
					$init->view($url[0].'/'.$url[1].'/'.$url[2]);
				}else{
					// $init->view('404');
					$init->navigate('404');
				}
			}else{
				// $init->view('404');
				$init->navigate('404');
			}
		}

		
	}
?>