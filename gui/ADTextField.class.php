<?php
/**
 * This file is part of RedFruits.
 * 
 * RedFruits is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * RedFruits is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with RedFruits.  If not, see <http://www.gnu.org/licenses/>.
 */
require_once(dirname(__FILE__).'/ADInputField.class.php');

class ADTextField extends ADInputField
{
	protected $size;
	protected $maxlength;

	function __construct($id = '', $value = '', $size = '10', $maxlength = '0', $readonly = false)
	{
		parent::__construct($id, $value, $readonly);
		$this->size = $size;
		$this->maxlength = $maxlength;
	}

	function getSize() {
		return $this->size;
	}

	function setSize($size) {
		$this->size = $size;
		return $this;
	}

	function getMaxlength() {
		return $this->maxlength;
	}

	function setMaxlength($maxlength) {
		$this->maxlength = $maxlength;
		return $this;
	}
}
?>
