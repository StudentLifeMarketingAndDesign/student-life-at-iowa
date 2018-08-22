<?php
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
		"Photo" => "Image"
	);

	private static $defaults = array(
		"OtherWebsiteLabel" => "Website"
	);

	private static $belongs_many_many = array(
		"Teams" => "DivisionStaffTeam",
		"Department" => "DepartmentPage"
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


		$fields->addFieldToTab("Root.Main", new CheckboxSetField("Teams", 'Team <a href="admin/pages/edit/show/14" target="_blank">(Manage Teams)</a>', StaffTeam::get()->map('ID', 'Name')));

		//$fields->addFieldToTab("Root.Main", new LiteralField("TeamLabel", ''));

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
	//private static $allowed_children = array("");

}
class DivisionStaffPage_Controller extends Page_Controller {

	/**
	 * An array of actions that can be accessed via a request. Each array element should be an action name, and the
	 * permissions or conditions required to allow the user to access it.
	 *
	 * <code>
	 * array (
	 *     'action', // anyone can access this action
	 *     'action' => true, // same as above
	 *     'action' => 'ADMIN', // you must have ADMIN permissions to access this action
	 *     'action' => '->checkAction' // you can only access this action if $this->checkAction() returns true
	 * );
	 * </code>
	 *
	 * @var array
	 */
	private static $allowed_actions = array(
	);

	public function init() {
		parent::init();

	}
	// public function NewsPosts() {

	// 	$memberId = $this->EmailAddress;

	// 	if (isset($memberId)) {
	// 		$url = 'http://studentlife.uiowa.edu/news/rss?member='.$memberId;
	// 		return $this->RSSDisplay(20, $url);
	// 	} else {
	// 		return false;
	// 	}

	// }
}