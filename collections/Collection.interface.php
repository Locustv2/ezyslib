<?php

/**
 * PHP Collection Library
 * @author		Yuvrajsingh Joodhisty
 * @version		v1.0
 * @copyright	2013 Locustv2
 * #email		Locustv@gmail.com
 * --------------------------------------
 * A Collection represents a group of objects known as its elements.
 * 
 */

interface Collection
{
	/**
	 * Adds $element to the invoking collection.
	 * Returns true if element was added to the collection.
	 * Returns false if element is already a member of the collection,
	 * or if the collection does not allow duplicates
	 * @param 	Object $elementKey, Object $elementValue = null (optional)
	 * @return 	boolean
	 */
	public function add($elementKey, $elementValue = null);

	/**
	 * Adds all the elements of $collection to the invoking collection.
	 * Returns true if the operation succeeded (i.e., the elements were added).
	 * Otherwise returns false
	 * @param 	Collection $collection
	 * @return 	boolean
	 */
	public function addAll(Collection $collection);

	/**
	 * Removes all elements from the invoking collection.
	 * @return 	void
	 */
	public function clear();

	/**
	 * Returns true if $element is an element of the invoking collection. Otherwise, returns false.
	 * @param 	Object $element
	 * @return 	boolean
	*/
	public function contains($element);

	/**
	 * Returns true if the invoking collection contains all elements of $collection. Otherwise, returns false.
	 * @param 	Collection $collection
	 * @return 	boolean
	*/
	public function containsAll(Collection $collection);

	/**
	 * Compares the specified $collection with this Collection for equality.
	 * Both the collection should be from same initiating class
	 * Returns true if similar, otherwise returns false.
	 * @param 	Collection $collection
	 * @return 	boolean
	 */
	public function equals(Collection $collection);

	/**
	 * Returns true if the invoking collection is empty. Otherwise, returns false.
	 * @return 	boolean
	 */
	public function isEmpty();

	/**
	 * Removes one instance of $element from the invoking collection.
	 * Returns true if the element was removed. Otherwise, returns false.
	 * @param 	Object $element
	 * @return 	boolean
	 */
	public function remove($element);

	/**
	 * Removes all elements of $collection from the invoking collection.
	 * Returns true if the collection changed (i.e., elements were removed). Otherwise, returns false.
	 * @param 	Collection $collection
	 * @return 	boolean
	 */
	public function removeAll(Collection  $collection);

	/**
	 * Removes all elements from the invoking collection except those in $collection.
	 * Returns true if the collection changed (i.e., elements were removed). Otherwise, returns false.
	 * @param 	Collection $collection
	 * @return 	boolean
	 */
    public function retainAll(Collection $collection);

    /**
     * Returns the number of elements held in the invoking collection.
     * @return 	Integer
     */
    public function size();

    /**
     * Returns an array that contains all the elements stored in the invoking collection.
     * The array elements are copies of the collection elements.
     * @return 	array
     */
    public function toArray();
}