<?php
namespace Vindi\Testing;

class Vindi_Test_Bootstrap extends Vindi_Test_Base {

	public static function setUpBeforeClass() {
		parent::setUpBeforeClass();
		remove_action( 'admin_init', '_maybe_update_themes' );
		remove_action( 'admin_init', '_maybe_update_core' );
		remove_action( 'admin_init', '_maybe_update_plugins' );

		wp_set_current_user( self::factory()->get_administrator_user()->ID );

		// Make sure the main class is running
		\Vindi\WC_Vindi_Payment::instance();

		// Run fake actions
		do_action( 'init' );
		do_action( 'plugins_loaded' );
	}

	public function test_plugin_activated() {
		$this->assertTrue( is_plugin_active( PLUGIN_PATH ) );
	}

	public function test_getInstance() {
		$this->assertInstanceOf( '\Vindi\WC_Vindi_Payment', \Vindi\WC_Vindi_Payment::instance() );
  }

  public function test_public_path() {

    $this->assertEquals('/app/src/', \Vindi\WC_Vindi_Payment::getPath());
  }

}
