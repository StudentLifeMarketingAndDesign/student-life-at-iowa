<?php

use SilverStripe\CMS\Model\VirtualPage;
use SilverStripe\UserForms\Model\UserDefinedForm;
use SilverStripe\Forms\CheckboxSetField;
use SilverStripe\Forms\GridField\GridFieldConfig_RecordEditor;
use SilverStripe\Forms\GridField\GridField;
use SilverStripe\Forms\CheckboxField;
use SilverStripe\Forms\DropdownField;
use UndefinedOffset\SortableGridField\Forms\GridFieldSortableRows;

class DivisionStaffHolderPage extends Page {

	private static $db = array(
		'SortLastName' => 'Boolean',
		'HideLinksToStaffPages' => 'Boolean',
		'PhotoOrientation' => 'Enum(array("Landscape","Portrait"), "Landscape")'
	);

	private static $defaults = array(
		'PhotoOrientation' => 'Landscape'
	);

	private static $has_one = array(

	);

	private static $belongs_many_many = array(
		'Teams' => 'DivisionStaffTeam',
	);
	private static $layout_types = array(
		'MainImage' => 'Big Full Width Image',
		'BackgroundImage' => 'Background Image',
		'ImageSlider' => 'Image Slider',
		'BackgroundVideo' => 'Background Video',
		'StaffTable' => 'Staff Table View'
	);

	private static $allowed_children = array('DivisionStaffPage', VirtualPage::class, UserDefinedForm::class);

	public function getCMSFields(){
		$f = parent::getCMSFields();

		$f->addFieldToTab('Root.Main', new CheckboxSetField('Teams', 'Show the following staff teams on this page:', StaffTeam::get()->map('ID', 'Title')), 'Content');

		$gridFieldConfig = GridFieldConfig_RecordEditor::create();
		$gridFieldConfig->addComponent(new GridFieldSortableRows('SortOrder'));


		$gridField = new GridField('StaffTeam', 'Staff Teams', DivisionStaffTeam::get(), $gridFieldConfig);
		$f->addFieldToTab('Root.Main', $gridField, 'Content'); // add the grid field to a tab in the CMS

		return $f;
	}
	public function getSettingsFields(){
		$f = parent::getSettingsFields();

		$f->addFieldToTab('Root.Settings', new CheckboxField('SortLastName','Sort Staff By Last Name'));
		$f->addFieldToTab('Root.Settings', new CheckboxField('HideLinksToStaffPages','Hide links to individual staff pages?'));
		$f->addFieldToTab('Root.Settings', DropdownField::create( 'PhotoOrientation', 'Photo orientation', singleton('DivisionStaffHolderPage')->dbObject('PhotoOrientation')->enumValues()));

		return $f;
	}
	public function Children(){
		if($this->SortLastName){
			$staffPages = parent::Children()->sort('LastName');
		}else{
			$staffPages = parent::Children();
		}
		
		$this->extend('alterChildren', $staffPages);
		return $staffPages;
	}

	public function DivisionStaffTeams(){
		$teams = DivisionStaffTeam::get();
		return $teams;
	}
}