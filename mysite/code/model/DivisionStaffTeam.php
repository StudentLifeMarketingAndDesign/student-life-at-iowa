<?php
class DivisionStaffTeam extends DataObject {

	private static $db = array(
		'Name' => 'Text',
		'SortOrder' => 'Int'
	);

	private static $many_many = array(
		'StaffPages' => 'DivisionStaffPage',
		'StaffHolderPages' => 'DivisionStaffHolderPage'
	);
	
	private static $belongs_many_many = array();
	
	private static $summary_fields = array( 
		'Name' => 'Name',
	);

	private static $default_sort = array(
		'SortOrder'
	);

	public function getCMSFields() {
		$f = parent::getCMSFields();
		
		$f->addFieldToTab('Root.Main', new CheckboxSetField('StaffPages', 'Team <a href="admin/pages/edit/show/14" target="_blank">(Manage Teams)</a>', StaffPage::get()->map('ID', 'Title')));
		return $f;
		
	}

	public function SortedStaffPages(){
		$staffPages = $this->DivisionStaffPages()->sort('Sort');
		$this->extend('alterSortedStaffPages', $staffPages);
		return $staffPages;

	}

}
