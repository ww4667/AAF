<?php
/*
 * Copyright 2006, 2007, 2008, 2009, 2010 by Jason Coward <xpdo@opengeek.com>
 *
 * This file is part of xPDO.
 *
 * xPDO is free software; you can redistribute it and/or modify it under the
 * terms of the GNU General Public License as published by the Free Software
 * Foundation; either version 2 of the License, or (at your option) any later
 * version.
 *
 * xPDO is distributed in the hope that it will be useful, but WITHOUT ANY
 * WARRANTY; without even the implied warranty of MERCHANTABILITY or FITNESS FOR
 * A PARTICULAR PURPOSE. See the GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License along with
 * xPDO; if not, write to the Free Software Foundation, Inc., 59 Temple Place,
 * Suite 330, Boston, MA 02111-1307 USA
 */

/**
 * Provides an APC-powered xPDOCache implementation.
 *
 * This requires the APC extension for PHP, version 3.1.4 or later. Earlier versions
 * did not have all the necessary user cache methods.
 *
 * @package xpdo
 * @subpackage cache
 */
class xPDOAPCCache extends xPDOCache {
    public function __construct(& $xpdo, $options = array()) {
        parent :: __construct($xpdo, $options);
        if (function_exists('apc_exists')) {
            $this->initialized = true;
        } else {
            $this->xpdo->log(xPDO::LOG_LEVEL_ERROR, "xPDOAPCCache[{$this->key}]: Error creating APC cache provider; xPDOAPCCache requires the APC extension for PHP, version 2.0.0 or later.");
        }
    }

    public function add($key, $var, $expire= 0, $options= array()) {
        $added= apc_add(
            $this->getCacheKey($key),
            $var,
            $expire
        );
        return $added;
    }

    public function set($key, $var, $expire= 0, $options= array()) {
        $set= apc_store(
            $this->getCacheKey($key),
            $var,
            $expire
        );
        return $set;
    }

    public function replace($key, $var, $expire= 0, $options= array()) {
        $replaced = false;
        if (apc_exists($key)) {
            $replaced= apc_store(
                $this->getCacheKey($key),
                $var,
                $expire
            );
        }
        return $replaced;
    }

    public function delete($key, $options= array()) {
        $deleted = false;
        if (!isset($options['multiple_object_delete']) || empty($options['multiple_object_delete'])) {
            $deleted= apc_delete($this->getCacheKey($key));
        }
        return $deleted;
    }

    public function get($key, $options= array()) {
        $value= apc_fetch($this->getCacheKey($key));
        return $value;
    }

    public function flush($options= array()) {
        return apc_clear_cache('user');
    }
}