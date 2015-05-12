<?php defined('KOOWA') or die ?>

<?php
$subject = is_array($subject) ? array_shift($subject) : $subject;
$target_to_show = null;

if(isset($item->object) && !is_array($item->target) && !$item->target->eql($item->subject))
	$target_to_show = $item->target;
?>

<div class="an-story an-entity">
	<div class="clearfix">
	    <div class="entity-portrait-square">
	        <?= @avatar($subject) ?>
	    </div>     
    
    	<div class="entity-container">
    		<?php if(!empty($title)): ?>
    		<h4 class="story-title">
    			<?= $title ?>
    		</h4>
    		<?php else: ?>
    		<h4 class="author-name">
    			<?= @name($subject) ?>
    		</h4>
    		<?php endif; ?>
    	</div>
    </div>
    
    <?php if(!empty($body)) : ?>
    <div class="story-body">
    	<?= $body ?>
    </div>
    <?php endif; ?>
         
    <?php
    $votable_item = null;               
        
    if(!$item->aggregated() && $item->object && $item->object->isVotable())
    	$votable_item = $item->object;
    ?>
        
    <div class="entity-meta">
        <ul class="inline">
            <?php if( $target_to_show ): ?>
            <li>
                <a href="<?= @route($target_to_show->getURL()) ?>"><?= @name($target_to_show) ?></a>
            </li>
            <?php endif; ?>
            
            <li>
                <?= @date($timestamp) ?> 
            </li>
            
            <?php if($votable_item): ?> 
    	    <li class="vote-count-wrapper" id="vote-count-wrapper-<?= $votable_item->id ?>">
            <?= @helper('ui.voters', $votable_item); ?>
    	     </li>
    	     <?php endif; ?>
	     </ul>
   	</div>
        
    <div class="entity-actions">    
    	<?php $can_comment = $commands->offsetExists('comment'); ?>
        <?= @helper('ui.commands', $commands)?>
    </div>      
   
	<?php if(!empty($comments) || $can_comment) : ?>
    <?= @helper('ui.comments', $item->object, array('comments'=>$comments, 'can_comment'=>$can_comment, 'content_filter_exclude' => array('gist'), 'pagination'=>false, 'show_guest_prompt'=>false, 'truncate_body'=>array('length'=>220, 'consider_html'=>true, 'read_more'=>true))) ?>
    <?php endif;?>
    
    <?php if(!empty($comments) && $can_comment): ?>
    <div class="comment-overtext-box">  
    	<a class="action-comment-overtext" storyid="<?= $item->id ?>" href="<?= @route($item->object->getURL()) ?>">
        	<?= @text('COM-STORIES-ADD-A-COMMENT') ?>
        </a>
    </div>
    <?php endif; ?>
</div>