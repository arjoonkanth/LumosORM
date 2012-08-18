<?php

/**
 * An Easy to use ORM starter - LumosORM
 *
 * @author arjoonkanth <arjoonkanth@gmail.com>
 * @version 1.0.0
 * @copyright 2012 : arjoonkanth 
 * 
 */


class Lumos extends databaseConnection {
	private static $_query;
	private static $_where = array();
	private static $_Mwhere = array();

	private function __construct() {
	}

	static function query($query, $data = NULL) {
		self::$_query = filter_var($query, FILTER_SANITIZE_STRING);
		$stmt = self::_prepareQuery();
		$stmt -> execute($data);
		$rows = $stmt -> fetchAll(PDO::FETCH_ASSOC);
		return $rows;
	}

	static function singleRow($query, $data = NULL) {
		self::$_query = filter_var($query, FILTER_SANITIZE_STRING);
		$stmt = self::_prepareQuery();
		$stmt -> execute($data);
		$rows = $stmt -> fetch(PDO::FETCH_ASSOC);
		return $rows;
	}

	static function Insert($query, $data = NULL) {
		self::$_query = filter_var($query, FILTER_SANITIZE_STRING);
		$stmt = self::_prepareQuery();
		$rows = $stmt -> execute($data);
		return $rows;
	}

	static function Update($query, $data = NULL) {
		self::$_query = filter_var($query, FILTER_SANITIZE_STRING);
		$stmt = self::_prepareQuery();
		$rows = $stmt -> execute($data);
		return $rows;
	}

	private function _prepareQuery() {
		$_dbh = parent::getInstance();

		if (!$stmt = $_dbh -> prepare(self::$_query)) {
			trigger_error("Problem preparing query", E_USER_ERROR);
		}
		return $stmt;
	}

	//To remove the database stripslashes issue
	static function quote2entities($value) {
		if (get_magic_quotes_gpc()) {
			$value = stripslashes($value);
		} else {
			$value = addslashes($value);
		}
		return $value;
	}

}
