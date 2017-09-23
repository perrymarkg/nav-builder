<?php

namespace prymag\nav_builder;

/**
 * Navigation builder class
 */
class NavBuilder {

    var $array;

    var $flat_array = false;
    
    var $options;
    
    /**
     * Class constructor
     *
     * @param array $array The menu array
     * @param array $options Options array, allowed array('class','id')
     * @param boolean $flat_array
     */
    function __construct( $array, $options, $flat_array = false ){
        $this->array = $array;
        $this->options = $options;
        $this->flat_array = $flat_array;
        if( $this->flat_array ){
            $this->array = $this->buildTree( $this->array );
        }
    }

    /**
     * Displays the rendered menu
     *
     * @param array $array
     * @param integer $ctr
     * @return void
     */
    function display( $array = array(), $ctr = 1 ){
        
        if( empty($array) )
            $array = $this->array;

        if( $ctr == 1) {
            $additional_class = isset($this->options['class']) ? $this->options['class'] : '';
            $id = isset($this->options['id']) ? $this->options['id'] : '';
            echo sprintf('<ul class="level-%d %s" %s>', $ctr, $additional_class, $id);
        }
        else
            echo sprintf('<ul class="level-%d">', $ctr, $additional_class, $id);
        
        foreach( $array as $a ){
            echo sprintf('<li class="%s">', $a['class']); ;
            echo sprintf('<a href="%s">%s</a>', $a['link'], $a['name']);
            if( isset($a['children']) )
                $this->display( $a['children'], $ctr+=1 );
            echo '</li>';
            
        }
        echo '</ul>';

    }

    /**
     * Converts flat array to multidimensional array
     * see https://stackoverflow.com/questions/8840319/build-a-tree-from-a-flat-array-in-php
     *
     * @param array $elements
     * @param integer $parentId
     * @return array
     */
    function buildTree(array &$elements, $parentId = 0) {
        $branch = array();
    
        foreach ($elements as $element) {
            if ($element['parent_id'] == $parentId) {
                $children = $this->buildTree($elements, $element['id']);
                if ($children) {
                    $element['children'] = $children;
                }
                $branch[$element['id']] = $element;
                //unset($elements[$element['id']]);
            }
        }
        return $branch;
    }

} 