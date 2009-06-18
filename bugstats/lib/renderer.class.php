<?php

/**
 * Renderer!
 * Helper for HTML and display goodies
 */
class Renderer {
    public $project;
    
    /**
     * Saves a reference to the project
     */
    public function __construct(&$project) {
        $this->project =& $project;
    }
    
    /**
     * Creates a grid of user boxes
     * @TODO h8ers will h8 on my <table>
     */
    public function userGrid($users, $columns = 3) {
        echo '<div class="user-grid-'.$columns.'">';
       
        foreach ($users as $user) {
            $this->userBox($user);
        }
        echo "</div>";
    }
    
    /**
     * Creates a user box
     */
    public function userBox($user) {
        // Classes are used for highlighting
        echo '<div id="'.$user['id'].'" class="user-box';
        if (!empty($user['assignedBugs']['bugsOpen']))
            echo ' bugsOpen';
        if (!empty($user['assignedBugs']['bugsOpenAwaitingReview']))
            echo ' bugsOpenAwaitingReview';
        if (!empty($user['assignedBugs']['bugsOpenReviewedPlus']))
            echo ' bugsOpenReviewedPlus';
        if (!empty($user['assignedBugs']['bugsFixed']))
            echo ' bugsFixed';
        if (!empty($user['otherBugs']['reviewRequests']))
            echo ' reviewRequests';
        echo '">';
        echo "<div>";

            echo '<span class="pie">'.count($user['assignedBugs']['bugsOpen']).','.count($user['assignedBugs']['bugsFixed']).'</span>';
            
            echo '<h4><a href="mailto:'.$user['email'].'">'.$user['name'].'</a></h4>';
            
            echo '<ul>';
                if (!empty($user['assignedBugs']['bugsOpen'])) {
                    echo '<li class="open bugcount">'.$this->bugLink($user['assignedBugs']['bugsOpen'], '%s <span>OPEN</span> bugs', '1 <span>OPEN</span> bug').'</li>';
                }
                
                if (!empty($user['assignedBugs']['bugsOpenAwaitingReview'])) {
                    echo '<li class="indented">'.$this->bugLink($user['assignedBugs']['bugsOpenAwaitingReview'], '%s patches awaiting review',  '1 patch awaiting review').'</li>';
                }
                
                if (!empty($user['assignedBugs']['bugsOpenReviewedPlus'])) {
                    echo '<li class="indented">'.$this->bugLink($user['assignedBugs']['bugsOpenReviewedPlus'], "%s patches r+'d", "1 patch r+'d").'</li>';
                }
                
                if (!empty($user['otherBugs']['reviewRequests'])) {
                    echo '<li class="indented">'.$this->bugLink($user['otherBugs']['reviewRequests'], '%s review requests', '1 review request').'</li>';
                }
                
                if (!empty($user['assignedBugs']['bugsFixed'])) {
                    echo '<li class="fixed bugcount">'.$this->bugLink($user['assignedBugs']['bugsFixed'], '%s <span>FIXED</span> bugs', '1 <span>FIXED</span> bug').'</li>';
                }
                
            echo '</ul>';
        echo '</div></div>';
        
        echo '<div class="tooltip">';
            echo '<img class="avatar"  src="http://www.gravatar.com/avatar/'.md5($user['email']).'?s=50&amp;d=http://moxie.fligtar.com/images/blank.png" alt="avatar for '.$user['email'].'"/>';
            echo '<h5>Additional Details</h5>';
            echo '<ul>';
            
            if (!empty($user['patches']['patchesUploaded'])) {
                echo '<li>'.$this->bugLink($user['patches']['patchesUploaded'], '%s patches uploaded', '1 patch uploaded').'</li>';

                echo '<li class="indented">';
                if (!empty($user['patches']['patchesUploadedPlus']))
                    echo $this->bugLink($user['patches']['patchesUploadedPlus'], "%s r+'d");
                if (!empty($user['patches']['patchesUploadedMinus']))
                    echo $this->bugLink($user['patches']['patchesUploadedMinus'], "%s r-'d");
                if (!empty($user['patches']['patchesUploadedRequested']))
                    echo $this->bugLink($user['patches']['patchesUploadedRequested'], "%s r?'d");
                echo '</li>';
            }
            
            if (!empty($user['patches']['patchesReviewed'])) {
                echo '<li>'.$this->bugLink($user['patches']['patchesReviewed'], '%s patches reviewed', '1 patch reviewed').'</li>';

                echo '<li class="indented">';
                if (!empty($user['patches']['patchesReviewedPlus']))
                    echo $this->bugLink($user['patches']['patchesReviewedPlus'], "%s r+'d");
                if (!empty($user['patches']['patchesReviewedMinus']))
                    echo $this->bugLink($user['patches']['patchesReviewedMinus'], "%s r-'d");
                if (!empty($user['patches']['patchesReviewRequested']))
                    echo $this->bugLink($user['patches']['patchesReviewRequested'], "%s r?'d");
                echo '</li>';
            }
            
            if (!empty($user['otherBugs']['bugsFiled'])) {
                echo '<li>'.$this->bugLink($user['otherBugs']['bugsFiled'], '%s bugs filed', '1 bug filed').'</li>';
            }
            
            echo '</ul>';
        echo '</div>';
    }
    
    /**
     * Creates a link to a bug or bugs
     * Plural and singular strings can have one %s to
     * be replaed with the bug count
     */
    public function bugLink($bugs, $plural, $singular = '') {
        if (empty($singular)) $singular = $plural;
        
        $str = '<a target="_blank" href="'.$this->project->queryBase;
        
        if (count($bugs) == 1) {
            $str .= 'show_bug.cgi?id='.$bugs[0].'" title="bug '.$bugs[0].'">'.sprintf($singular, '1');
        }
        elseif (empty($bugs)) {
            return sprintf($plural, '0');
        }
        else {
            $str .= 'buglist.cgi?bug_id='.implode($bugs, ',').'" title="bugs '.implode($bugs, ', ').'">'.sprintf($plural, count($bugs));
        }
        
        $str .= '</a>';
        
        return $str;
    }
    
    /**
     * Creates a <select> box with available projects
     */
    public function projectSelectionBox($projects) {
        echo '<select id="project-selector" onchange="selectProject();">';
            echo '<option value="">select a report</option>';
            foreach ($projects as $projectName => $project) {
				echo '<optgroup label="'.$project['projectDisplayName'].'">';
				foreach ($project['reports'] as $reportID => $reportDetails) {
                	echo '<option value="'.$projectName.'/'.$reportDetails['reportName'].'">'.$reportDetails['reportDisplayName'].'</option>';
				}
				echo '</optgroup>';
            }
        echo '</select>';
    }
	
	/**
	 * Returns the current page's URL
	 */
	public function currentURL() {
		return $_SERVER['REQUEST_URI'];
	}
    
}

?>