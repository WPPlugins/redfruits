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
require_once('ADComponent.class.php');

/**
 * A Container object is a component that can contain other RedFruits components.
 * All the contained components are in a list.
 */
class ADContainer extends ADComponent
{
	protected $components = array();

	function __construct($component = false, $id = '')
	{
		parent::__construct($id);
		if ($component) $this->add($component);
	}

	/**
	 * Adds a component to the container
	 *
	 * @param ADComponent/array $component component to add.
	 * 			If it's an array the param id must be omitted
	 * @param string $id key to indexed the container's list. If it's omitted
	 * 		and the component is an ADComponent the component's id will be used.
	 * @return ADComponent/array the component added
	 */
	function add($component, $id = '')
	{
		if (strlen($id) > 0)
			if ($component instanceof ADComponent)
			{
				$this->components[$id] = $component;
				return $component;
			}
			else //string expected
				return $this->add(new ADText($component, $id));
		elseif ($component instanceof ADComponent)
		{
			$this->components[$component->getId()] = $component;
			return $component;
		}
		else if (is_array($component))
		{
			foreach($component as $comp)
				if ($comp instanceof ADComponent)
					$this->components[$comp->getId()] = $comp;
				else //string expected
					$this->add(new ADText($comp));
			return $this; //ATTENTION: It returns the container!!!!
		}
		else return $this->add(new ADText($component));
	}

	/**
	 * Helps creating text into the container.
	 * It's simmilar to add('some text') or add(new ADText('some text')
	 *
	 * @param string text to be added
	 */
	function addText($text = '')
	{
		return $this->add(new ADText($text));
	}
	
	/**
	 * Removes a component from the container
	 *
	 * @param ADComponent $component component to be added
	 * @return the container
	 */
	function remove($component) {
		if ($component instanceof ADComponent) unset($this->components[$component->getId()]);
		else unset($this->components[$component]);
		return $this;
	}

	/**
	 * Removes all the components of this container
	 *
	 * @return the container
	 */
	function removeAll() {
		unset($this->components);
		$this->components = array();
		return $this;
	}

	/**
	 * Returns a component from the container by the id
	 */
	function getComponentById($id) {
		return $this->components[$id];
	}

	/**
	 * Returns all the components contained in the container
	 */
	function getComponents() {
		return $this->components;
	}
	
	/**
	 * Returns the number of components contained in the container
	 */
	function getLength() {
		return count($this->components);
	}

	/**
	 * Returns the first component contained in the container
	 */
	function getFirstComponent() {
		if (count($this->components) > 0)
		{
			$values = array_values($this->components);
			return $values[0];
		}
		else return;
	}
}
?>
