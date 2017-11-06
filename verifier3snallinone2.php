<?php
include('Net/SSH2.php');
$numsplits=1000;
$numsymbols=100;

$label=$argv[1];
$size=$argv[2];


$rpt1=50;
$rpt2=6050;

$sn=array(
	0 => 'ssd',
	1 => 'sea',
	2 => 'song'
	);
# adv storage all on ssd, chal 3 disks at a time, p=1/2
$numchal=0;
$nummiss=0;
$numdetect=0;
$results=array();
$index=0;
for($i=0;$i<18001;$i++)
{
	for($j=0;$j<2;$j++)
	{
		if($j==0) #sec 1 sec 2
		{
			//echo "0\n";
			$rd=rand(0,1);
			$results[$index]=$rd;
		}
		else
		{
			$rd=rand(0,1);
			$results[$index]=$rd;
		}
		$index=$index+1;
	}
}

echo count($results)."\t".(count($results)-array_sum($results))."\t".array_sum($results)."\n";

for($i=1;$i<=8;$i++)
{
	$nc=2*$i;
	$numtotaltest=0;
	$nummiss=0;
	$numdetect=0;
	for($j=0;$j<300;$j++)
	{
		$fail=0;
		for($k=1;$k<=$nc;$k++)
		{
			if($results[$j*$nc+$k]>0)
			{
				$fail=1;
			}
		}
		if($fail)
		{
			$numdetect=$numdetect+1;
		}
		else
		{
			$nummiss=$nummiss+1;
		}
		$numtotaltest=$numtotaltest+1;
	}
	echo $numtotaltest."\t".$nummiss."\t".$numdetect."\n";
	//exit;
	
}


?>