<?php

use SilverStripe\Forms\CheckboxSetField;
use SilverStripe\ORM\DataObject;
class DivisionStaffTeam extends DataObject {

	private static $db = array(
		'Name' => 'Text',
		'SortOrder' => 'Int'
	);

	private static $many_many = array(
		'DepartmentPages' => 'DepartmentPage',
		'StaffPages' => 'DivisionStaffPage',
		'StaffHolderPages' => 'DivisionStaffHolderPage'
	);
		
	private static $summary_fields = array( 
		'Name' => 'Name',
	);

	private static $default_sort = array(
		'SortOrder'
	);

	public function getCMSFields() {
		$f = parent::getCMSFields();
		
		$f->addFieldToTab('Root.Main', new CheckboxSetField('StaffPages', 'Team <a href="admin/pages/edit/show/14" target="_blank">(Manage Teams)</a>', DivisionStaffPage::get()->map('ID', 'Title')));
		return $f;
		
	}

	public function SortedStaffPages(){
		$staffPages = $this->StaffPages()->sort('Sort');
		$this->extend('alterSortedStaffPages', $staffPages);
		return $staffPages;

	}

	public function toStaffFeedArray(){
		$team = $this->owner;
		$teamArray = array();

		$teamStaff = $team->StaffPages();
		$teamStaffArray = array();

		foreach($teamStaff as $staff){
			$teamStaffSingleArray = array(
				'ID' => $staff->ID,
				'Position' => $staff->Position,
				'FirstName' => $staff->FirstName,
				'LastName' => $staff->LastName,
				'EmailAddress' => $staff->EmailAddress,
				'URLSegment' => $staff->URLSegment,
				'Phone' => $staff->Phone,
				'DepartmentName' => $staff->DepartmentName,
				'DepartmentURL' => $staff->DepartmentURL,
				'PhotoURL' => $staff->Photo
			);
			array_push($teamStaffArray, $teamStaffSingleArray);
		}

		$staffArrayItem = array(
				'StudentLifeID' => $team->ID,
				'Title' => $team->Title,
				'ID' => $team->ID,
				'Content' => $team->Content,
				'URLSegment' => $team->URLSegment,
				'Staff' => $teamStaffArray,
				'ExternalURL' => $team->ExternalURL
		);

		return $staffArrayItem;
	}

}