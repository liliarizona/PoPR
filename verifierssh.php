<?php
include('Net/SSH2.php');
$numsplits=1000;
$numsymbols=100;

$label=$argv[1];
$size=$argv[2];


$maindrivedir="/home/ece420/Documents/pysicalreliability/files_".$size."b/";
$seconddrivedir="/media/ece420/移动硬盘/research/files_".$size."b/";

echo "connected.\n";


for($i=0;$i<101;$i++)
{
	$ssh = new Net_SSH2('150.135.222.177');
	if (!$ssh->login('ece420', 'admin')) {
		exit('Login Failed');
	}
	$ssh->setTimeout(20);
	
	$ssh->write("sync && echo 3 | sudo tee /proc/sys/vm/drop_caches\n");
	$output = $ssh->read('#[pP]assword[^:]*:|ece420@ece420:~\$#', NET_SSH2_READ_REGEX);
	$ssh->write("admin\n");
	
	$ssh->exec("php /media/ece420/Kingston_SSD_120/research/pprsimu.php clearcache");
	sleep(2);
	$time_start = microtime(true);
	$output=$ssh->exec("php /media/ece420/Kingston_SSD_120/research/pprsimu.php sshserial /media/ece420/Kingston_SSD_120/research/sshtest.txt 16000 ssd");
	//echo $ssh->exec("php /media/ece420/Kingston_SSD_120/research/pprsimu.php sshpara /media/ece420/Kingston_SSD_120/research/sshparatest.txt 200 100","php -v");
	$time_end = microtime(true);
	$time = $time_end - $time_start; #in sec
	echo $output;
	echo $time."\n";	
}

?>