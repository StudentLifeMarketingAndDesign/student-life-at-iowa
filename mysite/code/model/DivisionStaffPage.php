<?php

use SilverStripe\Assets\Image;
use SilverStripe\CMS\Model\SiteTree;
use SilverStripe\Forms\TextField;
use SilverStripe\Forms\CheckboxSetField;
use SilverStripe\TagField\TagField;
use SilverStripe\Forms\LiteralField;
use SilverStripe\Forms\HTMLEditor\HTMLEditorField;
use SilverStripe\AssetAdmin\Forms\UploadField;
class DivisionStaffPage extends Page {

	private static $db = array(
		"FirstName"      => "Text",
		"LastName"       => "Text",
		"Position"       => "Text",
		"EmailAddress"   => "Text",
		"Phone"          => "Text",
		"DepartmentURL"  => "Text",
		"DepartmentName" => "Text",
		"OtherWebsiteLink" => "Varchar(155)",
		"OtherWebsiteLabel" => "Varchar(155)"

	);

	private static $has_one = array(
		"Photo" => Image::class
	);

	private static $defaults = array(
		"OtherWebsiteLabel" => "Website"
	);

	private static $many_many = array(
		"Departments" => "DepartmentPage"
	);

	private static $belongs_many_many = array(
		"Teams" => "DivisionStaffTeam"
	);

	public function getCMSFields() {
		SiteTree::disableCMSFieldsExtensions();
		$fields = parent::getCMSFields();
		SiteTree::enableCMSFieldsExtensions();

		$fields->removeByName("Content");

		$fields->addFieldToTab("Root.Main", new TextField("FirstName", "First Name"));
		$fields->addFieldToTab("Root.Main", new TextField("LastName", "Last Name"));
		$fields->addFieldToTab("Root.Main", new TextField("Position", "Position"));
		$fields->addFieldToTab("Root.Main", new TextField("EmailAddress", "Email address"));
		$fields->addFieldToTab("Root.Main", new TextField("Phone", "Phone (XXX-XXX-XXXX)"));
		$fields->addFieldToTab("Root.Main", new TextField("DepartmentName", "Department name (optional)"));
		$fields->addFieldToTab("Root.Main", new TextField("DepartmentURL", "Department or Website URL (optional)"));
		$fields->addFieldToTab("Root.Main", new TextField("OtherWebsiteLink", "Other website URL (include http:// or https://)"));
		$fields->addFieldToTab("Root.Main", new TextField("OtherWebsiteLabel", "Other website label (default: \"Website\""));


		$fields->addFieldToTab("Root.Main", new CheckboxSetField("Teams", 'Team <a href="admin/pages/edit/show/378" target="_blank">(Manage Teams)</a>', DivisionStaffTeam::get()->map('ID', 'Name')));

		$deptField = TagField::create(
			'Departments',
			'Departments',
			DepartmentPage::get(),
			$this->Departments()
		)->setShouldLazyLoad(true) // tags should be lazy loaded
		 ->setCanCreate(false);

		$fields->addFieldToTab('Root.Main', $deptField);

		$fields->addFieldToTab("Root.Main", new LiteralField("TeamLabel", ''));

		$fields->addFieldToTab("Root.Main", new HTMLEditorField("Content", "Biography"));
		$fields->addFieldToTab("Root.Main", new UploadField("Photo", "Photo (4:3 preferred - resizes to 760 x 507)"));
		$fields->addFieldToTab("Root.Main", new HTMLEditorField("Content", "Biography"));

		$this->extend('updateCMSFields', $fields);
		$fields->removeByName("BackgroundImage");
		return $fields;

	}
	public function FullNameTruncated() {
		$lastName = $this->owner->LastName;
		$fullName = $this->owner->FirstName.' '.substr($lastName, 0, 1).'.';

		return $fullName;
	}

	public function Link($action = NULL) {
		if ($Link = $this->ExternalURL) {
			return $Link;
		} else {
			return parent::Link();
		}
	}

	public function toFeedArray(){
		$post = $this->owner;
		$postsArray = array();

		if($post->obj('Photo')->exists()){
			$postImage = $post->obj('Photo')->AbsoluteURL;
		}else{
			$postImage = null;
		}

		$postArrayItem = array(
				'FirstName' => $post->FirstName,
				'LastName' => $post->LastName,
				'Position' => $post->Position,
				'EmailAddress' => $post->EmailAddress,
				'ID' => $post->ID,
				'PhotoURL' => $postImage,
				'Phone' => $post->Phone,
				'DepartmentName' => $post->DepartmentName,
				'DepartmentURL' => $post->DepartmentURL,
				'Title' => $post->Title,
				'ID' => $post->ID,
				'URLSegment' => $post->URLSegment,
			);

		return $postArrayItem;
	}

}