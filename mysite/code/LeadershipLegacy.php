<?php
class LeadershipLegacy extends Page {

	private static $db = array(

	);

	private static $has_one = array(

	);

	public function getCMSFields(){
		$fields = parent::getCMSFields();

		// $fields->removeByName("Content");
		$fields->removeByName("Metadata");




		return $fields;

	}

}