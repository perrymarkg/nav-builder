<?php

namespace prymag\nav_builder;

class NavBuilder {

    var $array;

    var $flat_array = false;

    var $options;

    function __construct( $array, $options, $flat_array = false ){
        $this->array = $array;
        $this->options = $options;
        $this->flat_array = $flat_array;
    }

    function display(){
        if( $this->flat_array ){
            $this->array = $this->buildTree( $this->array );
        }
        $this->traverse( $this->array );
    }

    function traverse( $array, $ctr = 1 ){
        
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
                $this->traverse( $a['children'], $ctr+=1 );
            echo '</li>';
            
        }
        echo '</ul>';

    }

    // Convert flat array to tree https://stackoverflow.com/questions/8840319/build-a-tree-from-a-flat-array-in-php
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