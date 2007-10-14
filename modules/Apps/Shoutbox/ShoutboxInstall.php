<?php
/**
 * @author Paul Bukowski <pbukowski@telaxus.com>
 * @copyright Copyright &copy; 2006, Telaxus LLC
 * @version 0.9
 * @package apps-shoutbox
 * @license SPL
 */
defined("_VALID_ACCESS") || die('Direct access forbidden');

class Apps_ShoutboxInstall extends ModuleInstall {

	public function install() {
		$ret = true;
		$ret &= DB::CreateTable('apps_shoutbox_messages','
			id I4 AUTO KEY,
			base_user_login_id I4 NOTNULL,
			message X,
			posted_on T DEFTIMESTAMP',
			array('constraints'=>', FOREIGN KEY (base_user_login_id) REFERENCES user_login(ID)'));
		if(!$ret){
			print('Unable to create table apps_shoutbox_messages.<br>');
			return false;
		}
		Base_ThemeCommon::install_default_theme($this -> get_type());
		return $ret;
	}

	public function uninstall() {
		$ret = true;
		$ret &= DB::DropTable('apps_shoutbox_messages');
		Base_ThemeCommon::uninstall_default_theme($this -> get_type());
		return $ret;
	}
	public function version() {
		return array("0.5");
	}

	public static function simple_setup() {
		return true;
	}

	public function requires($v) {
		return array(
			array('name'=>'Base/Acl','version'=>0),
			array('name'=>'Base/User','version'=>0),
			array('name'=>'Base/Lang','version'=>0),
			array('name'=>'Libs/QuickForm','version'=>0));
	}

}

?>
