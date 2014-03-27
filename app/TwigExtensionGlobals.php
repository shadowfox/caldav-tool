<?php
//namespace \Twig\Extension;

use \Twig_Extension;

/**
 * Simple extension for Twig which simply takes an array of variables
 * and makes them available in Twig's global namespace.
 */
class Twig_Extension_Globals extends \Twig_Extension
{
    protected $globals;

    public function __construct($globals = array()) {
        $this->globals = $globals;
    }

    /**
     * Returns the list of global variables to add to the existing list.
     *
     * @return array An array of global variables
     */
    public function getGlobals() {
        return $this->globals;
    }

    /**
     * {@inheritdoc}
     */
    public function getName() {
        return 'globals';
    }
}