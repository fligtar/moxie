<?php

require_once dirname(dirname(dirname(__FILE__))).'/project.inc.php';

/**
 * Report configuration file
 * Must extend project class
 */
class gecko191blockers extends gecko {
    // Short name for report
    public $reportName = '1.9.1-blockers';
    
    // Pretty name to display for report
    public $reportDisplayName = '1.9.1 Blockers';
    
    // Bugzilla query for the report
    public $queryString = 'buglist.cgi?query_format=advanced&short_desc_type=allwordssubstr&short_desc=&long_desc_type=allwordssubstr&long_desc=&bug_file_loc_type=allwordssubstr&bug_file_loc=&status_whiteboard_type=allwordssubstr&status_whiteboard=&keywords_type=allwords&keywords=&emailtype1=substring&email1=&emailtype2=substring&email2=&bugidtype=include&bug_id=&votes=&chfieldfrom=&chfieldto=Now&chfieldvalue=&cmdtype=doit&order=Reuse+same+sort+as+last+time&known_name=blocking1.9.1%2B&query_based_on=blocking1.9.1%2B&negate0=1&field0-0-0=component&type0-0-0=equals&value0-0-0=Autocomplete+&field0-0-1=component&type0-0-1=equals&value0-0-1=Download+Manager&field0-0-2=component&type0-0-2=equals&value0-0-2=Help+Viewer&field0-0-3=component&type0-0-3=equals&value0-0-3=NSIS+Installer&field0-0-4=component&type0-0-4=equals&value0-0-4=Preferences&field0-0-5=component&type0-0-5=equals&value0-0-5=Printing&field0-0-6=component&type0-0-6=equals&value0-0-6=Toolbars+and+Toolbar+Customization&field0-0-7=component&type0-0-7=equals&value0-0-7=Satchel&field0-1-0=product&type0-1-0=equals&value0-1-0=Toolkit&field1-0-0=flagtypes.name&type1-0-0=equals&value1-0-0=blocking1.9.1%2B';
}

?>
