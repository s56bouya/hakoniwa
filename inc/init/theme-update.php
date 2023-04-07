<?php
namespace fse\theme\init;

use fse\theme\init\Define;

class Update {

    private $file = 'theme-info.json';

    /**
     * Constructor.
     */
    public function __construct() {

        add_filter( 'site_transient_update_themes', [ $this, 'update' ] );

    }

    /**
     * データ取得
     */
    private function request(){

        if( true === Define::value( 'network_active' ) ){

            // アクティベーションチェック
            $activate = get_option( Define::value( 'theme_name' ) . '_activate' );

            if( ! isset( $activate['status'] ) ){
                return false;
            }

            if( false == $activate['status'] ){
                return false;
            }

        }

        delete_transient( Define::value( 'theme_name' ) . '_update' );
        $remote = get_transient( Define::value( 'theme_name' ) . '_update' );

        if( false === $remote ) {

            $remote = wp_remote_get(
                Define::value( 'network_auth' ) . '/' . $this->file,
                array(
                    'timeout' => 10,
                    'sslverify' => false,
                    'headers' => array(
                        'Accept' => 'application/json'
                    )
                )
            );

            if( is_wp_error( $remote )
                || 200 !== wp_remote_retrieve_response_code( $remote )
                || empty( wp_remote_retrieve_body( $remote ) )
            ) {
                return false;
            }

            //set_transient( Define::value( 'theme_name' ) . '_update', $remote, DAY_IN_SECONDS );
        }

        $remote = json_decode( wp_remote_retrieve_body( $remote ) );

        return $remote;
        
    }

    /**
     * 更新通知
     */
    public function update( $transient ){
        if( ! is_admin() ){
            return false;
        }

        $stylesheet = get_template();
        $theme = wp_get_theme();
    	$version = $theme->get( 'Version' );

        if ( empty( $transient->checked ) ) {
            return $transient;
        }

        $remote = $this->request();

        if( empty( $remote ) ){
            return $transient;
        }

        $data = array(
            'theme' => $stylesheet,
            'url' => $remote->details_url,
            'requires' => $remote->requires,
            'requires_php' => $remote->requires_php,
            'new_version' => $remote->version,
            'package' => $remote->download_url,
        );
 
        if(
            $remote
            && version_compare( $version, $remote->version, '<' )
            && version_compare( $remote->requires, get_bloginfo( 'version' ), '<=' )
            && version_compare( $remote->requires_php, PHP_VERSION, '<' )
        ) {
            
            $transient->response[ $stylesheet ] = $data;              
        } else {
            $transient->no_update[ $stylesheet ] = $data;
        }
     
        return $transient;
    
    }

}

use fse\theme\init;
new Update();
