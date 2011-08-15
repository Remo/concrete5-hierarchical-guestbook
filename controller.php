<?php
defined('C5_EXECUTE') or die(_("Access Denied."));

class RemoGuestbookPackage extends Package {
	protected $pkgHandle = 'remo_guestbook';
	protected $appVersionRequired = '5.4.1.1';
	protected $pkgVersion = '0.0.1';

	public function getPackageDescription() {
		return t("Installs the Hierarchical Guestbook package.");
	}

	public function getPackageName() {
		return t("Hierarchical Guestbook");
	}
	
	public function install() {
		$pkg = parent::install();

		// install block		
		BlockType::installBlockTypeFromPackage('remo_guestbook', $pkg);    
	}
}
?>
