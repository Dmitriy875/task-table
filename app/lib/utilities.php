<?php

namespace app\lib;

trait Utilities {
  public function disarm( $param ) {
		return trim( htmlspecialchars( strip_tags( $param ) ) );
	}
}

?>
