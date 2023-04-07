<?php
namespace hakoniwa\theme\options;

use hakoniwa\theme\init\Define;
use hakoniwa\theme\util\CreateForm;

class Profile {

	/**
	 * Constructor.
	 */
	public function __construct() {
		// 連絡先情報に入力欄追加
		add_filter( 'user_contactmethods', [ $this, 'contact_methods' ], 20, 1 );
	}

	/**
	 * ソーシャル一覧
	 *
	 * @var array
	 */
	public $user_social = array(
		'twitter'   => 'Twitter URL',
		'facebook'  => 'Facebook個人ページ URL',
		'instagram' => 'Instagram URL',
		'youtube'   => 'YouTube URL',
		'amazon'    => 'Amazon URL',
		'pinterest' => 'Pinterest URL',
		'github'    => 'GitHub URL',
		'steam'     => 'Steam URL',
		'twitch'    => 'Twitch URL',
	);

	/**
	 * Add contact methods.
	 *
	 * @param array $user_contact 配列
	 * @return $user_contact
	 */
	public function contact_methods( $user_contact ) {

		// 入力欄追加
		foreach ( $this->user_social as $key => $label ) {
			$user_contact[ Define::value( 'theme_name' ) . '_user_profile_' . $key ] = $label;
		}

		return $user_contact;
	}

}

use hakoniwa\theme\options;
new Profile();
