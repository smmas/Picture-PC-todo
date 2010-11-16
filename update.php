<?php
	require_once('../../include/simplepie.inc');
	// CHANGE THE FEED ADDRESS BELOW - THAT'S IT!
	$feed = new SimplePie(array(
		'<INSERT REMEMBER THE MILK RSS URL HERE>',
		
		));
	
	$feed->strip_attributes(false);
	
	$feed->set_item_limit(8);
	
	$feed->init();
	
	$feed->handle_content_type();
?>
<div id="logo"></div>
<?php if ($feed->error): ?>
<p><?php echo $feed->error; ?></p>
<?php endif; ?>
<div id="notes">
<?php foreach ($feed->get_items() as $item): ?>
 
    <div class="note style-<?php echo rand(0, 9); ?>">
	
	<?php
		$des = explode('<div', strip_tags($item->get_description(), '<div>'));
		$due = strip_tags("<div" . $des[1]);
		$priority = strip_tags("<div" . $des[2]);
		$time = strip_tags("<div" . $des[3]);
		$tags = strip_tags("<div" . $des[4]);
		$location = strip_tags("<div" . $des[5]);
		$postponed =  strip_tags("<div" . $des[6]);
		unset($des[0]);
		unset($des[1]);
		unset($des[2]);
		unset($des[3]);
		unset($des[4]);
		unset($des[5]);
		unset($des[6]);
		$notes = $des;
		foreach($notes as $key => $note) {
			$notess .= "<div" . $note;
		}
	?>
     
    	<div class="note-text">
    		<div class="rtm_task_title priority-<?php echo substr("$priority", -1); ?>"><?php echo $item->get_title(); ?></div>
    		<h4><?php if ( $due != 'Due: never' ) echo $due; ?></h4>
			<h4><?php if ( $time != 'Time estimate: none' ) echo $time; ?>
			<h4><?php if ( $tags != 'Tags: none' ) echo $tags; ?></h4>
			<h4><?php if ( $location != 'Location: none' ) echo $location; ?></h4>
			<h4><?php if ( $postponed != 'Postponed: never' ) echo $postponed; ?></h4>
			<h4><?php echo $notess; ?></h4>
			<?php unset($notess); ?>
    	</div>
    </div>
 
<?php endforeach; ?>
		
</div>