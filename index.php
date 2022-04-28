<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Personal Donation Fund</title>
    <style type="text/css">
        body {
            margin: 0;
            padding: 0;
            font: 100% Verdana, Arial, Helvetica, sans-serif;
            font-size: 14px;
        }
	.tamilrokers {
            border: 1px #ccc solid;
            max-width: 600px;
            margin: 0 auto;
            padding: 40px;
            text-align: center;
        }
        .tamilrokers .tamilrokers-nav {
            margin-bottom: 40px;
        }
        
        .tamilrokers .tamilrokers-nav a:first-child {
            margin-right: 10px;
        }
        .tamilrokers .tamilrokers-nav a:last-child {
            margin-left: 10px;
        }
        .tamilrokers .tamilrokers-image img {
            max-width: 100%;
            height: auto;
        }
        .tamilrokers .tamilrokers-image-label {
            color: #777;
        }
	a {
            color: #333;
        }
	a:hover {
            color: #cc0000;
        }
	.sp {
            padding-right: 40px;
        }
    </style>
	
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
</head>

<body>
    <div class="tamilrokers">
	

		
		<form action="https://www.paypal.com/donate" method="post" target="_top">
		<input type="hidden" name="business" value="************" />
		<input type="hidden" name="no_recurring" value="0" />
		<input type="hidden" name="currency_code" value="USD" />
		<input type="image" src="https://www.paypalobjects.com/en_US/i/btn/btn_donateCC_LG.gif" border="0" name="submit" title="Click to Donate with Paypal or Credit card" alt="Donate with PayPal button" />
		<img alt="" border="0" src="https://www.paypal.com/en_US/i/scr/pixel.gif" width="1" height="1" />
		</form>
		
		<span style="white-space: pre-line">@Model.CommentText</span>
		
		
		Introduce yourself
		List why you need donations, 
		how much, 
		and whom they are for			

		
	
    </div>
	
	<?php
	/*
		PHP image galleries - auto version - PHP > 5.0
	*/
	
	// set session name for galleries "cookie"
	define('SS_SESSNAME', 'galleries_sess');
	
	$err = '';
	
	session_name(SS_SESSNAME);
	session_start();
	// init galleries class
	$ss = new galleries($err);
	
	$ss->get_images();
	
	list($is_active, $img_cpt_name, $first, $prev, $next, $last) = $ss->run();
	/*
		galleries class, can be used stand-alone
	*/
	class galleries
	{
		private $gallerise_array = NULL;
		private $err = NULL;
	
		public function __construct(&$err)
		{
			$this->gallerise_array = array();
			$this->err = $err;
		}
		public function get_images()
		{
			if (isset($_SESSION['imgarr']))
			{
					$this->gallerise_array = $_SESSION['imgarr'];
			}
			else
			{
				if ($dh = opendir(""))
				{
					while (false !== ($file = readdir($dh)))
					{
						if (preg_match('/^.*\.(jpg|jpeg|gif|png)$/i', $file))
						{
							$this->gallerise_array[] = $file;
						}
					}
					closedir($dh);
				}
				$_SESSION['imgarr'] = $this->gallerise_array;
			}
		}
		public function run()
		{
			$is_active = 1;
			$last = count($this->gallerise_array);
			if (isset($_GET['img']))
			{
				if (preg_match('/^[0-9]+$/', $_GET['img'])) $is_active = (int)  $_GET['img'];
				if ($is_active <= 0 || $is_active > $last) $is_active = 1;
			}
			if ($is_active <= 1)
			{
				$prev = $is_active;
				$next = $is_active + 1;
			}
			else if ($is_active >= $last)
			{
				$prev = $last - 1;
				$next = $last;
			}
			else
			{
				$prev = $is_active - 1;
				$next = $is_active + 1;
			}
			// line below sets the img_cpt_name name...
			$img_cpt_name = str_replace('-', ' ', $this->gallerise_array[$is_active - 1]);
			$img_cpt_name = str_replace('_', ' ', $img_cpt_name);
			$img_cpt_name = preg_replace('/\.(jpe?g|gif|png)$/i', '', $img_cpt_name);
			$img_cpt_name = ucfirst($img_cpt_name);
			return array($this->gallerise_array[$is_active - 1], $img_cpt_name, 1, $prev, $next, $last);
		}
	}
	?>

	
	<div class="tamilrokers-nav">
        <a href="?img=<?=$first;?>">First</a>
        <a href="?img=<?=$prev;?>">Previous</a>
        <span class="sp"></span>
        <a href="?img=<?=$next;?>">Next</a>
        <a href="?img=<?=$last;?>">Last</a>
    </div>
    <div class="tamilrokers-image">
        <img src="<?=$img_cpt_name;?>" alt="" />
    </div>
    <p class="tamilrokers-image-label"><?=$img_cpt_name;?></p>
	
</body>
</html>
