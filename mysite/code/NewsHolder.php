<?php
class NewsHolder extends BlogHolder {

	private static $db = array(
		"PhotoGalleryTitleOne" => "Text",
		"PhotoGalleryURLOne" => "Text",

		"PhotoGalleryTitleTwo" => "Text",
		"PhotoGalleryURLTwo" => "Text",

		"PhotoGalleryTitleThree" => "Text",
		"PhotoGalleryURLThree" => "Text",

	);

	private static $has_one = array(
		"PhotoGalleryImageOne" => "Image",
		"PhotoGalleryImageTwo" => "Image",
		"PhotoGalleryImageThree" => "Image",
	);
	private static $belongs_many_many = array (
	);
	private static $has_many = array(
	);

	private static $allowed_children = array(
		'NewsEntry'
	);

	private static $singular_name = 'News Holder';

	private static $plural_name = 'News Holders';

	public function getCMSFields(){
		$fields = parent::getCMSFields();
		$fields->removeByName("Content");
		$fields->removeByName("Metadata");

		$fields->addFieldToTab("Root.PhotoGallery", new TextField("PhotoGalleryTitleOne", "Title"));
		$fields->addFieldToTab("Root.PhotoGallery", new TextField("PhotoGalleryURLOne", "URL"));
    	$fields->addFieldToTab("Root.PhotoGallery", new UploadField("PhotoGalleryImageOne", "Photo"));

    	$fields->addFieldToTab("Root.PhotoGalleryTwo", new TextField("PhotoGalleryTitleTwo", "Title"));
		$fields->addFieldToTab("Root.PhotoGalleryTwo", new TextField("PhotoGalleryURLTwo", "URL"));
    	$fields->addFieldToTab("Root.PhotoGalleryTwo", new UploadField("PhotoGalleryImageTwo", "Photo"));

    	$fields->addFieldToTab("Root.PhotoGalleryThree", new TextField("PhotoGalleryTitleThree", "Title"));
		$fields->addFieldToTab("Root.PhotoGalleryThree", new TextField("PhotoGalleryURLThree", "URL"));
    	$fields->addFieldToTab("Root.PhotoGalleryThree", new UploadField("PhotoGalleryImageThree", "Photo"));

		return $fields;
	}


}
class NewsHolder_Controller extends BlogHolder_Controller {

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
	private static $allowed_actions = array (
	);

	public function init() {
		parent::init();

	}

}