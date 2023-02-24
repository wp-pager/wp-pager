<?php

declare( strict_types=1 );

function pager_get_files_from_request( string $files_key ): array {
	$files = $_FILES[ $files_key ] ?? [];

	$result     = [];
	$file_count = count( $files['name'] );
	$file_keys  = array_keys( $files );

	for ( $i = 0; $i < $file_count; $i ++ ) {
		foreach ( $file_keys as $key ) {
			$result[ $i ][ $key ] = $files[ $key ][ $i ];
		}
	}

	return $result;
}